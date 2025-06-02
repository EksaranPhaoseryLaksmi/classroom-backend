<?php

use Illuminate\Support\Facades\Route;
use App\Models\Classroom;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

// Student & Teacher resource routes (for web views)
Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);

// Get all students
Route::get('/api/students', function() {
    $students = Classroom::getStudents();
    return response()->json($students);
});

// Get a specific student by ID
Route::get('/api/students/{id}', function($id) {
    $student = Classroom::getStudentById($id);
    if ($student) {
        return response()->json($student);
    }
    return response()->json(['message' => 'Student not found'], 404);
});

// Create a new student
Route::post('/api/students', function() {
     $body = request()->all();

    if (empty($body['name']) || empty($body['age'])) {
        return response()->json(['message' => 'Name and age required'], 400);
    }

    $created = Classroom::createStudent($body);

    if ($created) {
        return response()->json(['message' => 'Student created', 'data' => $created]);
    }

    return response()->json(['message' => 'Failed to create student'], 500);
});

// Edit an existing student by ID
Route::patch('/api/students/{id}', function($id) {
    $body = request()->all();
    $updatedStudent = Classroom::editStudentById($id, $body);

    if ($updatedStudent) {
        return response()->json(['message' => 'Student updated', 'data' => $updatedStudent]);
    }

    return response()->json(['message' => 'Student not found'], 404);
});

// Delete an existing student by ID
Route::delete('/api/students/{id}', function($id) {
    $deleted = Classroom::deleteStudentById($id);

    if ($deleted) {
        return response()->json(['message' => 'Student deleted']);
    }

    return response()->json(['message' => 'Student not found'], 404);
});

// Get all teachers
Route::get('/api/teachers', function() {
    $teachers = Classroom::getTeachers();
    return response()->json($teachers);
});

// Get a specific teacher by ID
Route::get('/api/teachers/{id}', function($id) {
    $teacher = Classroom::getTeacherById($id);
    if ($teacher) {
        return response()->json($teacher);
    }
    return response()->json(['message' => 'Teacher not found'], 404);
});

// Create a new teacher
Route::post('/api/teachers', function() {
   $body = request()->all();

    if (empty($body['name']) || empty($body['subject'])) {
        return response()->json(['message' => 'Name and subject required'], 400);
    }

    $created = Classroom::createTeacher($body);

    if ($created) {
        return response()->json(['message' => 'Student created', 'data' => $created]);
    }

    return response()->json(['message' => 'Failed to create student'], 500);
});

// Edit an existing teacher by ID
Route::patch('/api/teachers/{id}', function($id) {
    $body = request()->all();
    $updatedTeacher = Classroom::editTeacherById($id, $body);

    if ($updatedTeacher) {
        return response()->json(['message' => 'Teacher updated', 'data' => $updatedTeacher]);
    }

    return response()->json(['message' => 'Teacher not found'], 404);
});

// Delete an existing teacher by ID
Route::delete('/api/teachers/{id}', function($id) {
    $deleted = Classroom::deleteTeacherById($id);

    if ($deleted) {
        return response()->json(['message' => 'Teacher deleted']);
    }

    return response()->json(['message' => 'Teacher not found'], 404);
});
