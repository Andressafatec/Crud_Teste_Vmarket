@extends('layouts.app')

@section('titulo')
Fornecedores
@endsection

@section('assets')

@endsection

@section('content')
<div class="container mt-5">
    <div class="card col-12">
        <div class="card-body">
            <h4>Detalhes Fornecedor</h4>  
            <div class="row">
                <div class="col-6">
                    <label for="">Fornecedor</label>
                    <p>{{$fornecedor->nome}} <br>
                        {{$fornecedor->cnpj}}
                    </p>
                </div>
                <div class="col-6">
                    <label for="">Email</label>
                    <p>{{$fornecedor->email}}</p>
                </div>
                <div class="col-3">
                    <label for="">Telefone</label>
                    <p>{{$fornecedor->telefone}}</p>
                </div>
                <div class="col-6">
                    <label for="">Endereco</label>
                    <p>{{$fornecedor->endereco}},{{$fornecedor->numero}} <br>
                    {{$fornecedor->bairro}}, {{$fornecedor->cidade}} - {{$fornecedor->estado}}</p>
                </div>
                <div class="col-3">
                    <label for="">Status</label>
                    <button class="btn btn-sm btn-sucess">Ativo</button>
                    <button class="btn btn-sm btn-danger">Inativo</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')


@endsection
