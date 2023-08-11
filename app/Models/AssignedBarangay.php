<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssignedBarangay extends Model
{
    use HasFactory;

    protected $table='assigned_barangay';
    protected $primaryKey = 'ab_id';


    public static function showBarangaAssignment($id){
        $data = DB::table('assigned_barangay')->select('assigned_barangay.*','refbrgy.brgyDesc')
        ->join('refbrgy','refbrgy.id','ab_bar_id')
        ->join('users','users.id','ab_user_id')
        ->where(['users.id'=>$id])->paginate(10);//its and array form--but no need
        return $data;
    }
    public static function countBarangayAssignment($id){
        $data = DB::table('assigned_barangay')->select('assigned_barangay.*')
        ->where('ab_status','=','Active')->get();
        return $data;
    }
}
