<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\Empresa;

class EmpresaController extends Controller
{
    protected function validarEmpresa($request){
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'cep' => 'required',
            'cnpj' => 'required'
        ]);
        return $validator;
    }
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
    }
    
    public function index()
    {
        //Listar registros
        $empresa = Empresa::all();
        return response()->json(['data'=>$empresa, 'status'=>true]);

    }

    public function store(Request $request)
    {
        //Criar nova empresa
        $validator = $this->validarEmpresa($request);
        if($validator->fails()){
            return response()->json(['message'=>'Erro', 'errors' => $validator->errors()], 400);
        }
        $dados = $request->all();
        $empresa = Empresa::create($dados);
        if($empresa){
            return response()->json(['data'=>$empresa, 'status'=>true]);
        }
        else{
            return response()->json(['data'=>'Erro ao cadastrar Empresa', 'status'=>false]);

        }
    }

   
    public function show($id)
    {
        //Mostrar item especifico pelo ID
        $empresa = Empresa::find($id);
        if($empresa){
            return response()->json(['data'=>$empresa, 'status'=>true]);
        }
        else{
            return response()->json(['data'=>'Empresa não encontrada', 'status'=>false]);
        }
    }

    
    public function update(Request $request, $id)
    {
        $validator = $this->validarEmpresa($request);
        if($validator->fails()){
            return response()->json(['message'=>'Erro', 'errors' => $validator->errors()], 400);
        }
        $empresa = Empresa::find($id);
        $dados = $request->all();
        $empresa->update($dados);
        if($empresa){
            return response()->json(['data'=>$empresa, 'status'=>true]);
        }
        else{
            return response()->json(['data'=>'Erro ao editar a empresa', 'status'=>false]);
        }
    }

    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        if($empresa){
            $empresa->delete();
            return response()->json(['data'=>'Empresa removida com sucesso!', 'status'=>true]);
        }
        else{
            return response()->json(['data'=>'Erro ao remover a empresa', 'status'=>false]);
        }

    }
}
