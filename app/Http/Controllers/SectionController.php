<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class SectionController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:Sections'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:Add Section'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Edit Section'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Delete Section'], ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $sections = Section::all();
        return view('sections.sections', [
            'sections' => $sections
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_name' => 'required|unique:sections',
        ]);
        Section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => Auth::user()->name,
        ]);
        return back()->with('success', 'Section Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request, [
            'section_name' => 'required|unique:sections,section_name,' . $id,

        ]);
        $sections = Section::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);
        session()->flash('edit', "done");
        return back()->with('success', 'Section edited successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::destroy($id);
        return back()->with('success1', 'Section deleted successfully');
    }
}
