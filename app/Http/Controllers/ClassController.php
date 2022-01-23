<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = Classes::query()
            ->with('grade')
            ->orderBy('grade_id')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->get();

        return inertia('Classes/Index')->with(['classes' => $classes, 'filters' => $request->only('search')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        return inertia('Classes/Create')->with(['grades' => $grades]);
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
            'name' => 'required|string|unique:classes',
            'grade_id' => 'required|numeric'
        ]);

        $class = Classes::create([
            'name' => $request->name,
            'grade_id' => $request->grade_id
        ]);

        return Redirect::route('classes.index', $class)->with('success', 'تمت االاضافة بنجاح');
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
        $cls = Classes::find($id);
        $grades = Grade::all();

        return inertia('Classes/Edit')->with(['cls' => $cls, 'grades' => $grades]);
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
        $class = Classes::find($id);

        $request->validate([
            'name' => [
                'string',
                'required',
                Rule::unique('classes')->ignore($class->id),
            ],
            'grade_id' => 'required|numeric'
        ]);


        $class->name = $request->name;
        $class->grade_id = $request->grade_id;
        $class->save();

        return Redirect::route('classes.index', $class)->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Classes::find($id);

        if ($class) {
            $class->delete();
            return Redirect::route('classes.index', $class)->with('success', 'تمت الحذف بنجاح');
        }
    }
}
