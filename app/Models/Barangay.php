<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barangay extends Model
{
    use HasFactory;

    protected $table = 'refbrgy';
    protected $primaryKey = 'id';

    public static function showBarangayByMunicipality($id){
        return DB::table('refbrgy')->select('refbrgy.*')
        ->where('citymun_id',$id)
        ->orderBy('brgyDesc', 'asc')->get();        
    }
}
