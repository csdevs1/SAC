<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Ticket;
use App\Sac;

class SacController extends Controller
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
    public function get()
    {
        $technicians=Sac::OrderBy('id')->get();
        return response()->json($technicians);
    }

    public function getTechnicianById(Request $request){
        $s_id=$request->only('id');
        $sac=Sac::find($s_id);
        $arr=array(
            'id'=>$sac[0]->id,
            'name'=>$sac[0]->name
        );
        \Log::info('SAC: '.json_encode($arr,true));
        return response()->json($arr);
    }

    private function update($input,$id){
        try{
            $sac=Sac::where('id',$id)->update($input);
            return $sac;
        }catch(\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function edit(Request $request){
        $input=json_decode($request['arr'],true);
        $sac_id=$request['id'];
        $response=$this->update($input,$sac_id);
        \Log::info(json_encode($response,true));
        return response()->json($response);
    }
}
