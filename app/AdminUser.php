<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Models\Role;

class AdminUser extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
   
    use Notifiable, HasRoles;

    protected $fillable = [
        'role_id',
        'user_type',
        'first_name',
        'last_name',
        'username',
        'email',
        'mobile',
        'password',
        'avatar',
        'designation',
        'gender',
        'address',
        'location',
        'dd',
        'mm',
        'yy',
        'nationality',
        'status',
        'can_login',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gcCaptures()
    {
        return $this->hasMany('App\Capturegc');
    }

    public static function myUser()
    {
        return AdminUser::where('user_type', 3)->count();
    }

    public static function myAdmin()
    {
        return AdminUser::where('user_type', 2)->count();
    }

    public static function getPermissionGroups()
    {
        $permission_groups = DB::table('permissions')->select('group_name as name')->groupBy('group_name')->get();
        return $permission_groups;
    }

    public static function getPermissionByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('name', 'id')
            ->where('group_name', $group_name)
            ->get();
        return $permissions;
    }
    public function SDname() 
    {
        return $this->belongsTo(AdminUser::class, 'created_by', 'id');
    }
}
