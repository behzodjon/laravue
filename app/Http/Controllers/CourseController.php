<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderByDesc('created_at')->get();

        return CourseResource::collection($courses);
    }

    public function store(Request $request)
    {
        Course::create($request->all());

        return $this->index();
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->all());

        return $this->index();
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return $this->index();
    }
}
