<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CityMun extends Model
{
    use HasFactory;

    protected $table = 'refcitymun';
    protected $primaryKey = 'id';

    public static function showCityMunByProvince($id){
        return DB::table('refcitymun')->select('refcitymun.*')
        ->where('province_id',$id)
        ->orderBy('citymunDesc', 'asc')->get();        
    }
}
