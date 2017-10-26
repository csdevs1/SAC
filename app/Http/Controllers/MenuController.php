<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Role;
use App\Menu;
use App\Submenu;
use App\RolePermission;

class MenuController extends Controller
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
    public function get_submenu(Request $request)
    {
        $menu_id=$request->menu_id;
        $role_id=$request->id_role;
        $submenu_options=Submenu::select(['id','name'])->where('menu_id',$menu_id)->get();
        $response=array();
        foreach($submenu_options as $key=>$option){
            $permissions=RolePermission::select(['id','id_permission'])->where('id_menu',$menu_id)->where('id_role',$role_id)->where('id_submenu',$option->id)->get();
            $temp=array(
                'id'=>$option->id,
                'name'=>$option->name,
                'permission'=>$permissions
            );
            array_push($response,$temp);
        }
        \Log::info($response);
        return response()->json($response);
    }
}
