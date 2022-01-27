<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Mark;
use App\Models\Grade;
use App\Models\Result;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $grades = Grade::with('exam','subject')->get();
        $results = Result::with('student','mark')->get();
        $subjects = null;
        $exams = null;
        $classes = Classes::all();
        
        if ($request->input('grade_filter')) {
            $exams = Exam::where('grade_id', '=', $request->input('grade_filter'))->get();
            $results = Result::where('grade_id', '=', $request->input('grade_filter'))->with('student', 'mark','exam')->get();
            $subjects = Subject::where('grade_id', '=', $request->input('grade_filter'))->get();
            $classes = Classes::where('grade_id', '=', $request->input('grade_filter'))->get();
        }
        
        if ($request->input('exam_filter')) {
            $exams = Exam::where('grade_id', '=', $request->input('grade_filter'))->get();
            $results = Result::where(
                [
                    ['grade_id', '=', $request->input('grade_filter')],
                    ['exam_id', '=', $request->input('exam_filter')]
                ])->with('student', 'mark','exam')->get();

            $subjects = Subject::where('grade_id', '=', $request->input('grade_filter'))->get();
        }

        return inertia('Result/Index')->with(['classes' => $classes,'results' => $results,'grades' => $grades, 'exams' => $exams, 'subjects' => $subjects,'grade_filter' => $request->input('grade_filter'), 'exam_filter' => $request->input('exam_filter')]);
    }
    
    public function show($id)
    {
        
        $student = Student::find($id);
        if ($student) {
            $results = Result::where('student_id', '=', $student->id)->with(['mark','exam'])->get();
            $subjects = Subject::where('grade_id', '=', $student->grade_id)->get();
    
            return inertia('Result/Show')->with(['student' =>  $student, 'results' => $results, 'subjects' => $subjects]);
        } else {
            return redirect('/dashboard/students');
        }
    }

    public function create(Request $request)
    {
        
        $student = Student::find($request->std);
        
        $grade = Grade::find($student->grade_id);

        $exams = Exam::where('grade_id', '=', $grade->id)->get();
        $subjects = Subject::where('grade_id', '=', $grade->id)->get();

        return inertia('Result/Create')->with(['exams' => $exams, 'subjects' => $subjects, 'student' => $student]);
    }
    
    public function edit($id)
    {   
        $result = Result::where('id', $id)->with(['student','mark'])->first();
        
        
        $grade = Grade::find($result->grade_id);

        $exams = Exam::where('grade_id', '=', $grade->id)->get();
        $subjects = Subject::where('grade_id', '=', $grade->id)->get();

        return inertia('Result/Edit')->with(['exams' => $exams, 'subjects' => $subjects, 'result' => $result]);
    }

    public function store(Request $request)
    {
        $exam_id = $request->exam_id;
        $student_id = $request->student_id;
        
        $request->validate([
            'grade_id' => 'required|numeric',
            'exam_id' => 'required|numeric',
            'student_id' => [   'required',
                                Rule::unique('results')->where(function ($query) use ($student_id, $exam_id) {
                                    return $query->where('student_id', $student_id)
                                                ->where('exam_id', $exam_id);
                                }),
                            ],
        ]);


        $result = Result::create([
            'grade_id' => $request->grade_id,
            'exam_id' => $request->exam_id,
            'student_id' => $request->student_id,
        ]);

        foreach ($request->subjects as $index => $subject) {
            Mark::create([
                'result_id' => $result->id,
                'subject_id' => $subject,
                'mark' => $request->marks[$index],
            ]);
        }

        return redirect('/dashboard/students')->with('success','تمت الاضافة بنجاح');
    }
    
    public function update(Request $request, $id)
    {
        $student_id = $request->student_id;
        $marks = Mark::where('result_id',$id)->get();
        
        $request->validate([
           'marks'  => 'required',
        ]);

        foreach ($marks as $index => $mark) {            
            $mark->mark = $request->marks[$index];
            $mark->save();
        }

        return redirect('/dashboard/results/'.$student_id)->with('success','تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        # code...
    }
}
