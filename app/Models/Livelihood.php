<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Livelihood extends Model
{
    use HasFactory;

    protected $table = 'livelihood';
    protected $primaryKey='l_id';

    public static function showLivelihoodByF2($id)
    {
        $query = DB::table('livelihood')
        ->select("livelihood.*")
        ->where('livelihoodby', $id)->first();
        return $query;
    }

}
