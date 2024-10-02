<div class="col-12">
    <div class="row bg-dark arial16-font text-light text-bold m-0 py-2">
        <div class="col-3">Nome</div>
        <div class="col-2">Descrição</div>
        <div class="col-2">Preço</div>
        <div class="col-2">Qtd</div>
        <div class="col-1 text-center">Status</div>
        <div class="col-2 text-center">Ações</div>
    </div>
</div>
<form action="#" id="formDeletar">
@csrf
<div class="col-12 mt-4">
    @foreach($produtos as $produto)
    <div class="row m-0 py-2 border-bottom arial14-font-normal ">
        <div class="col-3">
            <div class="row">
                <div class="col-2 row align-content-center">
                    <input type="checkbox" class="produtos" name="produtos[id][]" value="{{$produto->id}}">
                </div>
                <div class="col-10">
                    {{$produto->nome}}
                </div>
            </div>
        </div>
        <div class="col-2">
            {{ Str::limit($produto->descricao, 20, ' (...)') }}
        </div>
        <div class="col-2">
            R$ {{ number_format($produto->preco, 2, ',', '.') }}
        </div>
        <div class="col-2">
            {{$produto->qtd}}
        </div>
        <div class="col-1 justify-content-center d-flex">
            <div class="form-check form-switch">
                <input class="form-check-input status-categoria" type="checkbox" name="status" role="switch" value="ativo" data-id="{{$produto->id}}" @if($produto->status == 'ativo') checked @endif>
                <label class="form-check-label" for="flexSwitchCheckChecked"> Ativo </label>
            </div>
        </div>
        <div class="col-2 text-center">
            <a href="{{route('produtos.edit', $produto->id)}}" class="btn btn-sm btn-icon-only btn-secondary edit"> <i class="fas fa-pencil"></i> </a>
            <a href="{{route('produtos.preview', $produto->id)}}" class="btn btn-sm btn-primary"> <i class="fa-regular fa-eye"></i> </a>        </div>
    </div>
    @endforeach
</div>
</form>