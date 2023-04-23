<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function __construct()
    {
         $this->authorizeResource(Comment::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $commentList = Comment::all();
        return view('admin.comment.index', compact('commentList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $commentList = Comment::all();
        return view('admin.comment.index', compact('commentList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $commentRequest
     * @return RedirectResponse
     */
    public function store(CommentRequest $commentRequest): RedirectResponse
    {
        Comment::create($commentRequest->all());
        return back()->withSuccess(trans('message.saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return View
     */
    public function show(Comment $comment): View
    {
        return view('admin.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return View
     */
    public function edit(Comment $comment): View
    {
        $commentList = Comment::all();
        return view('admin.comment.index', compact('comment', 'commentList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $commentRequest
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function update(CommentRequest $commentRequest, Comment $comment): RedirectResponse
    {
        $comment->update($commentRequest->all());
        return to_route('comment.index')->withSuccess(trans('message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();
        return to_route('comment.index')->withSuccess(trans('message.deleted'));
    }
}
