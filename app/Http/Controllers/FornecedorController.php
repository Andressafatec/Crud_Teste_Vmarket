<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index(){
        return view('fornecedores.index');
    }

    public function list(){
        $fornecedores = Fornecedor::all();

        return view('fornecedores._list', compact('fornecedores'));
    }
    public function buscar(Request $request){

        $fornecedores = Fornecedor::where('nome', 'LIKE', '%' . $request->input('nome_pesquisa') . '%')->get();

        return view('fornecedores._list', compact('fornecedores'));
    }
    public function new(){

        return view('fornecedores.new');
    }
    public function edit($id){

        $fornecedor = Fornecedor::find($id);
        return view('fornecedores.edit', compact('fornecedor'));
    }
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|unique:fornecedores|min:18',
            'email' => 'required|string|unique:fornecedores',
            'telefone' => 'required|min:14',
            'cep' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
        ]);

        Fornecedor::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'telefone' => $data['telefone'],
            'cep' => $data['cep'],
            'endereco' => $data['endereco'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'numero' => $data['numero'],
            'estado' => $data['estado'],
            'cnpj' => $data['cnpj'],
            'status' => 'ativo',
        ]);

        return response()->json(['status' => 'ok'], 200);

    }

    public function update($id, Request $request)
    {
        $fornecedor = Fornecedor::find($id);
        $data = $request->except('_token');
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|min:14',
            'cep' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
        ]);

        if($data['cnpj'] != $fornecedor->cnpj){
            $request->validate([
                'cnpj' => 'required|string|unique:fornecedores|min:18',
            ]);
        }
        if($data['email'] != $fornecedor->email){
            $request->validate([
                'email' => 'required|string|unique:fornecedores',
            ]);
        }

        $fornecedor->update([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'telefone' => $data['telefone'],
            'cep' => $data['cep'],
            'endereco' => $data['endereco'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'numero' => $data['numero'],
            'estado' => $data['estado'],
            'cnpj' => $data['cnpj'],
            'status' => 'ativo',
        ]);

        return response()->json(['status' => 'ok'], 200);

    }

    public function deletar(Request $request){
        $fornecedores = $request->input('fornecedores');
        if ($fornecedores) {
            foreach ($fornecedores['id'] as $index => $id) {
                if($id){
                    $fornecedor = Fornecedor::find($id);
                    $fornecedor->delete();
                }
            }
        }
    }

    public function mudarStatus($id = null){
        $fornecedor = Fornecedor::find($id);

        if ($fornecedor->status == 'ativo'){
            $fornecedor->status = 'inativo';
        }
        else{
            $fornecedor->status = 'ativo';
        }

        $fornecedor->save();

        return response()->json(['status'=>'ok']);
    }

    public function preview($id){

        $fornecedor = Fornecedor::find($id);
        return view('fornecedores.preview', compact('fornecedor'));
    }
}
