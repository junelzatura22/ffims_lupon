<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FFDetails extends Model
{
    use HasFactory;

    protected $table = 'ffdetails';
    protected $primaryKey = 'ffd_id';

    public static function showDetailsByF2($id)
    {
        $query = DB::table('ffdetails')
        ->select("ffdetails.*")
        ->where('ff_id', $id)->first();
        return $query;
    }
}
