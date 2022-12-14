<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBiaya extends Model
{
    use HasFactory;
    
    protected $table = 'kategori_biaya';
    public $timestamps = false;
    protected $fillable = [
    	'nama','deskripsi','user_id',
    ];

    public static function getKategoriBiayaAll()
    {
        $value = KategoriBiaya::select('id', 'nama','deskripsi','user_id');
        return $value->get();
    }

    public static function getKategoriBiayaByUserId($id)
    {
        $value = KategoriBiaya::select('id', 'nama','deskripsi','user_id')->where('user_id', $id);
        return $value->get();
    }

    public static function getKategoriBiayaById($id)
    {
        $value = KategoriBiaya::select('id', 'nama','deskripsi','user_id')->where('id', $id);
        return $value->first();
    }

    public function isUser($user)
    {
        return $this->user_id === $user->id;
    }
}
