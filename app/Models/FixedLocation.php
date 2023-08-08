<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FixedLocation extends Model
{
    use HasFactory;

    protected $table = 'fixedlocation';
    protected $primaryKey = 'l_id';

    public static function showMyLocation()
    {
        $data = DB::table('fixedlocation')->select(
            'fixedlocation.*',
            DB::RAW('CONCAT(users.name," ",users.lastname) as fname'),
            DB::RAW('refregion.regDesc as region'),
            DB::RAW('refprovince.provDesc as province'),
            DB::RAW('refcitymun.citymunDesc as citymun')
        )
            ->join('users', 'user_id', 'users.id')
            ->join('refregion', 'region_id', 'refregion.id')
            ->join('refprovince', 'province_id', 'refprovince.id')
            ->join('refcitymun', 'citymun_id', 'refcitymun.id')
            ->where('user_id', '=', Auth::user()->id)->first();
        return $data;
    }

    public static function myLocation()
    {
        $data = DB::table('fixedlocation')->select('fixedlocation.*')
            ->join('users', 'user_id', 'users.id')
            ->where('user_id', '=', Auth::user()->id)
            ->first();

        return $data;
    }
}
