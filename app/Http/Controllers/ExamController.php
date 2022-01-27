<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['grade'])->get();
        return inertia('Exam/Index')->with(['exams' => $exams]);
    }
    
    public function create()
    {
        $grades = Grade::all();
        return inertia('Exam/Create')->with(['grades' => $grades]);
    }
    
    public function edit($id)
    {
        $exam = Exam::find($id);
        $grades = Grade::all();
        return inertia('Exam/Edit')->with(['exam' => $exam, 'grades' => $grades]);
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

        return redirect('/dashboard/exams')->with('success','تم الاضافة بنجاح');
    }

    public function update(Request $request, $id)
    {
        $exam = Exam::find($id);

        $request->validate([
            'name' => [
                'string',
                'required',
                Rule::unique('exams')->ignore($exam->id),
            ],
            'exam_date' => 'required|date',
            'grade_id' => 'required|numeric'
        ]);


        $exam->name = $request->name;
        $exam->exam_date = $request->exam_date;
        $exam->grade_id = $request->grade_id;
        $exam->save();

        return Redirect::route('exams.index', $exam)->with('success', 'تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        $exam = Exam::find($id);
        $exam->delete();

        return redirect()->back()->with('success','تم الحذف بنجاح');
    }
}
