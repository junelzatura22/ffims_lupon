<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ProgamCategory extends Model
{
    use HasFactory;
    
    protected $table='program_category';
    protected $primaryKey = 'pc_id';


    public static function loadAndSearchProgramCategory(){
        $query = self::where('program_category.is_deleted', '=', '0')
            ->join('users', 'program_category.created_by', 'users.id')
            ->join('program', 'prog_id', 'program.program_id');

        if (!empty(Request::get('searchKey'))) {
            $query = $query->where('pc_name', 'like', '%' . Request::get('searchKey') . '%');
        }
        if (!empty(Request::get('program_id'))) {
            $query = $query->where('prog_id', '=', Request::get('program_id'));
        }
        $query = $query->where('program.program_id','!=',37)->orderBy('program_category.created_at', 'desc')->paginate(10);
        return $query;
    }
}
