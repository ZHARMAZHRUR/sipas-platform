<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(
            Student::with('room.dormitory')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:255|unique:students,nis',
            'full_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'room_id' => 'nullable|exists:rooms,id',
        ]);

        $student = Student::create($validated);

        return response()->json($student->load('room.dormitory'), 201);
    }

    public function show(Student $student)
    {
        return response()->json(
            $student->load('room.dormitory')
        );
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'nis' => 'sometimes|required|string|max:255|unique:students,nis,' . $student->id,
            'full_name' => 'sometimes|required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'gender' => 'sometimes|required|in:L,P',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'room_id' => 'nullable|exists:rooms,id',
        ]);

        $student->update($validated);

        return response()->json(
            $student->fresh()->load('room.dormitory')
        );
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully.',
        ]);
    }
}
