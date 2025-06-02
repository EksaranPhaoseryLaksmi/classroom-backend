<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Teacher::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email:rfc,dns|unique:teachers,email',
        ]);

        return Teacher::create($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Teacher::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return Teacher::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $teacher = Teacher::find($id);
        if ($teacher) {
            $validatedData = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email:rfc,dns|unique:teachers,email',
            ]);
            $teacher->update($validatedData);
            return $teacher;
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return Teacher::destroy($id);
    }
}
