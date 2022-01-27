<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schools = School::query()
                            ->when($request->input('search'), function($query, $search) {
                                $query->where('name','like', "%{$search}%");
                            })
                            ->latest()
                            ->get();
        
                        return inertia('School/Index')->with(['schools' => $schools, 'filters' => $request->only('search')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('School/Create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:schools',
        ]);

        $school = School::create([
            'name' => $request->name
        ]);
        
        return Redirect::route('schools.index', $school)->with('success','تمت االاضافة بنجاح');
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
        $school = School::find($id);

        if (!$school) {
            $schools = School::latest()->get();
            return inertia('School/Index', compact('schools'))->with('success','المدرسة غير موجودة');    
        }

        return inertia('School/Edit')->with(['school' => $school]);
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
        $school = School::find($id);

        $request->validate([
            'name' => [
                'string',
                'required',
                Rule::unique('schools')->ignore($school->id),
            ],
        ]);

        
        $school->name = $request->name;
        $school->save();

        return Redirect::route('schools.index', $school)->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);

        if ($school) {   
            $school->delete();   
            return Redirect::route('schools.index', $school)->with('success', 'تمت الحذف بنجاح');
        }
    }
}
