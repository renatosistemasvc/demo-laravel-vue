<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Comprovante de Matrícula</title>
        <link rel="stylesheet" type="text/css" href="{{ public_path('relatorios/css/style-relatorio.css') }}" />
        <style>
           
            .table-relatorio-geral-aluno th{
                border-top: 1px solid #000; 
                border-bottom: 1px solid #000;
            }

            .table-relatorio-geral-aluno td{
                border: none;
                border-bottom: 1px dotted black;
            }

            .table-relatorio-geral-aluno p{
                font-size: 11px;
            }
        
        </style>

    </head>
    <body>

        <div>
            <table>
                <tr>
                    <th class="col-t-10 logo">
                        <img src="{{ public_path('relatorios/img/logo.png') }}">
                    </th>
                    <td valign="top" class="col-t-45 center top">
                        <h2>PREFEITURA DE VITÓRIA DA CONQUISTA</h2>
                        <h3>SECRETARIA MUNICIPAL DE EDUCAÇÃO</h3>
                    </td>
                    <td valign="top" class="col-t-45 center top">
                        <h1>
                            RELATÓRIO PRÉ-MATRÍCULA
                        </h1>
                        <p style="font-size: 15px;">
                            @if($ref == 1)
                                CONTEMPLADOS
                            @endif

                            @if($ref == 2)
                                FILA DE ESPERA
                            @endif

                            @if($ref == '')
                                CONTEMPLADOS E FILA DE ESPERA
                            @endif
                        </p>
                        <p>
                            {{ date("d/m/Y - h:m") }}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
       
        <div>

            @foreach($dados as $instituicao)
    
                <h1 style="margin-top: 30px; font-weight: bold;">{{ $instituicao['nome'] }}</h1>
                
                @foreach($instituicao['preMatriculaCursos'] as $turma)

                    <p style="font-size: 14px; margin-top: 20px;">
                        TURMA: {{ $turma['nome'] }} - QTD. VAGAS INICIAL: {{ $turma['qtd_vagas_inicial'] }}
                    </p>
                                        
                    <table class="table-relatorio-geral-aluno" >
                        <tr>
                            <th class="col-t-100">
                                <p style="text-align: center;"><b>Posição</b></p>
                            </th>
                            <th class="col-t-100">
                                <p><b>Inscritos</b></p>
                            </th>
                            <th class="col-t-100">
                                <p><b>DT. Nascimento</b></p>
                            </th>
                            <th class="col-t-100">
                                <p><b>Nome da Mãe</b></p>
                            </th>
                            <th class="col-t-100">
                                <p><b>Celular</b></p>
                            </th>
                            <th class="col-t-100">
                                <p><b>Situação da Vaga</b></p>
                            </th>
                        </tr>

                        @foreach($turma['preMatriculas'] as $val)

                            <tr>
                                <td class="col-t-100">
                                    <p style="text-align: center;">{{ $val['posicao'] }}</p>
                                </td>

                                <td class="col-t-100">
                                    <p>{{ $val['preMatriculaAluno']['nome'] }}</p>
                                </td>

                                <td class="col-t-100">
                                    <p>{{ date("d/m/Y", strtotime($val['preMatriculaAluno']['data_nascimento'])) }}</p>
                                </td>

                                <td class="col-t-100">
                                    <p>{{ $val['preMatriculaAluno']['mae'] }}</p>
                                </td>

                                <td class="col-t-100">
                                    <p>{{ $val['preMatriculaAluno']['celular'] }}</p>
                                </td>

                                <td class="col-t-100">
                                    <p>{{ ($val['situacao_vaga']) ? 'CONTEMPLADO' : 'FILA DE ESPERA' }}</p>
                                </td>
                            </tr>

                        @endforeach
                    </table>
                    <div style="text-align: right; background-color: #ccc; font-size: 12px; padding: 2px; padding-right: 10px; padding-left: 10px;">
                        Total {{ count($turma['preMatriculas']) }}
                    </div>

                @endforeach

            @endforeach

            @if(count($dados) == 0)
                <h3 style="text-align: center; margin-top: 50px;">Nenhum registro encontrado</h3>
            @endif

        </div>




    </body>
</html>
