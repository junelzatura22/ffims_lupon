<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FarmDetails extends Model
{
    use HasFactory;

    protected $table = 'farmdetails';
    protected $primaryKey = 'id';


    public static function getFarmDetailsOf($id, $key)
    {
        $query = "";
        switch ($key) {
            case 'count':
                $query = DB::table('farmdetails')->select('farmdetails.*')->where("registered_to", $id)->count();
                break;
            case 'count_farm_active':
                $query = DB::table('farmdetails')->select('farmdetails.*')->where(['registered_to'=>$id,'farm_status'=>'Active'])->count();
                break;
            case 'sum_area':
                $query = DB::table('farmdetails')->select('farmdetails.*')->where("registered_to", $id)->sum('total_area');
                break;
            case 'sum_parcel':
                $query = DB::table('farmdetails')->select('farmdetails.*')->where("registered_to", $id)->sum('no_of_parcel');
                break;

            default:
                $query = DB::table('farmdetails')->select('farmdetails.*', 'refbrgy.brgyDesc as BarName')
                    ->join('refbrgy', '.refbrgy.id', '.farmdetails.location_bar_id')
                    ->where("registered_to", $id)->get();
                break;
        }
        return $query;
    }
}
