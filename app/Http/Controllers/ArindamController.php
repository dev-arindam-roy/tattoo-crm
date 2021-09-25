<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ArindamController extends Controller
{
    
    public function module()
    {
        return view('dashboard.arindam.module');
    }

    public function moduleSave(Request $request)
    {
        DB::table('dashboard_module')->insert([
            'name' => $request->input('name')
        ]);
        return back();
    }

    public function permission()
    {
        $DataBag = array();
        $DataBag['module'] = DB::table('dashboard_module')->get();
        return view('dashboard.arindam.permission', $DataBag);
    }

    public function permissionSave(Request $request)
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        DB::table('permissions')->insert([
            'module_id' => $request->input('module_id'),
            'name' => $request->input('name'),
            'guard_name' => 'web',
            'created_at' => Date('Y-m-d H:i:s')
        ]);
        return back();
    }
}
