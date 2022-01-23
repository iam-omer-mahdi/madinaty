<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Grade;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return inertia('Exam/Index');
    }
    
    public function create()
    {
        $grades = Grade::all();
        return inertia('Exam/Create')->with(['grades' => $grades]);
    }
    
    public function edit($id)
    {
        return inertia('Exam/Edit');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'date' => 'date',
            'grade_id' => 'numeric',
        ]);

        Exam::create([
            'name' => $request->name,
            'exam_date' => $request->date,
            'grade_id' => $request->grade_id,
        ]);

        return redirect('/dashboard/exams')->with('success','تم الاضافة بنجام');
    }
    
    public function update(Request $request, $id)
    {
        # code
    }

    public function destroy($id)
    {
        # code...
    }
}
