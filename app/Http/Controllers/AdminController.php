<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.index');
    }

    public function jobstatus()
    {
        return view('admin.poststatus', [
            'jobposts' => JobPost::all(),
        ]);
    }

    public function postview(JobPost $jobpost)
    {
        return view('admin.poststatus', [
            'jobpost' => $jobpost,
        ]);
    }
    public function postStatusStore(Request $request)
    {
        $jobPost = JobPost::find($request->job_id);

        $jobPost->status = $request->status;
        $jobPost->save();

        return redirect()->route('approved_page')->with('success', 'Job post has been approved');
    }



    public function jobseeker()
    {
        return view('admin.jobseeker');
    }

    public function employerlist()
    {
        return view('admin.employerlist');
    }
    public function approvedlist()
    {
        return view('admin.approved');
    }
    public function rejectedlist()
    {
        return view('admin.rejected');
    }

}
