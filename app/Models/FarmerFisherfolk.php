<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class FarmerFisherfolk extends Model
{
    use HasFactory;

    protected $table = 'farmerfisherfolk';
    protected $primaryKey = 'ff_id';

    public static function showFarmerFisherfolk()
    {
        $data = DB::table('farmerfisherfolk')->select(
            'farmerfisherfolk.*',
            'refbrgy.brgyDesc as barName',
            'refcitymun.citymunDesc as city'
        )
            ->join('refbrgy', 'refbrgy.id', 'farmerfisherfolk.a_barangay')
            ->join('refcitymun', 'refcitymun.id', 'farmerfisherfolk.a_citymun');
        if (!empty(Request::get('searchKey'))) {
            $data = $data->orWhere(DB::raw("concat(`fname`,' ',`lname`,' ',`rsbsa_nat`,' ',`rsbsa_loc`,' ',`fishr_nat`,' ',`fishr_loc`)"), 'like', '%' . Request::get('searchKey') . '%');
        }
        if (!empty(Request::get('barid'))) {
            $data = $data->where('a_barangay', '=', Request::get('barid'));
        }

        $data = $data->orderBy('created_at', 'desc')->get();
        return $data;
    }

    public static function searchFarmerFisherFolkByBarangay()
    {
        $data = DB::table('farmerfisherfolk')->select(
            'farmerfisherfolk.*',
            'refbrgy.brgyDesc as barName',
            'refcitymun.citymunDesc as city'
        )
            ->join('refbrgy', 'refbrgy.id', 'farmerfisherfolk.a_barangay')
            ->join('refcitymun', 'refcitymun.id', 'farmerfisherfolk.a_citymun');
        $data = $data->where('a_barangay', '=', Request::get('barid'))->orderBy('created_at', 'desc')->get();
        return $data;
    }

    public static function getId($fname, $lname, $dob)
    {
        $data = DB::table('farmerfisherfolk')->select('farmerfisherfolk.*')
            ->where(['fname' => $fname, 'lname' => $lname, 'dob' => $dob])->first();
        return $data;
    }
}
