<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function index(Request $request){
        $data = User::query();

        $search = $request->input('name');

        if (request()->filled('name')){
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        $output = $data
            ->select('name', 'email', 'phone')
            ->orderBy('id','DESC')->get();
        return view('about', compact('output'));


//        $data = User::query();
//
//        if (request()->filled('name')){
//            $data->where('name', 'LIKE', '%'.request('name').'%');
//        }
//        $output = $data
//            ->select('name', 'email')
//            ->orderBy('id','DESC')->get();
//        return view('about', compact('output'));


//        $data = request()->all();
//        if(request()->filled('name')){
//            $data = User::query()
//            ->where('name',
// 'LIKE', '%'.request('name').'%')
//            ->get();
//            return $data;
//        }else{
//            echo 'no data';
//        }
//        return request('name');
//        $data = User::query()
//            ->where('id', '>', '1')
//            ->get();
//        return $data;

//        User::query()->create([
//            'name'=>'Aya',
//            'email'=>'aya@gmail.com',
//            'password'=>bcrypt('123'),
//            'phone'=>'01143424759',
//            'type'=>'client'
//        ]);
    }

    public function profile($id){
        $user = User::query()
            ->where('id', '=', $id)->first();
        if ($user){
            return $user;
        }
        echo 'no data';

//        if($user){
//            $user->update([
//                'name' =>'test web'
//            ]);
//        }

    }

    public function search(Request $request){
        $search = User::query();

        if (request()->filled('name')){
            $search->where('name', 'LIKE', '%'.request('name').'%');
        }
        $output = $search
            ->select('name', 'email')
            ->orderBy('id','DESC')->get();
        return view('about', compact('output'));
    }
}
