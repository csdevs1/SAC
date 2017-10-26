<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Ticket;
use App\Sac;

class HomeController extends Controller
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
        $users=User::count();
        $technicians=Sac::count();
        $companies=Company::count();
        $tickets=Ticket::count();
        $open_tickets=Ticket::where('status',true)->count();
        $closed_tickets=Ticket::where('status',false)->count();
        return view('home')
            ->with('users',$users)
            ->with('technicians',$technicians)
            ->with('tickets',$tickets)
            ->with('open_tickets',$open_tickets)
            ->with('closed_tickets',$closed_tickets)
            ->with('companies',$companies);
    }
}
