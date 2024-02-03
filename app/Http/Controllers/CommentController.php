<?php

namespace App\Http\Controllers;

use App\Models\CoffeeImpression;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addComment(Request $request)
    {
        try {
            Log::info($request);

            $validatedData = $request->validate([
                'userId' => 'required|integer|min:1',
                'coffeeImpressionId' => 'required|integer|min:1',
                'parentId' => 'nullable|integer|min:1',
                'comment' => 'required|string',
            ]);

            $comment = Comment::create([
                'userId' => $validatedData['userId'],
                'coffeeImpressionId' => $validatedData['coffeeImpressionId'],
                'parentId' => $validatedData['parentId'],
                'comment' => $validatedData['comment'],
            ]);

            // 応答を返す
            return response()->json($comment)->header('X-Message', 'コメントの登録が完了しました');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'コメントの登録に失敗しました'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
