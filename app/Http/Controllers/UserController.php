<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use App\User;
class UserController extends Controller{
	
	public function __contruct()
	{
	}
    
    public function index(){
        $users=User::OrderBy('name','DESC')->get();
        return view('welcome')
            ->with('users', $users);
    }

    public function get(){
        $users=User::get();
        $arr=array();
        foreach($users as $k=>$user){
            $role=$user->role;
            $temp=array(
                'id'=>$user->id,
                'name'=>$user->name,
                'email'=>$user->email,
                'username'=>$user->username,
                'profile_pic'=>$user->profile_pic,
                'role'=>array('id'=>$role->id,'role_name'=>$role->role_name),
            );
            array_push($arr,$temp);
        }
        \Log::info($arr);
        return response()->json($arr);
    }
    public function getUserById(Request $request){
        $u_id=$request->only('id');
        $user=User::find($u_id);
        $role=$user[0]->role;
        $arr=array(
            'id'=>$user[0]->id,
            'name'=>$user[0]->name,
            'email'=>$user[0]->email,
            'username'=>$user[0]->username,
            'role'=>array('id'=>$role->id,'role_name'=>$role->role_name),
        );
        \Log::info($arr);
        return response()->json($arr);
    }

    private function update($input,$user_id){
        try{
            $user=User::where('id',$user_id)->update($input);
            return $user;
        }catch(\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function edit(Request $request){
        $input=json_decode($request['arr'],true);
        $user_id=$request['id'];

        $response=$this->update($input,$user_id);
        \Log::info(json_encode($response,true));
        return response()->json($response);
    }
}
