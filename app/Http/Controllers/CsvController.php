<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Csv;
use App\Models\Category;

class CsvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $csvs = Csv::paginate(10);
        return view('backend.upload.csv.index',compact('csvs'));
    }

    /**
     * Show the form for creating a new  resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.upload.csv.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file;
        $name = $file->getClientOriginalName();  
        $file_name = $file->move('csv-files/',$name);  
            
        $csv = new Csv;
        $csv->category_id = $request->category_id;
        $csv->file = $file_name;
        $csv->save();
        return redirect()->route('csv.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //this funciton using delete id
        if($id)
        {
            // return 123;
            Csv::find($id)->delete();
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $csv = Csv::find($id);
        $categories = Category::all();
        return view('backend.upload.csv.edit',compact('categories','csv'));
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
        $file = $request->file;
        $name = $file->getClientOriginalName();  
        $file_name = $file->move('csv-files/',$name);  
    
        $csv = Hsn::find($id);
        $csv->category_id = $request->category_id;
        $csv->file = $file_name;
        $csv->save();
        
        return redirect()->route('csv.index');
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
