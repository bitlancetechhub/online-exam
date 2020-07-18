<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Examinfo;
use App\Question;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('student.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $student= new Student;

        $sIdForValidate=$request->input('student_id');
        $examCodeForValidate=$request->input('exam_code');
        $initialScore=0;

        $checker=Student::where(['student_id' => $sIdForValidate,'uniqueid' => $examCodeForValidate])->count();
        if ($checker>0) {
            return view('student.already'); //"YOU ALREADY DONE THIS EXAM";
        }else{
            $id=$request->input('exam_code');
            
            $findcoucount= Examinfo::where('uniqueid',$id)->count();
            if($findcoucount==0){
              return view('student.notexist');  
            }
            $student = Student::create([
            'student_id' => $request->input('student_id'),
            'uniqueid' => $request->input('exam_code'),
            'score' =>$initialScore
            ]);

            
            $studentRealId=$request->input('student_id');
            $student_id=Student::where('student_id',$studentRealId)->value('id');
            $findcourse= Examinfo::where('uniqueid',$id)->value('id');
            $findtime= Examinfo::where('uniqueid',$id)->value('time');
            $course= Examinfo::where('uniqueid',$id)->value('Course');
            $questions=Question::where('quiz_id',$findcourse)->inRandomOrder()->get();
            return view('answer.show')->with('questions', $questions)->with('student_id',$student_id)->with('course',$course)->with('time',$findtime);
        }
        

        //return $this->show($request->input('exam_code'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
