<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

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

    
    public static function showAllActivity()
    {
        $query = DB::table("farmactivity")->select("farmactivity.*", "program.program_name as commodity", 
        "program_category.pc_name as subcommododity", "farmdetails.farm_name as farm")
            ->join('program', 'program.program_id', 'farmactivity.program_id')
            ->join('farmdetails', 'farmdetails.id', 'farmactivity.farm_id')
            ->join('program_category', 'program_category.pc_id', 'farmactivity.pc_id');
          
            if (!empty(Request::get('barid'))) {
                $query = $query->where('farmdetails.location_bar_id', '=', Request::get('barid'));
            }
            if (!empty(Request::get('pid'))) {
                $query = $query->where('farmactivity.program_id', '=', Request::get('pid'));
            }
            if (!empty(Request::get('farm'))) {
                $query = $query->where('farmdetails.farm_name', 'like', '%' . Request::get('farm') . '%');
            }

            $query = $query->paginate(21);
            
        return $query;
    }
}
