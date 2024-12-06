<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    public function index(){
        return view('jobseeker.index');
    }

    public function applyjob(){
        return view('jobseeker.apply_job');
    }
    public function viewpost(){
        return view('jobseeker.viewpost');
    }

    public function approved(){
        return view('jobseeker.approved');
    }

    public function rejected(){
        return view('jobseeker.rejected');
    }
    public function pending(){
        return view('jobseeker.pending');
    }

}
