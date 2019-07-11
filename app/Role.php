<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model {
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];
    protected $casts = [
        'permissions' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }

    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
    }

    private function hasPermission(string $permission) : bool
    {
        return $this->permissions[$permission] ?? false;
    }

    public static function createUserRole($data) {
        $date = date('Y-m-d H:i:s');
        $row_id = DB::table('role_users')->insertGetId(
            [
                'role_id' => $data['role_id'],
                'user_id' => $data['user_id'],
                'created_at' => $date
            ]
        );

        return $row_id;
    }

    public static function updateUserRole($data) {
        $date = date('Y-m-d H:i:s');
        $row_id = DB::table('role_users')->where('user_id', $data['user_id'])
        ->update([
            'role_id' => $data['role_id'],
            'updated_at' => $date
        ]);

        return $row_id;
    }
}
