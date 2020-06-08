<?php

namespace App\Http\Controllers\API;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Comment::with('user')->latest('id')->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'post_id' => 'required|integer|exists:posts,id',
			'text' => 'required',
			'user_id' => 'required|integer|exists:users,id'
		]);
		
		$comment = Comment::create(
			$request->all()
		);

		return response()->json([
			'message' => 'comment created',
			'comment' => $comment,
		], 201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function show(Comment $comment)
	{
		$comment->load('post', 'user');

		return $comment;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$comment = Comment::find($id);
		$this->authorize('update', $comment);
		
		$request->validate([
			'text' => 'required',
		]);

		$comment->update(
			$request->all()
		);

		return response()->json([
			'message' => 'comment updated',
			'comment' => $comment,
		], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Comment $comment)
	{
		$this->authorize('update', $comment);

		$comment->delete();

		return response()->json([
			'message' => 'comment deleted',
			'comment' => $comment,
		], 200);
	}
}
