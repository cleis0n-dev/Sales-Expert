<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório - Pagamentos</title>

    <link href="{{ public_path('css/googleapi.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ public_path('css/internote.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link href="{{ public_path('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Short Icon -->
    <link rel="shortcut icon" href="{{ public_path('icons/favicon.png') }}">
</head>
<body>
    @include('pdf.header')
    <div class="container mb-3 text-dark">
        <div class="row">
            <div class="col">
                <h1 style="text-align: center;">Relatório de Pagamentos</h1>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="table-responsive">
            <table class="table table-striped" style="text-align: center;">
                <thead>
                    <tr>
                        <th><b>Nome:</b></th>
                        <th><b>Serviço:</b></th>
                        <th><b>Valor:</b></th>
                        <th><b>Data de Pagamento:</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($report as $report)
                    <tr>
                        <td><b>{{ $report->nome }}</b></td>
                        <td><b>{{ $report->descricao }}</b></td>
                        <td><b>{{ $report->valor }}</b></td>
                        <td><b>{{ date('d/m/Y',strtotime($report->created_at)) }}</b></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>






