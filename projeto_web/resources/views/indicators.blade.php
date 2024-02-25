@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Indicadores totais</h2>
        <br>
        <div class="row">
            <div class="row col-md-12 d-flex justify-content-between">
                <div class="card col-md-3 text-bg-warning">
                    <div class="card-body">
                        <div>
                            <i class="bi bi-cash-stack" style="font-size: 3rem;"></i>
                            <h3>N° de Pagamentos</h3>
                            <h5>Total de pagamentos: {{ $totalPayments }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card col-md-4 text-bg-success">
                    <div class="card-body">
                        <div>
                            <i class="bi bi-currency-dollar" style="font-size: 3rem;"></i>
                            <h3>Faturamento</h3>
                            <h5>Total de faturamento: R$ {{ number_format($totalAmount, 2, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card col-md-3 text-bg-info">
                    <div class="card-body">
                        <div>
                            <i class="bi bi-people" style="font-size: 3rem;"></i>
                            <h3>Clientes</h3>
                            <h5>Total de clientes: {{ $totalClients }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <h2>Gráfico de indicadores</h2>
        <br>
        <div class="row">
            <div class="col-md-12">
                <canvas id="myChart">
                </canvas>
            </div>
        </div>
    </div>
@endsection

@push('graphics')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $paymentTypes = {!! json_encode($paymentTypes) !!};
            var paymentTypesNames = $paymentTypes.map(function(paymentType) {
                return paymentType.name;
            });

            var paymentTypesTotals = {!! json_encode($totalByPaymentType->pluck('total')) !!};

            var ctx = document.getElementById("myChart");
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: paymentTypesNames,
                    datasets: [{
                        label: 'Tipos de pagamento',
                        data: paymentTypesTotals,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
