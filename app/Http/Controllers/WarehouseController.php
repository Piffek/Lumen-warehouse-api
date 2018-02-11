<?php
/**
 * Created by PhpStorm.
 * User: Karol
 * Date: 10.02.2018
 * Time: 15:15
 */

namespace App\Http\Controllers;


use App\Warehouse;

class WarehouseController extends  Controller{

    private $warehouse;

    /**
     * WarehouseController constructor.
     * @param $warehouse
     */
    public function __construct(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
    }

    public function getWarehouse()
    {
        $var = $this->warehouse->all();
        foreach ($var as $c) {
            $this->value = $c->id;
        }
        if ($this->value !== null) {
            return response()->json($this->warehouse->all());
        } else {
            return response()->json(['msg' => 'no warehouses'], 404);
        }
    }


}