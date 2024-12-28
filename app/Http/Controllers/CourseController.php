<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    // This method will show courses page
    public function index(){
        $courses = Course::orderBy('created_at', 'DESC')->get();
        return view('courses.list', [
            'courses' => $courses
        ]);
    }


    // This method will show create course page
    public function create(){
        return view('courses.create');
    }


    // This method will store a course in db
    public function store(Request $request){
        $rules = [
            'name' => 'required'
        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('courses.create')->withInput()->withErrors($validator);
        }


        // Here we will insert course in db
        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();

        if ($request->image != ""){
            // Here we will store image for course
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; // Unique name for the image

            // Save the image to courses directory in public folder
            $image->move(public_path('uploads/courses'), $imageName);

            // Save image name in db
            $course->image = $imageName;
            $course->save();
        }

        return redirect()->route('courses.index')->with('success', 'Course added successfully!');
    }


    // This method will show edit course page
    public function edit($id){
        $course = Course::findOrFail($id);
        return view('courses.edit', [
            'course' => $course
        ]);
    }


    // This method will update a course
    public function update($id, Request $request){

        $course = Course::findOrFail($id);

        $rules = [
            'name' => 'required'
        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('courses.edit', '$course->id')->withInput()->withErrors($validator);
        }


        // Here we will update course
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();

        if ($request->image != ""){

            // Delete old image
            File::delete(public_path('uploads/courses/'.$course->image));

            // Here we will store image for course
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; // Unique name for the image

            // Save the image to courses directory in public folder
            $image->move(public_path('uploads/courses'), $imageName);

            // Save image name in db
            $course->image = $imageName;
            $course->save();
        }

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }



    // This method will delete a course
    public function destroy($id){

        $course = Course::findOrFail($id);

        // Delete image
        File::delete(public_path('uploads/courses/'.$course->image));

        // Delete course from db
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
