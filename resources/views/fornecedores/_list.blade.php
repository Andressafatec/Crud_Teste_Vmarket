<div class="col-12">
    <div class="row bg-dark arial16-font text-light text-bold m-0 py-2">
        <div class="col-4">Nome/Email/Telefone</div>
        <div class="col-2">CNPJ</div>
        <div class="col-3">Endereco</div>
        <div class="col-1 text-center">Status</div>
        <div class="col-2 text-center">Ações</div>
    </div>
</div>
<form action="#" id="formDeletar">
@csrf
<div class="col-12 mt-4">
    @foreach($fornecedores as $fornecedor)
    <div class="row m-0 py-2 border-bottom arial14-font-normal ">
        <div class="col-4">
            <div class="row">
                <div class="col-2 row align-content-center">
                    <input type="checkbox" class="fornecedores" name="fornecedores[id][]" value="{{$fornecedor->id}}">
                </div>
                <div class="col-10">
                    {{$fornecedor->nome}}
                    {{$fornecedor->email}}
                    {{$fornecedor->telefone}}
                </div>
            </div>
        </div>
        <div class="col-2">
            {{$fornecedor->cnpj}}
        </div>
        <div class="col-3">
            {{$fornecedor->endereco}},{{$fornecedor->numero}}
            {{$fornecedor->bairro}}, {{$fornecedor->cidade}} - {{$fornecedor->estado}}
        </div>
        <div class="col-1 justify-content-center d-flex">
            <div class="form-check form-switch">
                <input class="form-check-input status-categoria" type="checkbox" name="status" role="switch" value="ativo" data-id="{{$fornecedor->id}}" @if($fornecedor->status == 'ativo') checked @endif>
                <label class="form-check-label" for="flexSwitchCheckChecked"> Ativo </label>
            </div>
        </div>
        <div class="col-2 text-center">
            <a href="{{route('fornecedores.edit', $fornecedor->id)}}" class="btn btn-sm btn-icon-only btn-secondary edit"> <i class="fas fa-pencil"></i> </a>
            <a href="{{route('fornecedores.preview', $fornecedor->id)}}" class="btn btn-sm btn-primary"> <i class="fa-regular fa-eye"></i> </a>
        </div>
    </div>
    @endforeach
</div>
</form>