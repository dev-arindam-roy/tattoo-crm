<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardModules extends Model
{
    protected $table = 'dashboard_module';
    protected $primaryKey = "id";
    public $timestamps = false;
    
    public function modulePermissions() {
        return $this->hasMany('App\Models\Permissions', 'module_id', 'id');
    }

}
