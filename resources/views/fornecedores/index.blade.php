@extends('layouts.app')

@section('titulo')
Fornecedores
@endsection

@section('assets')

@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card col-12">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-9">
                        <h4>Fornecedores</h4>          
                    </div>
                    <div class="col-3">
                        <a href="{{route('fornecedores.new')}}" class="btn btn-primary " type="button" >
                            Cadastrar
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-8">
                        <form action="{{route('fornecedores.buscar')}}" id="formPesquisar">
                        @csrf
                            <div class="row">
                                <div class="col-7">
                                    <input type="text" class="w-100 form-control" placeholder="Pesquisar por Nome" name="nome_pesquisa">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                                <div class="col-3 text-end">
                                    <button type="button" class="btn btn-primary" id="limpar">Limpar</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="align-content-end col-4">
                        <a href="#" id="selecionar-todos">Selecionar Todas</a>
                        <button id="botao-delete" class="btn btn-danger ms-2" style="display: none;">Deletar</button>
                    </div>
                </div>


                <div id="list-Fornecedores">
                    
                </div> 

                <div class="row mt-3 justify-content-center">
                    <div class="col-sm-12 mx-auto align-center">

                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>

Lista();

function Lista() {
    var url = "{{ route('fornecedores.list') }}"; 
    $.get(url, function (data) {
        $('#list-Fornecedores').html(data);
    });
}

$("body").on('click', '#limpar', function(e) {
    e.preventDefault();

    $('input[name="nome_pesquisa"]').val('');

    Lista();
});


$("#formPesquisar").submit(function (e) {
    e.preventDefault();
    $("span.error").remove()
    
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (data) {
            $('#list-Fornecedores').html(data);
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

$("body").on('change', '.fornecedores', function(e) {
    e.preventDefault();

    if ($('input[name="fornecedores[id][]"]:checked').length > 0) {
        $('#botao-delete').show();
    } else {
        $('#botao-delete').hide();
    }
});
$("body").on('click', '#selecionar-todos', function(e) {
    var checkboxes = document.querySelectorAll('.fornecedores');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = true;
    });
    $('#botao-delete').show();
});
$("body").on('click', '#botao-delete', function(e) {
    e.preventDefault();

    var data = $('#formDeletar').serialize();

    swal({
        title: "Você tem certeza?",
        text: "Você removerá permanentemente este item.",
        icon: "warning",
        dangerMode: true,
        buttons: {
            cancel: {
                text: "Cancelar",
                value: null,
                visible: true,
                closeModal: true,
            },
            confirm: {
                text: "OK",
                value: true,
                visible: true,
                closeModal: true
            }
        }
    }).then(willDelete => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: "{{ route('fornecedores.deletar') }}",
                data: data,
                success: function () {
                    swal("Sucesso!", "Item removido com sucesso.", "success")
                    .then(function() {
                        location.reload();
                    });
                },
                error: function (err) {
                    var erro = err.responseJSON;
                    swal("Atenção!", erro.error, "error");
                }
            });
        }
    });
});


$("body").on('change', '.status-categoria', function (e) {
    e.preventDefault();
    var id = this.getAttribute('data-id');

    var url = '{{ route("fornecedores.mudarStatus", ["id" => ":id"]) }}';
    url = url.replace(':id', id);
    $.get(url, function (data) {
        swal({
            title: "Parabéns",
            text: "Status alterado com sucesso!.",
            icon: "success",
        })
    });
});

</script>

@endsection
