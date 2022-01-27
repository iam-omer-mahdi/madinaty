<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = Subject::query()
            ->with('grade')
            ->orderBy('grade_id')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->input('filter'), function ($query, $filter) {
                $query->where('grade_id', 'like', "%{$filter}%");
            })
            ->get();

        $grades = Grade::all();

        return inertia('Subject/Index')->with(['subjects' => $subjects, 'filters' => $request->only('search'), 'grades' => $grades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        return inertia('Subject/Create')->with(['grades' => $grades]);
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
            'name' => 'required|string|unique:subjects',
            'mark' => 'required|numeric',
            'grade_id' => 'required|numeric'
        ]);

        $subject = Subject::create([
            'name' => $request->name,
            'mark' => $request->mark,
            'grade_id' => $request->grade_id
        ]);

        return Redirect::route('subjects.index', $subject)->with('success', 'تم االاضافة بنجاح');
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
        $subject = Subject::find($id);
        $grades = Grade::all();

        return inertia('Subject/Edit')->with(['subject' => $subject, 'grades' => $grades]);
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
        $subject = Subject::find($id);

        $request->validate([
            'name' => [
                'string',
                'required',
                Rule::unique('subjects')->ignore($subject->id),
            ],
            'mark' => 'required|numeric',
            'grade_id' => 'required|numeric'
        ]);


        $subject->name = $request->name;
        $subject->mark = $request->mark;
        $subject->grade_id = $request->grade_id;
        $subject->save();

        return Redirect::route('subjects.index', $subject)->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);

        if ($subject) {
            $subject->delete();
            return Redirect::route('subjects.index', $subject)->with('success', 'تم الحذف بنجاح');
        }
    }
}
