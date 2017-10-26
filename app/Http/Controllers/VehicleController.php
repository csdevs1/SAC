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

class VehicleController extends Controller
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
    public function get_by_company(Request $request)
    {
        $id_company=$request['company_id'];
        $plates=Vehicle::select(['id','plate'])->where('company_id',$id_company)->get();
        \Log::info($plates);
        return response()->json($plates);
    }
}
