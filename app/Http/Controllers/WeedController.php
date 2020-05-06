<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Weed;
use App\Like;
use App\Comment;

class WeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('weed.create');
    }

    public function save(Request $request){

        
        $validate = $this->validate($request, [
            'image_path' => 'required|image',
            'titulo' => 'required',
            'auto' => 'required',
            'breed' => 'required',
            'kind' => 'required',
            'cbd' => 'required',
            'thc' => 'required',
            'flow_time' => 'required',
            'veg_time' => 'required',
            'flow_time' => 'required',
            'description' => 'required'
            
        ]); 

        $image_path = $request->file('image_path');
        $titulo = $request->input('titulo');
        $auto = $request->input('auto');
        $breed = $request->input('breed');
        $kind = $request->input('kind');
        $cbd = $request->input('cbd');
        $thc = $request->input('thc');
        $veg_time = $request->input('veg_time');
        $flow_time = $request->input('flow_time');
        $description = $request->input('description');
        
        $user = \Auth::user();
        $weed = new Weed();
        $weed->user_id = $user->id;
        $weed->image_path = null;
        $weed->titulo = $titulo;
        $weed->auto = $auto;
        $weed->breed = $breed;
        $weed->cbd = $cbd;
        $weed->thc = $thc;
        $weed->veg_time = $veg_time;
        $weed->flow_time = $flow_time;
        $weed->description = $description;
        
        if($image_path){
            $image_path_ok = time().$image_path->getClientOriginalName();
            Storage::disk('weeds')->put($image_path_ok, File::get($image_path));

            $weed->image_path = $image_path_ok;
        }

        $weed->save();

        return redirect()->route('home')->with([
            'message' => 'La Weed se roló con éxito'
        ]);
    }

    public function getWeed($weedName){
        $file = Storage::disk('weeds')->get($weedName);
        return new Response($file, 200);
    }

    public function detail($id){
        $weeds = Weed::all();
        $weed = $weeds->find($id);
        $user = \Auth::user();  
        $count = 1;
        $likesFromHere = new Like;
        $smoke = 0;
        $share = 0;
        $plant = 0;
        $ihm = 0;
        $eat = 0;

        $yaVoto = Like::where('user_id', $user->id)
                        ->where('weed_id', $weed->id)->count();


        foreach ($weed->likes as $wouldWhat) {
            
            $smoke += $wouldWhat->would_smoke;
            $share += $wouldWhat->would_share;   
            $ihm += $wouldWhat->it_hits_me;
            $plant += $wouldWhat->would_plant;
            $eat += $wouldWhat->would_eat;
            
            $count++;
            

        };
        $count--;

        if($count>0){
            $smoke = (int)($smoke/$count);
            $share = (int)($share/$count);
            $ihm = (int)($ihm/$count);
            $plant = (int)($plant/$count);
            $eat = (int)($eat/$count);
        } else {
            $count=1;
            $smoke = (int)($smoke/$count);
            $share = (int)($share/$count);
            $ihm = (int)($ihm/$count);
            $plant = (int)($plant/$count);
            $eat = (int)($eat/$count);
        }
        
        
        $likesFromHere->would_smoke = $smoke;
        $likesFromHere->would_share = $share;
        $likesFromHere->would_eat = $eat;
        $likesFromHere->would_plant = $plant;
        $likesFromHere->it_hits_me = $ihm;

        return view('weed.detail', [
            'weed' => $weed,
            'likes' => $likesFromHere,
            'yaVoto' => $yaVoto
        ]);
    }

    public function delete($id){
        $user = \Auth::user();
        $weeds = Weed::all();
        $weed = $weeds->find($id);

        
        $comments = Comment::where('weed_id', $id)->get();
        
        $likes = Like::where('weed_id', $id)->get();


        if($user && $weed && ($user->id == $weed->user->id)){

            if($comments && (count($comments) >= 1)){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }

            if($likes && (count($likes) >= 1)){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            Storage::disk('weeds')->delete($weed->image_path);

        
            $weed->delete();
            return redirect()->route('home')->with([
                'message' => 'La Weed se borro con éxito'
            ]);
        } else {
            return redirect()->route('weed.detail')->with([
                'id' => $id,
                'message' => 'Hubo un error, un garron'
            ]);
        }

        
    }

    public function edit($id){
        
        $user = \Auth::user();
        
        $weed = Weed::find($id);
        
        if($user && $weed && ($user->id == $weed->user->id)){
            return view('weed.edit', [
                'weed'=>$weed
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function update(Request $request){

        $validate = $this->validate($request, [
            'image_path' => 'required|image',
            'weedId' => 'required',
            'titulo' => 'required',
            'auto' => 'required',
            'breed' => 'required',
            'kind' => 'required',
            'cbd' => 'required',
            'thc' => 'required',
            'flow_time' => 'required',
            'veg_time' => 'required',
            'flow_time' => 'required',
            'description' => 'required'
            
        ]); 

        $weed_id = $request->input('weedId');
        $image_path = $request->file('image_path');
        $titulo = $request->input('titulo');
        $auto = $request->input('auto');
        $breed = $request->input('breed');
        $kind = $request->input('kind');
        $cbd = $request->input('cbd');
        $thc = $request->input('thc');
        $veg_time = $request->input('veg_time');
        $flow_time = $request->input('flow_time');
        $description = $request->input('description');
        
        $user = \Auth::user();
        $weed = Weed::find($weed_id);
        $weed->user_id = $user->id;
        $weed->image_path = null;
        $weed->titulo = $titulo;
        $weed->auto = $auto;
        $weed->breed = $breed;
        $weed->cbd = $cbd;
        $weed->thc = $thc;
        $weed->veg_time = $veg_time;
        $weed->flow_time = $flow_time;
        $weed->description = $description;
        
        if($image_path){
            $image_path_ok = time().$image_path->getClientOriginalName();
            Storage::disk('weeds')->put($image_path_ok, File::get($image_path));

            $weed->image_path = $image_path_ok;
        }

        $weed->update();

        return redirect()->route('weed.detail', ['id'=>$weed_id])->with([
            'message' => 'La Weed se edito con esito'
        ]);
    }
}
