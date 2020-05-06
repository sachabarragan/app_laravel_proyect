<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;
use App\Weed;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like(Request $request){
               
        $validate = $this->validate($request, [
            'would_smoke' => 'required',
            'would_eat' => 'required',
            'would_share' => 'required',
            'would_plant' => 'required',
            'it_hits_me' => 'required',
            'weed_id' => 'required',
            'came_from' => 'required'            
        ]); 


        
        $would_smoke = $request->input('would_smoke');
        $would_eat = $request->input('would_eat');
        $would_share = $request->input('would_share');
        $would_plant = $request->input('would_plant');
        $it_hits_me = $request->input('it_hits_me');
        $weed_id = $request->input('weed_id');
        $came_from = $request->input('came_from');

        $user = \Auth::user();    
        $like = new Like();

        $isset_like = Like::where('user_id', $user->id)
                        ->where('weed_id', $weed_id)->count();

        
        
        if($isset_like == 0){
            $like->user_id = (int)$user->id;
            $like->weed_id = (int)$weed_id;
            $like->would_share = $would_share;
            $like->would_eat = $would_eat;
            $like->would_smoke = $would_smoke;
            $like->would_plant = $would_plant;
            $like->it_hits_me = $it_hits_me;
            
            $like->save();
        }

        if($came_from == 'detail'){
            return redirect()->route('weed.detail', ['id'=> $weed_id])->with([
            'message' => 'Gracias por tu aporte locura']);
        } elseif($came_from == 'home') {
            return response()->json([
				'like' => $like
			]);
        }
        

    }

    public function dislike(){
        $user = \Auth::user();
    }

    public function likes(){
        $user = \Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);

        return view('like.likes', [
            'likes' => $likes
        ]);
    }
}
