<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Student::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $student)
    {
        //
         $validatedData = $student->validate([
            'name'  => 'required|string|max:255',
            'age'   => 'required|integer|min:1|max:100',
        ]);
        return Student::create($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
         return Student::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return Student::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $student = Student::find($id);
        if (!$student) {
        return response()->json(['message' => 'Student not found'], 404);
        }
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'age'  => 'required|integer|min:1|max:100',
            ]);

         $student->update($validatedData);
        return response()->json($student, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $student = Student::find($id);
        if (!$student) {
        return response()->json(['message' => 'Student not found'], 404);
        }
        return Student::destroy($id);
    }
}
