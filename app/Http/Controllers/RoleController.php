<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Role;
use App\Menu;
use App\Submenu;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $roles=Rol::select(['id','role_name'])->get();
        $response=array();
        foreach($roles as $key=>$role){
            $permissions=$role->role_permission;
            $temp=array(
                'id'=>$role->id,
                'role_name'=>$role->role_name,
                'permission'=>$permissions
            );
            array_push($response,$temp);
        }
        return view('roles.show')->with('roles',$response);
    }

    public function get()
    {
        $roles=Role::get();
        \Log::info('$roles: '.json_encode($roles,true));
        return response()->json($roles);
    }
}
