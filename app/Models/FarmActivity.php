<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FarmActivity extends Model
{
    use HasFactory;

    protected $table = "farmactivity";
    protected $primaryKey = "id";


    public static function showAllFarmActivity($farm_id)
    {
        $query = DB::table("farmactivity")->select("farmactivity.*", "program.program_name as commodity", "program_category.pc_name as subcommododity")
            ->join('program', 'program.program_id', 'farmactivity.program_id')
            ->join('program_category', 'program_category.pc_id', 'farmactivity.pc_id')
            ->where('farm_id', $farm_id)->get();
        return $query;
    }

    public static function getSumOfAreaByFarmID($farm_id)
    {
        $query =  DB::table('farmactivity')->select('farmActivity.*')->where('farm_id', $farm_id)
            ->groupBy('farmactivity.farm_id')->sum('area');
        return $query;
    }
}
