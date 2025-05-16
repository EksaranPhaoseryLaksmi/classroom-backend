<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Teacher;

class Classroom
{
    // STUDENT METHODS

    public static function getStudents()
    {
        return Student::all();
    }

    public static function getStudentById($id)
    {
        return Student::find($id);
    }

    public static function createStudent($student)
    {
        return Student::create($student);
    }

    public static function editStudentById($id, $newData)
    {
        $student = Student::find($id);
        if ($student) {
            $student->update($newData);
            return $student;
        }
        return null;
    }

    public static function deleteStudentById($id)
    {
        return Student::destroy($id);
    }

    // TEACHER METHODS

    public static function getTeachers()
    {
        return Teacher::all();
    }

    public static function getTeacherById($id)
    {
        return Teacher::find($id);
    }

    public static function createTeacher($teacher)
    {
        return Teacher::create($teacher);
    }

    public static function editTeacherById($id, $newData)
    {
        $teacher = Teacher::find($id);
        if ($teacher) {
            $teacher->update($newData);
            return $teacher;
        }
        return null;
    }

    public static function deleteTeacherById($id)
    {
        return Teacher::destroy($id);
    }
}
