<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a all comments for a specific course session.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $comments = Comment::where('course_file_id', $id);
        return response()->json($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->course_file_id = $request['course_file_id'];
        $comment->content = $request['content'];
        $comment->save();
        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        return response()->json($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->user_id = $request->user()->id;
        $comment->course_file_id = $request['course_file_id'];
        $comment->content = $request['content'];
        $comment->save();
        return response()->json($comment);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, Request $request)
    {
        $comment = Comment::find($id);
        $user = $request->user();
        if ($comment->user_id===$user->id){
            $comment->delete();
            return response()->json(["response"=>"comment deleted"]);
        }
        return response()->json(["response"=>"unauthorized"]);


    }
}
