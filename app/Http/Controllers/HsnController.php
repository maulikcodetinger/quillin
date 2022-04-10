<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hsn;
use App\Models\Category;

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
        $categories = Category::where('parent_id', 0)
        ->where('digital', 0)
        ->with('childrenCategories')
        ->get();
        return view('backend.shipping.hsn.hsn_categories',compact('categories'));
        // return view('backend.product.products.product_categories', compact('categories'));

    }

    public function next_step(Request $request)
    {
        $category = Category::find($request->category_id);
        return view('backend.shipping.hsn.create',compact('category'));
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
        $hsn->category_id = $request->category_id;
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
        //this funciton using delete id
        if($id)
        {
            // return 123;
            Hsn::find($id)->delete();
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
        $hsn = Hsn::find($id);
        $categories = Category::all();
        return view('backend.shipping.hsn.edit',compact('hsn','categories'));
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
        $hsn->category_id = $request->category_id;
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
