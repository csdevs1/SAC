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

class PermissionController extends Controller
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
    public function show($role_id)
    {
        $role=Role::select(['id','role_name'])->where('id',$role_id)->get();
        $menu_options=Menu::select(['id','name'])->get();
        $response=array();
        foreach($menu_options as $key=>$val){
            $submenu=Submenu::select(['id'])->where('menu_id',$val->id)->get();
            $permissions=RolePermission::select(['id','id_role','id_permission','id_menu'])->where('id_menu',$val->id)->where('id_role',$role_id)->get();
            $temp=array(
                'id'=>$val->id,
                'name'=>$val->name,
                'submenu'=>$submenu,
                'permission'=>$permissions
            );
            array_push($response,$temp);
        }
        return view('permissions.add')->with('menu_options',$response)->with('role',$role);
    }

    private function create($role_permission){
        try{
            //dd($role_permission);
            $input=array();
            $input['id_role']=$role_permission['id_role'];
            $input['id_permission']=$role_permission['id_permission'];
            $input['id_menu']=$role_permission['id_menu'];
            if(isset($role_permission['id_menu']) && !empty($role_permission['id_menu']))
                $input['id_submenu']=$role_permission['id_submenu'];
            $role_permission_id=RolePermission::insertGetId($input);
            \Log::info($role_permission_id);
            return $role_permission_id;
        }catch(\Exception $e){
            \Log::info($e);
            dd($e);
            return false;
        }
    }
    
    private function delete($id_role,$id_permission,$id_menu,$id_submenu){
        try{
            \Log::info("id_submenu: ".$id_submenu);
            if(empty($id_submenu)){
                $response=RolePermission::where('id_role',$id_role)
                        ->where('id_permission',$id_permission)
                        ->where('id_menu',$id_menu)
                        ->delete();
            }else{
                $response=RolePermission::where('id_role',$id_role)
                        ->where('id_permission',$id_permission)
                        ->where('id_menu',$id_menu)
                        ->where('id_submenu',$id_submenu)
                        ->delete();
            }
            return response()->json($response);
        }catch(\Exception $e){
            return response()->json($e);
        }
    }
    
    public function createPermission(Request $request){
        $role_permission=$request;
        $response=$this->create($role_permission);
    }
    public function deletePermission(Request $request){
        $role_permission=$request;
        $id_role=$role_permission['id_role'];
        $id_permission=$role_permission['id_permission'];
        $id_menu=$role_permission['id_menu'];
        $id_submenu='';
        if(isset($role_permission['id_submenu']) && !empty($role_permission['id_submenu']))
            $id_submenu=$role_permission['id_submenu'];
        $response=$this->delete($id_role,$id_permission,$id_menu,$id_submenu);
    }
}
