<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::query()
        ->with(['grade','school', 'cls'])
        ->orderBy('name')
        ->when($request->input('search'), function ($query, $search) {
            $query->where('name', 'like', "{$search}%")
                ->orWhere('email', 'like', "{$search}%");
        })
        ->when($request->input('school_filter'), function ($query, $filter) {
            $query->where('school_id', '=', "{$filter}");
        })
        ->when($request->input('grade_filter'), function ($query, $filter) {
            $query->where('grade_id', '=', "{$filter}");
        })
        ->when($request->input('class_filter'), function ($query, $filter) {
            $query->where('class_id', '=', "{$filter}");
        })
            ->paginate(12)
            ->withQueryString();
            
        $schools = School::all();
        $grades = Grade::all();
        $classes = Classes::all();

        if ($request->input('school_filter')) {
            $grades = Grade::where('school_id', '=', $request->input('school_filter'))->get();
        }
        if ($request->input('grade_filter')) {
            $classes = Classes::where('grade_id', '=', $request->input('grade_filter'))->get();
        }


        return inertia('Student/Index')->with(['students' => $students, 'filters' => $request->only('search'), 'grades' => $grades, 'schools' => $schools, 'classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $schools = School::all();
        $grades = Grade::all();
        $classes = Classes::all();

        if ($request->input('school_filter')) {
            $grades = Grade::where('school_id', '=', $request->input('school_filter'))->get();
        }
        if ($request->input('grade_filter')) {
            $classes = Classes::where('grade_id', '=', $request->input('grade_filter'))->get(); 
        }  

        return inertia('Student/Create')->with(['grades' => $grades, 'schools' => $schools, 'classes' => $classes]);
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
            'name' => 'required|string',
            'birth_date' => 'required|date',
            'email' => 'email|string|unique:students',
            'guardian_name' => 'required|string',
            'guardian_phone' => 'string',
            'school_id' => 'required|numeric',
            'grade_id' => 'required|numeric',
            'class_id' => 'required|numeric',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
            'school_id' => $request->school_id,
            'grade_id' => $request->grade_id,
            'class_id' => $request->class_id,
        ]);

        return Redirect::route('students.index', $student)->with('success', 'تم االاضافة بنجاح');
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
    public function edit(Request $request,$id)
    {
        $student = Student::find($id);
        $schools = School::all();
        $grades  = Grade::all();
        $classes = Classes::all();

        if ($request->input('school_filter')) {
            $grades = Grade::where('school_id', '=', $request->input('school_filter'))->get();
        }
        if ($request->input('grade_filter')) {
            $classes = Classes::where('grade_id', '=', $request->input('grade_filter'))->get();
        }  



        return inertia('Student/Edit')->with(['grades' => $grades, 'schools' => $schools, 'classes' => $classes, 'student' => $student]);
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
        $student = Student::find($id);

        $request->validate([
            'name' => 'required|string',
            'birth_date' => 'required|date',
            'email' => [
                'email',
                Rule::unique('students')->ignore($student->id), 
            ],
            'guardian_name' => 'required|string',
            'guardian_phone' => 'string',
            'school_id' => 'required|numeric',
            'grade_id' => 'required|numeric',
            'class_id' => 'required|numeric',
        ]);

        
        $student->name = $request->name;
        $student->birth_date = $request->birth_date;
        $student->email = $request->email;
        $student->guardian_name = $request->guardian_name;
        $student->guardian_phone = $request->guardian_phone;
        $student->school_id = $request->school_id;
        $student->grade_id = $request->grade_id;
        $student->class_id = $request->class_id;
        $student->save();

        return Redirect::route('students.index', $student)->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            return Redirect::route('students.index', $student)->with('success', 'تم الحذف بنجاح');
        }
    }
}
