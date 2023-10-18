<?php

namespace App\Http\Controllers;

use App\Http\Requests\clearcompletereq;
use App\Http\Requests\createtopreq;
use App\Http\Requests\deletereq;
use App\Http\Requests\searchreq;
use App\Http\Requests\updatereq;
use App\Models\Todo;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function createtodo(createtopreq $request){
     Todo::create([
        "word"=>$request->word,
        "status"=>$request->status,
     ]);
     return response()->json(['success'=>'your todo has been created']);
    }

    public function updatetodo(updatereq $request){
     $todo =  Todo::where(['id'=>$request->id])->first();
     try {
       $todo->update([
        "status"=>$request->status,
       ]);
      return response()->json(["success"=>"you have updated your todo"]);
     } catch (\Throwable $th) {
        return response()->json(["error"=>"there is an error somewhere"]);

     }
    }

    public function deletetodo(deletereq $request){
      try {
        Todo::where(["id"=>$request->id])->delete();
        return response()->json(["success"=>"data has been deleted"]);
      } catch (\Throwable $th) {
        return response()->json(["error"=>"there is an error somewhere"]);

      }
    }

    public function alltodo(){
        try {
            $todo = Todo::all();
         return  response()->json(['success'=>$todo]);
        } catch (\Throwable $th) {
            return response()->json(["error"=>"there is an error somewhere"]);
        }
    }

    public function clearcomplete(clearcompletereq $request){
        try {
          $todo = Todo::where(['status'=>$request->status])->delete();
          $todos = Todo::all();
          return response()->json(['success'=>$todos]);
        } catch (\Throwable $th) {
            return response()->json(["error"=>"there is an error somewhere"]);
        }

    }

    public function searchstatus ($status){
        if($status == "all"){
                 $todo = Todo::all();
                return response()->json(['success'=>$todo]);
        }else{
                 $todo = Todo::where(['status'=>$status])->get();
                return response()->json(['success'=>$todo]);
        }
    }
}
