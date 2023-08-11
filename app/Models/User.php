<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

 
    public static function showAllUsers()
    {
        $userData = DB::table('users')->select('users.*')
            ->where('id', '!=', Auth::user()->id);
        if (!empty(Request::get('nameKey'))) {
            $userData = $userData->where(DB::raw('concat(name," ",lastname)'), 'like', '%' . Request::get('nameKey') . '%');
        }
        if (!empty(Request::get('roleKey'))) {
            $userData = $userData->where('role', 'like', '%' . Request::get('roleKey') . '%');
        }
        if (!empty(Request::get('desKey'))) {
            $userData = $userData->where('designation', 'like', '%' . Request::get('desKey') . '%');
        }
        $userData = $userData->orderBy('created_at', 'desc')->get();

        return $userData;
    }

//     SELECT *, (select count(*) from assigned_program a where a.ac_userd_id = u.id ) as totalCommodity
// FROM users u
    public static function userHard()
    {
        // $userData = DB::table('users')->select(DB::RAW('SELECT *, IFNULL((select count(*) from assigned_program a where a.ac_userd_id = u.id group by a.ac_userd_id),0) as totalCommodity
        // FROM users u'));
        $userData = DB::table('users')->select('users.*',DB::raw('IFNULL((select count(*) 
        from assigned_program a where a.ac_userd_id = users.id group by a.ac_userd_id),0) as totalCommodity'),
        DB::raw('IFNULL((select count(*) 
        from assigned_barangay a where a.ab_user_id = users.id group by a.ab_user_id),0) as totalBarangay'))
            ->where('id', '!=', Auth::user()->id);
        if (!empty(Request::get('nameKey'))) {
            $userData = $userData->where(DB::raw('concat(name," ",lastname)'), 'like', '%' . Request::get('nameKey') . '%');
        }
        if (!empty(Request::get('roleKey'))) {
            $userData = $userData->where('role', 'like', '%' . Request::get('roleKey') . '%');
        }
        if (!empty(Request::get('desKey'))) {
            $userData = $userData->where('designation', 'like', '%' . Request::get('desKey') . '%');
        }
        // $userData = $userData->join('assigned_program','users.id','assigned_program.ac_userd_id')->get();
        $userData = $userData->orderBy('created_at', 'desc')->get();

        return $userData;
    }
}
