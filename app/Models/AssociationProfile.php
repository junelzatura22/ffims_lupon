<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssociationProfile extends Model
{
    use HasFactory;


    public static function showAll()
    {
        $query = DB::table('association_profiles')->select("association.as_id", "association_profiles.assoc_id", "association.namedesc as name")
            ->join('association', 'association.as_id', 'association_profiles.assoc_id')
            ->orderBy('association_profiles.created_at', 'asc')->groupBy('association.as_id')->get();
        return $query;
    }

    public static function loadMembers($associationId, $type)
    {

        $query = DB::table('association_profiles')->select(
            "association_profiles.*",
            'association_profiles.assoc_id',
            "association.namedesc as name",
            DB::RAW("concat(fname,' ',lname,' ',extname) as farmer")
        )
            ->join('association', 'association.as_id', 'association_profiles.assoc_id')
            ->join('farmerfisherfolk', 'farmerfisherfolk.ff_id', 'association_profiles.entity')
            ->where('association_profiles.assoc_id', '=', $associationId)
            ->orderBy('association_profiles.assoc_order', 'asc')->get();
        return $query;
    }

    public static function loadData($associationId, $type)
    {
        $officials = DB::table('association_profiles')->select(
            "association_profiles.*",
            'association_profiles.assoc_id',
            "association.namedesc as name",
            DB::RAW("concat(fname,' ',lname,' ',extname) as farmer")
        )
            ->join('association', 'association.as_id', 'association_profiles.assoc_id')
            ->join('farmerfisherfolk', 'farmerfisherfolk.ff_id', 'association_profiles.entity')
            ->where('association_profiles.assoc_id', '=', $associationId)
            ->where('assoc_position','!=','Member')
            ->orderBy('association_profiles.assoc_order', 'asc')->get();

        $members = DB::table('association_profiles')->select(
            "association_profiles.*",
            'association_profiles.assoc_id',
            "association.namedesc as name",
            DB::RAW("concat(fname,' ',lname,' ',extname) as farmer")
        )
            ->join('association', 'association.as_id', 'association_profiles.assoc_id',)
            ->join('farmerfisherfolk', 'farmerfisherfolk.ff_id', 'association_profiles.entity')
            ->where('association_profiles.assoc_id', '=', $associationId)
            ->where('assoc_position', '=', 'Member')
            ->orderBy('created_at', 'asc')->get();

        $query = $type == "Member" ? $members : $officials;
        return $query;
    }

    public static function getPresidentDetails($associationId)
    {
        $query = DB::table('association_profiles')->select(
            "association_profiles.*",
            'association_profiles.assoc_id',
            "association.namedesc as name",
            DB::RAW("concat(fname,' ',lname,' ',extname) as farmer"),
            "farmerfisherfolk.picture as imahe"
        )
            ->join('association', 'association.as_id', 'association_profiles.assoc_id')
            ->join('farmerfisherfolk', 'farmerfisherfolk.ff_id', 'association_profiles.entity')
            ->where(['association_profiles.assoc_id' => $associationId, 'association_profiles.assoc_position' => 'President'])
            ->first();
        return $query;
    }
}
