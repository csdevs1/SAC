<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Role;
use App\Menu;
use App\Submenu;
use App\Device;
use App\RolePermission;
use App\Company;
use App\Ticket;
use App\Employee;
use App\Checklist;
use App\ChecklistTicket;
use App\Service;
use App\ServiceTicket;

class GraphController extends Controller
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
    public function index()
    {
        $users=User::get();
        return view('stats.graph')
                ->with('users',$users);
    }

    public function getNTicketByAttention(Request $request){
        $date_init=$request->input('date_init');
        $date_end=$request->input('date_end');
        $tickets_email=Ticket::select(['id'])->where('created_at','>=',$date_init)->where('created_at','<=',$date_end)->where('attention','email')->get();
        $tickets_phone=Ticket::select(['id'])->where('created_at','>=',$date_init)->where('created_at','<=',$date_end)->where('attention','telefono')->get();
        $tickets_on_site=Ticket::select(['id'])->where('created_at','>=',$date_init)->where('created_at','<=',$date_end)->where('attention','presencial')->get();

        $response=array(
            'email'=>$tickets_email,
            'phone'=>$tickets_phone,
            'on_site'=>$tickets_on_site
        );

        \Log::info('Tickets by attention: '.json_encode($response,true));

        return response()->json($response);
    }

    public function getNTicketByDevice(Request $request){
        $date_init=$request->input('date_init');
        $date_end=$request->input('date_end');

        $devices=Device::select(['id','name'])->get();
        $response=array();
        foreach($devices as $key=>$val){
            $tickets=Ticket::select(['id'])->where('created_at','>=',$date_init)->where('created_at','<=',$date_end)->where('id_device',$val->id)->get();
            $temp=array(
                'id'=>$val->id,
                'name'=>$val->name,
                'tickets'=>$tickets
            );
            array_push($response,$temp);
        }
        \Log::info($response);
        return response()->json($response);
    }
}
