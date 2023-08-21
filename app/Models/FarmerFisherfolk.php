<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FarmerFisherfolk extends Model
{
    use HasFactory;


    protected $table = 'farmerfisherfolk';
    protected $primaryKey = 'ff_id';

    public static function showFarmerFisherfolk()
    {
        $data  = DB::table('farmerfisherfolk')->select('farmerfisherfolk.*')
            ->orderBy('created_at', 'desc')->get();
        return $data;
    }

    public static function getId($fname, $lname, $dob){
        $data  = DB::table('farmerfisherfolk')->select('farmerfisherfolk.*')
            ->where(['fname'=>$fname,'lname'=>$lname,'dob'=>$dob])->first();
        return $data;
    }
}
