<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $table = 'user';
    public $timestamps = false;
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id'
    ];

    public static function getDataUserWithRole()
    {
        $query = "SELECT user.id, user.username, user.email, role.role FROM user 
                  LEFT JOIN role ON role.id = user.role_id";
        $value = DB::select($query);
        return $value;
    }

    public static function getDataUserById($id)
    {
        $value = User::select('id', 'username', 'email', 'role_id')->where('id', $id);
        return $value->first();
    }
}
