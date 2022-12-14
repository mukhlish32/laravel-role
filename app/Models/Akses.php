<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    use HasFactory;
    
    protected $table = 'akses';
    public $timestamps = false;
    protected $fillable = [
    	'role_id','akses','semua',
    ];

    public static function getAksesAll()
    {
        $value = Akses::select('role_id','akses');
        return $value->get();
    }

    public static function getAksesById($id)
    {
        $value = Akses::select('role_id','akses','semua')->where('role_id', $id);
        return $value->get();
    }

    public static function getAksesByIdAndAkses($id, $akses)
    {
        $value = Akses::select('role_id','akses','semua')->where('role_id', $id)->where('akses', $akses);
        return $value->first();
    }

    public function isUser($user)
    {
        return $this->user_id === $user->id;
    }
}
