<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Role;
use App\Menu;
use App\Submenu;
use App\Employee;

class EmployeesController extends Controller
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
        $employees=Employee::select(['id','name','position'])->where('company_id',$id_company)->where('enable',true)->get();
        \Log::info($employees);
        return response()->json($employees);
    }
    public function get_employee_info(Request $request)
    {
        $employee_id=$request['employee_id'];
        $employee=Employee::select(['position','email','phone'])->where('id',$employee_id)->where('enable',true)->first();
        \Log::info($employee);
        return response()->json($employee);
    }
}
