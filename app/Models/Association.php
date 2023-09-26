<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Association extends Model
{
    use HasFactory;

    protected $table = 'association';
    protected $primaryKey = 'as_id';

    public static function showAllAssociations()
    {
        $data = DB::table('association')->select('association.*', 'refbrgy.brgyDesc as barName', 'program.program_name as pName')
            ->join('refbrgy', 'refbrgy.id', 'association.barangay_id')
            ->join('program', 'program.program_id', 'association.belongs_to_program');

        if (!empty(Request::get('barid'))) {
            $data = $data->where('association.barangay_id', '=', Request::get('barid'));
        }
        if (!empty(Request::get('pid'))) {
            $data = $data->where('association.belongs_to_program', '=', Request::get('pid'));
        }
        if (!empty(Request::get('assoc'))) {
            $data = $data->orWhere(DB::raw("concat(`nameabbr`,' ',`namedesc`)"), 'like', '%' . Request::get('assoc') . '%');
        }
        $data = $data->orderBy('association.created_at', 'desc')->paginate(10);
        return $data;
    }
    public static function showAllAssociationsWithNone()
    {
        $data = DB::table('association')->select('association.*', 'refbrgy.brgyDesc as barName', 'program.program_name as pName')
            ->join('refbrgy', 'refbrgy.id', 'association.barangay_id')
            ->join('program', 'program.program_id', 'association.belongs_to_program')
            ->orderBy('association.namedesc', 'asc')->get();

        return $data;
    }
}
