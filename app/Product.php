<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Warehouse;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'category_id',
        'warehouse_id',
        "quantity",
        "description",
        "code",
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $table = 'product';


}
