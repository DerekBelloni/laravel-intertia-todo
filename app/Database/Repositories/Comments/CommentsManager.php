<?php

namespace App\Database\Repositories\Comments;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsManager 
{
  public static function store(Request $request)
  {
    $comment = $request->all();

    Comment::create([
      "user_id" => Auth()->id(),
      "parent_task_id" => $comment['parent_task_id'],
      "comment_body" => $comment['comment_body']
    ]);
  }
}
