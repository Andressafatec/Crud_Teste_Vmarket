@extends('layouts.app')

@section('titulo')
Produtos
@endsection

@section('assets')

@endsection

@section('content')
<div class="container mt-5">
    <div class="card col-12">
        <div class="card-body">
            <h4>Detalhes Produto</h4>  
            <div class="row">
                <div class="col-4">
                    <label for="">Nome</label>
                    <p>{{$produto->nome}} </p>
                </div>
                <div class="col-8">
                    <label for="">Descrição</label>
                    <p>{{$produto->descricao}} </p>
                </div>
                <div class="col-3">
                    <label for="">Preço</label>
                    <p>{{$produto->preco}}</p>
                </div>
                <div class="col-3">
                    <label for="">Quantidade</label>
                    <p>{{$produto->qtd}}</p>
                </div>
            </div>

            <hr>

            <h5>Fornecedores</h5>
            @foreach($fornecedores_produto as $forn_prod)
            <div class="row">
                <div class="col-6">
                    {{$forn_prod->nome}}
                    {{$forn_prod->cnpj}}
                </div>
                <div class="col-6">
                    {{$forn_prod->email}}
                    {{$forn_prod->telefone}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('scripts')


@endsection
