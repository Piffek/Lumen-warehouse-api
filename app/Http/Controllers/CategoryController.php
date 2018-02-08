<?php
/**
 * Created by PhpStorm.
 * User: Karol
 * Date: 2017-11-29
 * Time: 20:25
 */

namespace App\Http\Controllers;


use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    private $value;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getCategories()
    {

        $categories = $this->category->all();
        foreach ($categories as $c) {
            $this->value = $c->id;
        }
        if ($this->value !== null) {
            return json_encode($this->category->all());
        } else {
            return json_encode(['msg' => 'no category']);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function addCategory(Request $request)
    {
        if ($this->category->create($request->all())) {
            $currentUser = $this->category->where('name', $request->name)->first();
            return response()->json(['name' => $currentUser->name,'id' => $currentUser->id]);
        } else {
            return response()->json(['msg' => 'category added error'], 404);
        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function removeCategory(Request $request)
    {
        $oneCategory = $this->category->where('id', $request->id)->first();
        if (isset($oneCategory)) {
            $oneCategory->delete();
            return response()->json(['msg' => 'category remove success'], 200);
        } else {
            return response()->json(['msg' => 'category remove error'], 404);
        }
    }
}