<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DangKien\RolePer\RolePerPermission;

class Permission extends RolePerPermission
{
    protected $table = 'permissions';

    public function permission_group() {
    	return $this->belongsTo('App\Models\PermissionGroup', 'permission_group_id', 'id');
    }

    public function roles () {
        return $this->belongsToMany('App\Models\Role', 'permission_role', 'permission_id', 'role_id');
    }
}
