<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Grade;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        return inertia('Result/Index');
    }

    public function create(Request $request)
    {
        $grades = Grade::all();

        $students = $subjects = $exams = null;

        if ($request->input('grade_filter')) {
            $exams = Exam::where('grade_id', '=', $request->grade_filter)->get();
            $subjects = Subject::where('grade_id', '=', $request->grade_filter)->get();
            $students = Student::where('grade_id', '=', $request->grade_filter)->get();
        }

        return inertia('Result/Create')->with(['grades' => $grades, 'exams' => $exams, 'subjects' => $subjects, 'students' => $students]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_result' => 'required|numeric',
            'grade_id' => 'required|numeric',
            'exam_id' => 'required|numeric',
            'student_id' => 'required|numeric',
        ]);

        Result::create([
            'total_result' => $request->total_result,
            'grade_id' => $request->grade_id,
            'exam_id' => $request->exam_id,
            'student_id' => $request->student_id,
        ]);
    }

    public function destroy($id)
    {
        # code...
    }
}
