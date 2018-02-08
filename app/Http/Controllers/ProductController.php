<?php
/**
 * Created by PhpStorm.
 * User: Karol
 * Date: 2017-11-29
 * Time: 20:25
 */

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getProducts()
    {
        return DB::table('product')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->select('product.*', 'category.name as category_name')
            ->get();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function addProduct(Request $request)
    {
        if ($this->product->create($request->all())) {
            $msg = ['msg' => 'product added successfully'];
        } else {
            $msg = ['msg' => 'product added error'];
        }

        return json_encode($msg);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function removeProduct(Request $request)
    {
        $oneProduct = $this->product->where('id', $request->id)->first();
        if (isset($oneProduct)) {
            $oneProduct->delete();
            $msg = ['msg' => 'product remove successfully'];
        } else {
            $msg = ['msg' => 'product remove error'];
        }

        return json_encode($msg);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function updateProduct(Request $request)
    {
        if ($this->product->find($request->id)->update($request->all())) {
            $msg = ['msg' => 'product updated successfully'];
        } else {
            $msg = ['msg' => 'product updated error'];
        }

        return json_encode($msg);
    }
}