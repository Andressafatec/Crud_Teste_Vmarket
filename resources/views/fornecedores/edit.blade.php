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
            <h4>Editar Fornecedor {{$fornecedor->nome}}</h4>  
            <form action="{{route('fornecedores.update', $fornecedor->id)}}" id="formFornecedor">
            @csrf
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label for="">Nome*</label>
                        <input type="text"  name="nome" required class="form-control" value="{{$fornecedor->nome}}">
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="">Email*</label>
                        <input type="email"  name="email" required class="form-control" value="{{$fornecedor->email}}">
                    </div>
                    <div class="col-12 col-sm-4">
                        <label for="">CNPJ*</label>
                        <input type="text"  name="cnpj" required class="form-control cnpjMask" value="{{$fornecedor->cnpj}}">
                    </div>
                    <div class="col-12 col-sm-4">
                        <label for="">Telefone*</label>
                        <input type="text"  name="telefone" required class="form-control phoneMask" value="{{$fornecedor->telefone}}">
                    </div>
                    <div class="col-12 col-sm-4">
                        <label for="">CEP *</label>
                        <div class="input-group ">
                            <input type="text" class="form-control cepMask border-radius-bottom-end-0" name="cep" id="buscaCep" required value="{{$fornecedor->cep}}">
                            <button class="btn btn-outline-primary mb-0" type="button" >  <i class="fa fa-search"></i></button>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="">Endereco*</label>
                        <input type="text"  name="endereco" required class="form-control" value="{{$fornecedor->endereco}}">
                    </div>
                    <div class="col-12 col-sm-3">
                        <label for="">Número*</label>
                        <input type="text"  name="numero" required class="form-control" value="{{$fornecedor->numero}}">
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="">Bairro*</label>
                        <input type="text"  name="bairro" required class="form-control" value="{{$fornecedor->bairro}}">
                    </div>
                    <div class="col-12 col-sm-3">
                        <label for="">Cidade*</label>
                        <input type="text"  name="cidade" required class="form-control" value="{{$fornecedor->cidade}}">
                    </div>
                    <div class="col-12 col-sm-3">
                        <label for="">Estado*</label>
                        <input type="text"  name="estado" required class="form-control" value="{{$fornecedor->estado}}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col"> 
                        <a class="btn btn-secondary m-0" href="{{route('fornecedores.index')}}">Voltar</a>
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

$("#formFornecedor").submit(function (e) {
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
                text: "Alteração realizado com sucesso!.",
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