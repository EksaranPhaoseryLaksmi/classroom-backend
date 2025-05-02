<?php

namespace App\Models;

class Classroom
{
    // Fake database
    static $data = [
        'students' => [
            ['name' => 'John Doe', 'age' => 20 , 'id' => 1],
            ['name' => 'Jane Smith', 'age' => 22, 'id' => 2],
            ['name' => 'Sam Brown', 'age' => 19, 'id' => 3],
        ],
        'teachers' => [
            ['name' => 'KSDsfsf', 'subject' => 'Math', 'id' => 1],
            ['name' => 'Ms. Johnson', 'subject' => 'Science', 'id' => 2],
            ['name' => 'Mrs. Brown', 'subject' => 'English', 'id' => 3]
        ]
    ];

    public static function getStudents()
    {
        return self::$data['students'];
    }

    public static function getTeachers()
    {
        return self::$data['teachers'];
    }

    public static function getStudentById($id)
    {
        foreach (self::$data['students'] as $student) {
            if ($student['id'] == $id) return $student;
        }
        return null;
    }

    public static function deleteStudentById($id)
    {
        foreach (self::$data['students'] as $index => $student) {
            if ($student['id'] == $id) {
                unset(self::$data['students'][$index]);
                self::$data['students'] = array_values(self::$data['students']);
                return true;
            }
        }
        return false;
    }

    public static function createStudent($student)
{
    foreach (self::$data['students'] as $existing) {
        if ($existing['id'] == $student['id']) return false; // Conflict ID
    }
    
    // Add new student to the array
    self::$data['students'][] = $student;

    // Debugging: log the updated students list
    \Log::info('Updated students list:', self::$data['students']);
    
    return true;
}

    public static function editStudentById($id, $newData)
    {
        foreach (self::$data['students'] as &$student) {
            if ($student['id'] == $id) {
                $student = array_merge($student, $newData);
                return $student;
            }
        }
        return null;
    }

    public static function createTeacher($teacher)
    {
        foreach (self::$data['teachers'] as $existing) {
            if ($existing['id'] == $teacher['id']) return false; // Conflict ID
        }
        self::$data['teachers'][] = $teacher;
        return true;
    }

    public static function deleteTeacherById($id)
    {
        foreach (self::$data['teachers'] as $index => $teacher) {
            if ($teacher['id'] == $id) {
                unset(self::$data['teachers'][$index]);
                self::$data['teachers'] = array_values(self::$data['teachers']);
                return true;
            }
        }
        return false;
    }

    public static function editTeacherById($id, $newData)
    {
        foreach (self::$data['teachers'] as &$teacher) {
            if ($teacher['id'] == $id) {
                $teacher = array_merge($teacher, $newData);
                return $teacher;
            }
        }
        return null;
    }
}