<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssignedProgram extends Model
{
    use HasFactory;

    protected $table='assigned_program';
    protected $primaryKey = 'ac_id';


    public static function showAllProgram($id){
        $data = DB::table('assigned_program')->select('assigned_program.*','program.program_name')
        ->join('program','program.program_id','ac_program_id')
        ->join('users','users.id','ac_userd_id')
        ->where(['users.id'=>$id,'ac_status'=>'Active'])->get();//the program will not exceed to 10
        return $data;
    }
    public static function countProgram($id){
        $data = DB::table('assigned_program')->select('assigned_program.*')
        ->where('ac_status','=','Active')->get();
        return $data;
    }
}
