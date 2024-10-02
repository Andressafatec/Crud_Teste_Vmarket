<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\FornecedorProduto;

class ProdutoController extends Controller
{
    public function index(){
        $fornecedores = Fornecedor::all();
        return view('produtos.index', compact('fornecedores'));
    }

    public function list(){

        $produtos = Produto::all();

        return view('produtos._list', compact('produtos'));
    }

    public function buscar(Request $request){

        if($request->input('tipo_pesquisa') == 'nome'){
            $produtos = Produto::where('nome', 'LIKE', '%' . $request->input('nome_pesquisa') . '%')->get();
        }
        else if($request->input('tipo_pesquisa') == 'fornecedor'){
            $fornecedorId = $request->input('fornecedor');
            $produtos = Produto::whereHas('fornecedores', function ($query) use ($fornecedorId) {
                $query->where('fornecedor_produto.id_fornecedor', $fornecedorId);
            })->get();
        }

        return view('produtos._list', compact('produtos'));
    }
    public function new(){

        $fornecedores = Fornecedor::all();
        return view('produtos.new', compact('fornecedores'));
    }

    public function edit($id){

        $produto = Produto::find($id);

        $fornecedores_produto = FornecedorProduto::where('id_produto', $produto->id)->get();
        $fornecedores = Fornecedor::where('status', 'ativo')->get();
        return view('produtos.edit', compact('produto', 'fornecedores', 'fornecedores_produto'));
    }
    public function preview($id){

        $produto = Produto::find($id);
        $fornecedores_produto = FornecedorProduto::where('id_produto', $produto->id)->get();
        return view('produtos.preview', compact('produto', 'fornecedores_produto'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required',
            'preco' => 'required',
            'qtd' => 'required|integer',
        ]);

        $data['preco'] = str_replace(',', '.', str_replace('.', '', $data['preco']));

        $produto = Produto::create([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'preco' => $data['preco'],
            'qtd' => $data['qtd'],
            'status' => 'ativo',
        ]);

        $fornecedores = $request->input('fornecedores');
        if ($fornecedores) {
            foreach ($fornecedores['id'] as $index => $id) {
                $fornecedorProduto = new FornecedorProduto();
                $fornecedorProduto->id_produto = $produto->id;
                $fornecedorProduto->id_fornecedor = $id;
                $fornecedorProduto->save();
            }
        }

        return response()->json(['status' => 'ok'], 200);

    }
    public function update($id, Request $request)
    {
        $produto = Produto::find($id);
        $data = $request->except('_token');
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required',
            'preco' => 'required',
            'qtd' => 'required|integer',
        ]);

        $data['preco'] = str_replace(',', '.', str_replace('.', '', $data['preco']));

        $produto->update([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'preco' => $data['preco'],
            'qtd' => $data['qtd'],
            'status' => 'ativo',
        ]);

        $fornecedores_produto = FornecedorProduto::where('id_produto', $produto->id)->pluck('id_fornecedor')->toArray();

        $fornecedores = $request->input('fornecedores');

        if ($fornecedores) {

            foreach ($fornecedores['id'] as $id) {
                if (!in_array($id, $fornecedores_produto)) {
                    $fornecedorProduto = new FornecedorProduto();
                    $fornecedorProduto->id_produto = $produto->id;
                    $fornecedorProduto->id_fornecedor = $id;
                    $fornecedorProduto->save();
                }
            }
            foreach ($fornecedores_produto as $id) {
                if (!in_array($id, $fornecedores['id'])) {
                    FornecedorProduto::where('id_produto', $produto->id)
                        ->where('id_fornecedor', $id)
                        ->delete();
                }
            }
        }

        return response()->json(['status' => 'ok'], 200);

    }

    public function deletar(Request $request){
        $produtos = $request->input('produtos');
        if ($produtos) {
            foreach ($produtos['id'] as $index => $id) {
                if($id){
                    $produto = Produto::find($id);
                    $produto->delete();
                }
            }
        }
    }

    public function mudarStatus($id = null){
        $produto = Produto::find($id);

        if ($produto->status == 'ativo'){
            $produto->status = 'inativo';
        }
        else{
            $produto->status = 'ativo';
        }

        $produto->save();

        return response()->json(['status'=>'ok']);
    }
}
