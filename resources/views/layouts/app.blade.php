<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- @vite(['resources/scss/app.scss', 'resources/js/app.js']) -->

    <link rel="stylesheet" href="{{ asset('build/assets/app-CIFRRvrY.css') }}">  

    @yield('assets')
</head>

<body>
    <div class="row w-100">
        <div class="col-3">
            <div class="sidebar">
                <a href="{{route('produtos.index')}}">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo da Empresa" class="img-logo">
                </a>
                <hr>
                <ul class="list-unstyled">
                    <li class="active">
                        <a href="{{route('produtos.index')}}" class="nav-link">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                            Produtos
                        </a>
                    </li>
                    <li>
                        <a href="{{route('fornecedores.index')}}" class="nav-link">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                            Fornecedores
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <main class="col-9">
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYFfcbqJO+gOfQ2bS3W1pMdE6LZZR5f5Dq2j5g6u5FniyD05eFGFpgxrk" crossorigin="anonymous"></script>
    
    <script>
        $("body").on('change', '.form-switch .form-check-input', function () {
            let $label = $(this).siblings('label');
            if ($(this).is(':checked')) {
                $label.html('Ativo');
                $(this).val('ativo');
            } else {
                $label.html('Inativo');
                $(this).val('inativo');
            }
        });

        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        };
        
        var spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

        $('.phoneMask').mask(SPMaskBehavior, spOptions);
        $('.moneyMask').mask("#.##0,00", { reverse: true });
        $('.cepMask').mask('00000-000');
        $('.cnpjMask').mask('00.000.000/0000-00', { reverse: true });


        function buscaCep(cep) {
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
                $("input[name='endereco']").val(dados.logradouro);
                $("input[name='bairro']").val(dados.bairro);
                $("input[name='cidade']").val(dados.localidade);
                $("input[name='estado']").val(dados.uf);
            });
        }

        $("#buscaCep").change(function () {
            buscaCep($(this).val());
        });

        $("#searchCep").click(function (e) {
            e.preventDefault();
            buscaCep($("#buscaCep").val());
        });
    </script>

    @yield('scripts')
</body>

</html>
