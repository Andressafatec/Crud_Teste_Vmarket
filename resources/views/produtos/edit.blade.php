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
            <h4>Editar Produto</h4>  
            <form action="{{route('produtos.update', $produto->id)}}" id="formProduto">
            @csrf
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label for="">Nome*</label>
                        <input type="text"  name="nome" required class="form-control" value="{{$produto->nome}}">
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="">Descrição*</label>
                        <input type="text"  name="descricao" required class="form-control" value="{{$produto->descricao}}">
                    </div>
                    <div class="col-12 col-sm-3">
                        <label for="">Preço*</label>
                        <input type="text"  name="preco" required class="form-control moneyMask" value="{{$produto->preco}}">
                    </div>
                    <div class="col-12 col-sm-3">
                        <label for="">Quantidade de produtos*</label>
                        <input type="integer"  name="qtd" required class="form-control" value="{{$produto->qtd}}">
                    </div>
                    <hr class="mt-3">
                    <h5>Fornecedores</h5>
                    @foreach($fornecedores_produto as $forn_prod)
                        <div class="col-12 mt-2 row">
                            <div class="col-4">
                                <select class="form-select" name="fornecedores[id][]">
                                    <option value="" selected="">Selecione</option>
                                    @foreach($fornecedores as $fornecedor)
                                    <option value="{{$fornecedor->id}}" @if($fornecedor->id == $forn_prod->id_fornecedor) selected  @endif>{{$fornecedor->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <a href="#" class="btn btn-icon-only btn-danger close" onclick="excluirfornecedores(this)"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    @endforeach
                    <div class="" id="fornecedoresview"></div>
                    <a href="" class="btn btn-sm btn-primary adicionarfornecedores col-3 mt-3 mx-3" style="font-size: 18px"><i class="fas fa-plus-circle" style="font-size: 15px"></i> Adicionar Promoções</a>     
                </div>
                <div class="row mt-3">
                    <div class="col"> 
                        <a class="btn btn-secondary m-0" href="{{route('produtos.index')}}">Voltar</a>
                    </div>
                    <div class="col text-end">
                        <button class="btn btn-success m-0" type="submit">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
$("body").on('click', '.adicionarfornecedores', function (e) {
    e.preventDefault();
    var fornecedores = document.querySelector('#fornecedoresview');
    var newDiv = document.createElement("div");
    newDiv.classList.add("col-12", "mt-2", "row");
    newDiv.innerHTML = `
        <div class="col-4">
            <select class="form-select" name="fornecedores[id][]">
                <option value="" selected>Selecione</option>
                @foreach($fornecedores as $fornecedor)
                <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <a href="#" class="btn btn-icon-only btn-danger close" onclick="excluirfornecedores(this)"><i class="fas fa-trash"></i></a>
        </div>
    `;
    fornecedores.appendChild(newDiv);
    cont++;
});

function excluirfornecedores(element) {
    element.parentNode.parentNode.remove();
}


$("#formProduto").submit(function (e) {
    e.preventDefault();
    $("span.error").remove()
    
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (data) {
            console.log(data);
            swal({
                title: "Parábens",
                text: "Cadastro realizado com sucesso!.",
                icon: "success",
            }).then(function() {
                location.reload();
            });
        },
        error: function (err) {
            console.log(err);

            if (err.status == 422) { 
                console.log(err.responseJSON);
                $('#success_message').fadeIn().html(err.responseJSON.message);
                
                console.warn(err.responseJSON.errors);
                
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    el.after($('<span class="error" style="color: red; font-size:12px; font-weight: bold; margin-left:10px; border: none;">' + error[0] +
                        '</span>'));
                });
            }
        }
    })
})
</script>

@endsection