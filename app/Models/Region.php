<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Region extends Model
{
    use HasFactory;
    protected $table = 'refregion';
    protected $primaryKey = 'id';




    public static function showAllRegion()
    {
        return DB::table('refregion')->select('refregion.*')->orderBy('id', 'asc')->get();
    }
}
