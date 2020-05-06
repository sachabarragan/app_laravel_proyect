<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config(){
        return view('user.config');
    }

    public function users($search = null){
        if(!empty($search)){
            $users = User::where('user_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('surname', 'LIKE', '%'.$search.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(5);
        } else {
            $users = User::orderBy('id', 'desc')->paginate(5);
        }
        

        return view('user.users', [
            'users'=>$users
        ]);
    }

    public function update(Request $request){
        //Asignando el usuario a la variable $user y $id
        $user = \Auth::user();
        $id = $user->id;
        $email = $request->input('email');

        //Validando
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255', 'unique:users,user_name,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
        ]);

        //Cargando datos del form
        $name = $request->input('name');
        $surname = $request->input('surname');
        $user_name = $request->input('user_name');
        
        //Asignando los nuevos valores del objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->user_name = $user_name;
        $user->email = $email;

        //Subir imagen
        $image = $request->file('image');
        if($image){
            $image_path = time().$image->getClientOriginalName();
            Storage::disk('users')->put($image_path, File::get($image));

            $user->image = $image_path;
        }

        //Actualiza el usuario
        $user->update();


        return redirect()->route('config')->with(['message'=>'Weeduser update correctamente']);

    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);

    }

    public function profile($id){
        $user = User::find($id);

        return view('user.profile', [
            'user' => $user
        ]);
    }

    
}
