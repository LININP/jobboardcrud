<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class EmployerController extends Controller
{
    public function index(){
        return view('employer.index');
    }

    public function jobseeker()
    {
       return view('employer.jobseeker');
    }

    public function jobform()
    {
       return view('employer.jobform');
    }


    public function FormStore(Request $request)
    {
        $jobpost = new JobPost();
        $jobpost->company_name=$request->company_name;
        $jobpost->designation=$request->designation;
        $jobpost->email=$request->email;
        $jobpost->experience=$request->experience;
        $jobpost->salary=$request->salary;
        $jobpost->no_of_vaccancy=$request->no_of_vaccancy;
        $jobpost->description=$request->description;
        $jobpost->employer_id = auth()->id();
        $jobpost->save();
        return redirect()->route('jobform_page');

    }


    public function approved()
    {
       return view('employer.approve');
    }

    public function rejected()
    {
       return view('employer.reject');
    }

    public function shortlisted()
    {
       return view('employer.shortlisted');
    }

}
