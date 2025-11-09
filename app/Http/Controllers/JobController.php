<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Middleware instellen in de constructor
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    // Paginated lijst van jobs
    public function index()
    {
        // Haal 10 jobs per pagina
        $jobs = JobListing::paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employer_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
        ]);

        JobListing::create($request->all());

        return redirect('/jobs')->with('success', 'Job created successfully!');
    }

    public function show(JobListing $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(JobListing $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, JobListing $job)
    {
        $request->validate([
            'employer_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
        ]);

        $job->update($request->all());

        return redirect('/jobs')->with('success', 'Job updated successfully!');
    }

    public function destroy(JobListing $job)
    {
        $job->delete();

        return redirect('/jobs')->with('success', 'Job deleted successfully!');
    }
}
