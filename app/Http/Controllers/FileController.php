<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{

    public function upload(Request $request)
    {
       $path = $request->file('image')->store('uploads', 'public');
//       return view('downloadpage', ['path' => $path]);


        return view('uploadpage', ['path' => $path]);
    }


//    public function upload($id)
//    {
//               return view('downloadpage', ['path' => $path]);
//        return "Documet: $id";
//    }

}
