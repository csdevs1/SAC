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
use App\Company;
use App\Ticket;
use App\Employee;
use App\Checklist;
use App\ChecklistTicket;
use App\Service;
use App\ServiceTicket;

class TicketController extends Controller
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
        $companies=Company::orderBy('name')->get();
        $ticket_types=DB::table('ticket_type')->orderBy('name')->get();
        $devices=DB::table('devices')->orderBy('name')->get();
        $tsac=DB::table('support_technicians')->orderBy('name')->get();
        return view('tickets.add')
            ->with('ticket_types',$ticket_types)
            ->with('devices',$devices)
            ->with('tsac',$tsac)
            ->with('companies',$companies);
    }

    private function save($input){
        try{
            $ticket_id=Ticket::insertGetId($input);
            \Log::info(json_encode($ticket_id,true));
            return $ticket_id;
        }catch(\Exception $e){
            \Log::info($e);
            return false;
        }

    }

    public function create(Request $request){
        $input=json_decode($request['ticket_data'],true);
        $input['id_user']=Auth::user()->id;
        \Log::info($input);
        $response=$this->save($input);
        return response()->json($response);
    }

    private function update($input,$id){
        try{
            return Ticket::where('id',$id)
                ->update($input);
        }catch(\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function edit(Request $request){
        $tck_id=$request['tck_id'];
        $input=json_decode($request['ticket_data'],true);
        $response=$this->update($input,$tck_id);
        \Log::info($response);
        return response()->json($tck_id);
    }

    public function getTicketsByStatus(Request $request){
        $status=$request->only('status');
        \Log::info($status);
        $t=Ticket::where('status',$status)->orderBy('created_at')->get();
        $pending=array();
        foreach($t as $k=>$v){
            switch($v['priority']){
                case 1:
                    $priority='Baja';
                    break;
                case 2:
                    $priority='Media';
                    break;
                case 3:
                    $priority='Alta';
                    break;
            }
            $created_at=date("d-m-Y", strtotime($v['updated_at']));
            $employee=Employee::select(['id','company_id','name'])->where('id',$v['reported_by'])->first();
            $company=$employee->company;
            $dEnd = date("d-m-y");
            $dDiff = $dEnd-$created_at;
            $tmp=array(
                'id'=>$v['id'],
                'title'=>$v['title'],
                'priority'=>$priority,
                'report'=>$v['report'],
                'solution'=>$v['solution'],
                'company'=>$company['name'],
                'reported_by'=>$employee['name'],
                'days_diff'=>$dDiff,
                'created_at'=>$created_at
            );
            array_push($pending,$tmp);
        }

        return response()->json($pending);
    }

    public function getTickets(Request $request){
        $tck_id=$request->only('ticket_id');
        $ticket=Ticket::find($tck_id)->first();
        $support_sac=$ticket->sac;
        $reported_by=$ticket->employee;
        $device=$ticket->device;
        $vehicle=$ticket->vehicle;
        $detail=$ticket->report;
        $solution=$ticket->solution;
        $ticketType=$ticket->ticket_type;
        $carrierGroup=$ticket->carrierGroup;
        $companyGroup=$ticket->companyGroup;
        $group=$companyGroup->group;
        $company=$companyGroup->company;

        if($ticket->status){
            $stat='Abierto';
            $icon='lock_open';
            $bool=$ticket->status;
        }else{
            $stat='Cerrado';
            $icon='lock_outline';
            $bool=$ticket->status;
        }
        $status=array('status'=>$bool,'status'=>$stat,'icon'=>$icon); //Using Material Icon

        switch($ticket['priority']){
            case 1:
                $priority=array('priority'=>'Baja','icon'=>'star_border'); //Using Material Icon
                break;
            case 2:
                $priority=array('priority'=>'Media','icon'=>'star_half'); //Using Material Icon
                break;
            case 3:
                $priority=array('priority'=>'Alta','icon'=>'star'); //Using Material Icon
                break;
            default:
                $priority=array();
                break;
        }
        $response=array(
            'ticket_id'=>$tck_id,
            'title'=>$ticket['title'],
            'ticket_priority'=>$priority,
            'priority_id'=>$ticket['priority'],
            'status'=>$status,
            'detail'=>$detail,
            'solution'=>$solution,
            'support_sac'=>array('id'=>$support_sac['id'],'name'=>$support_sac['name']),
            'reported_by'=>$reported_by,
            'origin'=>$device,
            'companyGroup'=>$companyGroup,
            'vehicle'=>$vehicle,
            'carrierGroup'=>$carrierGroup,
            'device'=>$device,
            'type'=>$ticketType,
            'checklist_items'=>$device->items,
        );
        \Log::info('Response: '.json_encode($response,true));
        return response()->json($response);
    }

    //CHECLIST
    public function getTicketChecklist(Request $request){
        $device_id=$request->only('device_id');
        $ticket_id=$request['ticket_id'];
        $items=Checklist::select(['id','name'])->where('device_id',$device_id)->get();
        $arr=array();
        foreach($items as $k=>$item){
            $bool=ChecklistTicket::where('ticket_id',$ticket_id)->where('checklist_id',$item['id'])->first()?true:false;
            $observation=ChecklistTicket::select(['observation'])->where('ticket_id',$ticket_id)->where('checklist_id',$item['id'])->first();
            $temp=array(
                'id'=>$item['id'],
                'name'=>$item['name'],
                'checked'=>$bool,
                'observation'=>$observation['observation']
            );
            array_push($arr,$temp);
        }
        return response()->json($arr);
    }
    
    private function save_checklist($input){
        try{
            $chk_tck=ChecklistTicket::insert($input);
            return $chk_tck;
        }catch(\Exception $e){
            \Log::info($e);
            return false;
        }

    }

    public function create_checklist(Request $request){
        $checked=json_decode($request['checklist_data'],true);
        $chck_tck=ChecklistTicket::where('ticket_id',$request['tck_id'])->first();
        if(isset($chck_tck) && !empty($chck_tck))
            ChecklistTicket::where('ticket_id',$request['tck_id'])->forcedelete();
        $response=$this->save_checklist($checked);
        \Log::info($response);
        return response()->json($response);
    }

    //SERVICES
    public function getTicketService(Request $request){
        $device_id=$request->only('device_id');
        $ticket_id=$request['ticket_id'];
        $type=$request['type'];
        $items=Service::select(['id','name','type'])->where('device_id',$device_id)->where('type',$type)->get();
        $arr=array();
        foreach($items as $k=>$item){
            $cant=ServiceTicket::select(['cant'])->where('ticket_id',$ticket_id)->where('service_id',$item['id'])->first();
            $temp=array(
                'id'=>$item['id'],
                'name'=>$item['name'],
                'cant'=>$cant['cant']
            );
            array_push($arr,$temp);
        }
        \Log::info("Serice Items: ".json_encode($arr,true));
        return response()->json($arr);
    }

    private function save_service($input){
        try{
            $srv_tck=ServiceTicket::insert($input);
            return $srv_tck;
        }catch(\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function create_service(Request $request){
        $services=json_decode($request['services'],true);
        $service_id=$request['service_id'];
        $srv_tck=ServiceTicket::where('ticket_id',$request['tck_id'])->where('service_id',$service_id)->first();
        if(isset($srv_tck) && !empty($srv_tck))
            $response=ServiceTicket::where('ticket_id',$request['tck_id'])->where('service_id',$service_id)->update($services);
        else
            $response=$this->save_service($services);
        \Log::info($response);
        return response()->json($response);
    }
}
