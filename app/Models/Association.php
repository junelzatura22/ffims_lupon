<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Association extends Model
{
    use HasFactory;

    protected $table = 'association';
    protected $primaryKey = 'as_id';


    public static function showAllAssociations()
    {
        $data = DB::table('association')->select('association.*', 'refbrgy.brgyDesc as barName','program.program_name as pName')
            ->join('refbrgy', 'refbrgy.id', 'association.barangay_id')
            ->join('program', 'program.program_id', 'association.belongs_to_program')
            ->orderBy('association.created_at', 'desc')
            ->where('as_id','!=',14)->paginate(10);

        return $data;
    }
    public static function showAllAssociationsWithNone()
    {
        $data = DB::table('association')->select('association.*', 'refbrgy.brgyDesc as barName','program.program_name as pName')
            ->join('refbrgy', 'refbrgy.id', 'association.barangay_id')
            ->join('program', 'program.program_id', 'association.belongs_to_program')
            ->orderBy('association.namedesc', 'asc')->get();

        return $data;
    }
}
