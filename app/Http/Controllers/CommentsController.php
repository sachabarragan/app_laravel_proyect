<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){
        
        $validate = $this->validate($request, [
            'content' => 'required',
            'weed_id' => 'integer|required',
            'user_id' => 'integer|required'
        ]);
        
        $user_id = $request->input('user_id');
        $weed_id = $request->input('weed_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->weed_id = $weed_id;
        $comment->comments = $content;
        
        

        $comment->save();

        return redirect()->route('weed.detail', ['id'=> $weed_id])->with([
            'message' => 'El Comment se roló con éxito'
        ]);
    }

    public function delete($id){
        $user = \Auth::user();

        
        $comments = Comment::all();
        $comment = $comments->find($id);

        if($user && ($comment->user_id == $user->id || $comment->weed->user_id == $user->id )){
            $comment->delete();

            return redirect()->route('weed.detail', ['id'=> $comment->weed->id])->with([
                'message' => 'El Comment se olvido con éxito']);
        } else {
            return redirect()->route('weed.detail', ['id'=> $comment->weed->id])->with([
                'message' => 'El Comment no se borra vieja']);
        }
    }
}
