<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hsn;

class HsnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hsns = Hsn::paginate(10);
        return view('backend.shipping.hsn.index',compact('hsns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shipping.hsn.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hsn = new Hsn;
        $hsn->name = $request->name;
        $hsn->code = $request->code;
        $hsn->save();
        return redirect()->route('hsn.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hsn = Hsn::find($id);
        return view('backend.shipping.hsn.edit',compact('hsn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hsn = Hsn::find($id);
        $hsn->name = $request->name;
        $hsn->code = $request->code;
        $hsn->save();
        return redirect()->route('hsn.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 23;
    }
}
