<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Province extends Model
{
    use HasFactory;
    protected $table = 'refprovince';
    protected $primaryKey = 'id';

    public static function showProvinceByRegion($id){
        return DB::table('refprovince')->select('refprovince.*')
        ->where('reg_id',$id)
        ->orderBy('provDesc', 'asc')->get();        
    }
}
