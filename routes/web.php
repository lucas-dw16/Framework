<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// Index (overzicht)
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Create (form voor nieuw job)
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Store (verwerk create)
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Edit (formulier om job te bewerken)
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::findOrFail($id);
    return view('jobs.edit', ['job' => $job]);
});

// Update (verwerk bewerking)
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    return redirect('/jobs/' . $job->id);
});

// Show (detailpagina van één job)
Route::get('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id);
    return view('jobs.show', ['job' => $job]);
});

// Destroy (verwijder job)
Route::delete('/jobs/{id}', function ($id) {
    Job::findOrFail($id)->delete();
    return redirect('/jobs');
});

// Contact
Route::get('/contact', function () {
    return view('contact');
});
