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
}
