<?php

namespace App\Http\Controllers;

use App\Dependence;
use Illuminate\Http\Request;

class DependenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependences = Dependence::paginate(15);
        return view('dependence.index',[ 'dependences'=> $dependences]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dependence.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dependence = Dependence::create([
            'code' => $request['code'],
            'name' => $request['name'],
        ]);
        return redirect()->route('dependences.home')->with('status',$dependence->name.' creada.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dependence  $dependence
     * @return \Illuminate\Http\Response
     */
    public function show(Dependence $dependence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dependence  $dependence
     * @return \Illuminate\Http\Response
     */
    public function edit(Dependence $dependence)
    {
        return view('dependence.edit',['dependence' => $dependence]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dependence  $dependence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dependence $dependence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dependence  $dependence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependence $dependence)
    {
        //
    }

    public function getDependences(Request $request)
    {
        $dependences = Dependence::orderBy('created_at','desc');
        if($request->has('code')){
            $dependences->where('code','like','%'.$request->code.'%');
        }
        if($request->has('name')){
            $dependences->where('name','like','%'.$request->name.'%');
        }
        return response()->json($dependences->paginate(10));
    }
}
