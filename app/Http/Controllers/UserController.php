<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       $this->middleware('auth');
       $this->middleware('admin')->only('index');
     }

    public function index()
    {
      $users = User::get();
      return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function show($id)
    {

      $user = User::where('id',Auth::user()->id)->first();

      return view('users.show', ['user'=> $user]);
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('users.edit', ['user'=>$user]);
    }


    public function update(Request $request, User $user)
    {
      $this->validation($request);

      $user->update(Input::all());

      if(Auth::check() && Auth::user()->role == 'admin'){

        return redirect()->route('users.index');

      }

      elseif(Auth::check()) {

        return redirect()->route('users.show', Auth::user()->id);

      }  
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
      $user->delete();

      return redirect()->route('users.index');
    }

    private function validation(Request $request)
    {

            $request->validate ([
              'name' => 'required|string|max:255',
              'surname' => 'required|string|max:255',
              'email' => 'required|string|email|max:255',
              'password' => 'required|string|min:6|confirmed'
            ]);
        }

}
