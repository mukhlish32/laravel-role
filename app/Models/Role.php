<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $table = 'role';
    public $timestamps = false;
    protected $fillable = [
    	'role','deskripsi',
    ];

    public static function getRoleAll()
    {
        $value = Role::select('id', 'role','deskripsi');
        return $value->get();
    }

    public static function getDataRoleById($id)
    {
        $value = Role::select('id', 'role','deskripsi')->where('id', $id);
        return $value->first();
    }
}
