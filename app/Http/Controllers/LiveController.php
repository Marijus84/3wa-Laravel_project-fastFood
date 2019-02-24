<?php

namespace App\Http\Controllers;

use App\Live;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class LiveController extends Controller
{

    public function __construct()
    {
      $this->middleware('admin')->only('index', 'destroy');

    }

    public function index()
    {
      $lives = Live::get();

      return view('lives.index', ['lives' => $lives]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      if ($request->title) {
        Live::create(Input::all());
      }

        $lives = Live::orderBy('created_at', 'desc')->take($request->loadLives)->get();
        foreach ($lives as $live) {
          $live->posted = $live->updated_at->diffForHumans();

        }

      echo json_encode($lives);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\live  $live
     * @return \Illuminate\Http\Response
     */
    public function show(live $live)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\live  $live
     * @return \Illuminate\Http\Response
     */
    public function edit(live $live)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\live  $live
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, live $live)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\live  $live
     * @return \Illuminate\Http\Response
     */
    public function destroy(live $life, Request $request)
    {
      $life->delete();
      $request->session()->flash('message', 'You have deleted live message!');
      return redirect()->route('lives.index');
    }
}
