<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';

    protected $fillable = [
        'id',
        'email',
        'password',
        'isAdmin',
        '_token',
    ];


    public function store(Request $request)
    {
        $this->create(array(
            'email' => $request->input('email'),
            'password' => $this->bcrypt($request->password, 'hash'),
            'isAdmin' => 0,
        ));
    }

    public function bcrypt(string $password, string $what, $currentPassword = null)
    {
        $after = app('hash')->make($password);

        switch ($what) {
            case 'hash':
                return $after;
                break;
            case 'check':
                return app('hash')->check($password, $currentPassword);
                break;
        }
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function warehouse() 
	{  
		return $this->belongsToMany(Warehouse::class, 'user_warehouse', 'user_id', 'warehouse_id')->with('products'); 
		
	}
}
