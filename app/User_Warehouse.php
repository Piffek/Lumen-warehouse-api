<?php
/**
 * Created by PhpStorm.
 * User: Karol
 * Date: 2017-12-12
 * Time: 21:10
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Warehouse extends Model
{
    public $timestamps = false;

    protected $table = 'user_warehouse';

    protected $fillable = [
        'user_id',
        'warehouse_id',
    ];
}