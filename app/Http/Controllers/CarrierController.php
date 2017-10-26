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
use App\Carrier;
use App\Group;
use App\CarrierGroup;

class CarrierController extends Controller
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
    public function getCarrier(Request $request)
    {
        $company_group_id=$request['company_group_id'];
        $carrier_group=CarrierGroup::select(['id as cg_id','carrier_id','company_group_id'])->where('company_group_id',$company_group_id)->get();
        $carrier=array();
        foreach($carrier_group as $key=>$cg){
            $temp=array(
                'cg_id'=>$cg->cg_id,
                'carrier'=>$cg->carrier
            );
            array_push($carrier,$temp);
        }
        \Log::info('$carrier: '.json_encode($carrier,true));
        return response()->json($carrier);
    }
}
