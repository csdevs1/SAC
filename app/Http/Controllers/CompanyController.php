<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Role;
use App\Menu;
use App\Submenu;
use App\Vehicle;
use App\Company;
use App\Group;
use App\CompanyGroup;

class CompanyController extends Controller
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
    public function get_groups(Request $request)
    {
        $id_company=$request['company_id'];
        $company_group=CompanyGroup::select(['id as cp_id','company_id','group_id'])->where('company_id',$id_company)->get();
        $group=array();
        foreach($company_group as $key=>$cg){
            $temp=array(
                'cp_id'=>$cg->cp_id,
                'group'=>$cg->group
            );
            array_push($group,$temp);
        }
        \Log::info($group);
        return response()->json($group);
    }

    public function get_companies(){
        $companies=Company::get();
        $arr=array();
        foreach($companies as $k=>$v){
            $temp=array(
                'id'=>$v->id,
                'name'=>$v->name,
                'phone'=>$v->phone,
                'logo'=>$v->logo,
                'n_employees'=>$v->employees->count()
            );
            array_push($arr,$temp);
        }
        \Log::info('Companies: '.json_encode($arr));
        return response()->json($arr);
    }
}
