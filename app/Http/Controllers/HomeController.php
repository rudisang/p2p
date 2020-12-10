<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lender;
use App\Models\User;
use App\Models\Application;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if(request()->has('search')){
            $search = request()->get('search');
            $ld = Lender::where('company_name', 'like', '%'.$search.'%')->orderBy('created_at','desc')->paginate(10);
          }else{        $ld = Lender::orderBy('created_at','desc')->paginate(10);
          }

        if($user->lenders){
            return view('home')->with('ld', $ld)->with('lenders', $user->lenders)->with('applications', $user->applications)->with('loanapps', $user->lenders->applications);
        }else{
            
            return view('home')->with('ld', $ld)->with('lenders', $user->lenders)->with('applications', $user->applications);
        }
        
    }
}
