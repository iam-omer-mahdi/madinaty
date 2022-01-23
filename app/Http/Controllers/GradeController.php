<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grades = Grade::query()
            ->with('school')
            ->orderBy('school_id')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->input('filter'), function ($query, $filter) {
                $query->where('school_id', 'like', "%{$filter}%");
            })
            ->get();

        $schools = School::all();

        return inertia('Grade/Index')->with(['grades' => $grades, 'filters' => $request->only('search'), 'schools' => $schools ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        return inertia('Grade/Create')->with(['schools' => $schools]);
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
            'name' => 'required|string|unique:grades',
            'school_id' => 'required|numeric'
        ]);

        $grade = Grade::create([
            'name' => $request->name,
            'school_id' => $request->school_id
        ]);

        return Redirect::route('grades.index', $grade)->with('success', 'تم االاضافة بنجاح');
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
        $grade = Grade::find($id);
        $schools = School::all();

        return inertia('Grade/Edit')->with(['grade' => $grade, 'schools' => $schools]);
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
        $grade = Grade::find($id);

        $request->validate([
            'name' => [
                'string',
                'required',
                Rule::unique('grades')->ignore($grade->id),
            ],
            'school_id' => 'required|numeric'
        ]);


        $grade->name = $request->name;
        $grade->school_id = $request->school_id;
        $grade->save();

        return Redirect::route('grades.index', $grade)->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::find($id);

        if ($grade) {
            $grade->delete();
            return Redirect::route('grades.index', $grade)->with('success', 'تم الحذف بنجاح');
        }
    }
}
