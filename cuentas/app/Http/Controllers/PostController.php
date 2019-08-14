<?php

namespace App\Http\Controllers;

use App\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;



class PostController extends Controller
{
    public function index(){
        $cuentas = DB::select('select * from c_cuentas_bancarias');
        $bancos = DB::select('select * from c_banco');
        return view('post.index',compact('cuentas','bancos'));
    }
    public function addCuenta(Request $req){

        $reglas = array(
            'alias'=> 'required',
            'id_banco' => 'required',
            'ultimos_digitos' => 'required'
        );

        $validador = Validator::make(Input::all(),$reglas);
        if ($validador->fails()) {
            return Response::json(array('errors'=>$validador->getMessageBag()->toArray()));
        }
        else{
            $post = new Cuenta;
            $post->timestamps=false;
            $post->alias = $req->alias;
            $post->id_banco = $req->id_banco;
            $post->ultimos_digitos = $req->ultimos_digitos;
            $post->save();
            return response()->json($post);
        }
    }

    public function editCuenta(Request $req){

        $edit = \App\Cuenta::find($req->id);
        $edit->timestamps=false;
        $edit->alias = $req->ali;
        $edit->id_banco = $req->id_ban;
        $edit->ultimos_digitos = $req->digitos;
        $edit->save();
        return response()->json($edit);
    }

    public function deleteCuenta(request $request){
        $delete = Cuenta::find($request->id)->delete();
        return response()->json($delete);
    }

}
