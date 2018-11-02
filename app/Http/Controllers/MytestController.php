<?php

namespace App\Http\Controllers;

use App\Mytest;
use Illuminate\Http\Request;

class MytestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mytests.index');
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
        try
        {
            Mytest::create($request->all());

            return response()->json(['success' => 'data is successfully added'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mytest  $mytest
     * @return \Illuminate\Http\Response
     */
    public function show(Mytest $mytest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mytest  $mytest
     * @return \Illuminate\Http\Response
     */
    public function edit(Mytest $mytest)
    {
        try
        {
            return response()->json(['success' => 'data is successfully retrieved', 'data' => $mytest->toJson()], 200);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mytest  $mytest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mytest $mytest)
    {
        try
        {

            $mytest = Mytest::findOrFail($ytest->id);
            $mytest->name = $request->name;
            $mytest->cnum = $request->cnum;
            $mytest->email = $request->email;
            $mytest->address = $request->address;
            $mytest->update();

            return response()->json(['success' => 'data is successfully updated'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mytest  $mytest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mytest $mytest)
    {
        try
        {
            Mytest::destroy($mytest->id);

            return response()->json(['success' => 'data is successfully deleted'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
