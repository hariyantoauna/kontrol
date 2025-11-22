<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Course;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLearningController extends Controller
{
    public function index(Course $course)
    {
        //




        $timelines = Post::where(['course_id' => $course->id, 'active' => 1])->latest()->get();
        // dd($timeline);

        $data = [
            'title' => "URL",
            'course' => $course,
            'timelines' => $timelines,
            'comments' =>  Comment::where(['course_id' => $course->id])->latest()->get(),
        ];

        return view('learning.post', $data);
    }

    public function store(Request $request)
    {
        // dd($request);

        $request->validate([

            'post' => 'required|string',
        ]);

        // dd(3 . time());

        Post::create([
            'user_id' => Auth::user()->id,

            'course_id' => $request->course_id,
            'post' => $request->post,
            'code' => 3 . time(),
            'active' => 1
        ]);

        return back()->with('success', 'Post berhasil dikirim!');
    }
}
