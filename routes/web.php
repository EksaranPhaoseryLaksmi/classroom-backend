<?php

use Illuminate\Support\Facades\Route;
use App\Models\Classroom;

// Get all students
Route::get('/students', function() {
    $students = Classroom::getStudents();
    return response()->json($students);
});

// Get a specific student by ID
Route::get('/students/{id}', function($id) {
    $student = Classroom::getStudentById($id);
    if ($student) {
        return response()->json($student);
    }
    return response()->json(['message' => 'Student not found'], 404);
});

// Create a new student
Route::post('/students', function() {
    // Get the request data
    $body = request()->all();
    
    // Debugging: check the data we're receiving
    \Log::info('Received student data:', $body);

    // Generate a new unique ID for the student
    $students = Classroom::getStudents();
    $lastStudent = end($students);
    $newId = $lastStudent ? $lastStudent['id'] + 1 : 1;

    $newStudent = [
        'name' => $body['name'],
        'age' => $body['age'],
        'id' => $newId
    ];

    // Debugging: check the new student data
    \Log::info('Created student data:', $newStudent);

    // Call the model to add the student
    $created = Classroom::createStudent($newStudent);

    if ($created) {
        // Debugging: success message
        \Log::info('Student successfully added.');
        return response()->json(['message' => 'Student created', 'data' => $newStudent]);
    }

    // Debugging: failure message
    \Log::info('Failed to create student, ID conflict');
    return response()->json(['message' => 'Failed to create student, ID conflict'], 400);
});

// Edit an existing student by ID
Route::patch('/students/{id}', function($id) {
    $body = request()->all();
    $updatedStudent = Classroom::editStudentById($id, $body);

    if ($updatedStudent) {
        return response()->json(['message' => 'Student updated', 'data' => $updatedStudent]);
    }

    return response()->json(['message' => 'Student not found'], 404);
});

// Delete an existing student by ID
Route::delete('/students/{id}', function($id) {
    $deleted = Classroom::deleteStudentById($id);

    if ($deleted) {
        return response()->json(['message' => 'Student deleted']);
    }

    return response()->json(['message' => 'Student not found'], 404);
});

// Get all teachers
Route::get('/teachers', function() {
    $teachers = Classroom::getTeachers();
    return response()->json($teachers);
});

// Get a specific teacher by ID
Route::get('/teachers/{id}', function($id) {
    $teacher = Classroom::getTeacherById($id);
    if ($teacher) {
        return response()->json($teacher);
    }
    return response()->json(['message' => 'Teacher not found'], 404);
});

// Create a new teacher
Route::post('/teachers', function() {
    $body = request()->all();

    // Generate a new unique ID for the teacher
    $teachers = Classroom::getTeachers();
    $lastTeacher = end($teachers);
    $newId = $lastTeacher ? $lastTeacher['id'] + 1 : 1;

    $newTeacher = [
        'name' => $body['name'],
        'subject' => $body['subject'],
        'id' => $newId
    ];

    $created = Classroom::createTeacher($newTeacher);

    if ($created) {
        return response()->json(['message' => 'Teacher created', 'data' => $newTeacher]);
    }

    return response()->json(['message' => 'Failed to create teacher, ID conflict'], 400);
});

// Edit an existing teacher by ID
Route::patch('/teachers/{id}', function($id) {
    $body = request()->all();
    $updatedTeacher = Classroom::editTeacherById($id, $body);

    if ($updatedTeacher) {
        return response()->json(['message' => 'Teacher updated', 'data' => $updatedTeacher]);
    }

    return response()->json(['message' => 'Teacher not found'], 404);
});

// Delete an existing teacher by ID
Route::delete('/teachers/{id}', function($id) {
    $deleted = Classroom::deleteTeacherById($id);

    if ($deleted) {
        return response()->json(['message' => 'Teacher deleted']);
    }

    return response()->json(['message' => 'Teacher not found'], 404);
});
