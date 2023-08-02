<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Program extends Model
{
    use HasFactory;


    protected $table = 'program';
    protected $primaryKey = 'program_id';

    public static function showAllPrograms()
    {
        $data = DB::table("program")->select(
            "program.*",
            DB::raw("IFNULL((select count(*) from program_category pc where 
                pc.prog_id = program.program_id and pc.is_deleted = 0 group by program.program_id),0) as totalCount"),
            DB::raw('concat(users.name," ",users.lastname) as name')
        )
            ->where(['program_status' => 'Active', 'program.is_deleted' => '0'])
            ->join('users', 'program.created_by', 'users.id')
            ->orderBy('program.created_at', 'desc')->paginate(10);
        return $data;
    }
    public static function loadProgram()
    {
        $data = DB::table("program")->select(
            "program.*")
            ->where(['program_status' => 'Active', 'is_deleted' => '0'])
            ->orderBy('program_name', 'asc')->get();
        return $data;
    }
}
