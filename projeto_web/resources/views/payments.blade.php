@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Gerenciar Pagamentos</h4>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cadastrar Pagamento</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('payments.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="client_id">Cliente:</label>
                                    <select class="form-select" id="client_id" name="client_id" required>
                                        <option value="">Selecione</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="value">Valor:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="number" class="form-control" id="value" name="value" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="type_id">Tipo:</label>
                                    <select class="form-select" id="type_id" name="type_id" required>
                                        <option value="">Selecione</option>
                                        @foreach ($paymentTypes as $paymentType)
                                            <option value="{{ $paymentType->id }}">{{ $paymentType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="date">Data do pagamento:</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Novo Pagamento</button>
                        </form>
                    </div>
                </div>
                <br><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-3">Cliente</th>
                            <th class="col-2">Valor</th>
                            <th class="col-2">Tipo</th>
                            <th class="col-2">Data</th>
                            @if (Auth::check() && Auth::user()->isAdmin())
                                <th class="col-1 align-end">Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="align-middle">{{ $payment->id }}</td>
                                @foreach ($clients as $client)
                                    @if ($client->id == $payment->client_id)
                                        <td class="align-middle" data-client-id="{{ $client->id }}">{{ $client->name }}
                                        </td>
                                    @endif
                                @endforeach
                                <td class="align-middle">R$ {{ number_format($payment->value) }}</td>
                                @foreach ($paymentTypes as $paymentType)
                                    @if ($paymentType->id == $payment->type_id)
                                        <td class="align-middle" data-type-id="{{ $paymentType->id }}">
                                            {{ $paymentType->name }}</td>
                                    @endif
                                @endforeach
                                <td class="align-middle">
                                    {{ date('d/m/Y', strtotime($payment->date)) }}</td>
                                @if (Auth::check() && Auth::user()->isAdmin())
                                    <td class="align-middle align-end">
                                        <button class="btn btn-primary edit-payment" data-id="{{ $payment->id }}"
                                            data-bs-toggle="modal" data-bs-target="#editPaymentModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST" action="{{ route('payments.destroy', $payment->id) }}"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Edição puxando os dados para os campos -->
    <div class="modal fade" id="editPaymentModal" tabindex="-1" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPaymentModalLabel">Editar Pagamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPaymentModalForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="client_id" class="text-start">Cliente:</label>
                            <select class="form-select" id="modal-client_id" name="client_id" required>
                                <option value="">Selecione</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="value" class="text-start">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="number" class="form-control" id="modal-value" name="value" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="type_id" class="text-start">Tipo:</label>
                            <select class="form-select" id="modal-type_id" name="type_id" required>
                                <option value="">Selecione</option>
                                @foreach ($paymentTypes as $paymentType)
                                    <option value="{{ $paymentType->id }}">{{ $paymentType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="date" class="text-start">Data do pagamento:</label>
                            <input type="date" class="form-control" id="modal-date" name="date" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-payment');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    var row = event.target.closest('tr');
                    var cells = row.querySelectorAll('td');

                    var paymentId = button.dataset.id;
                    var clientName = cells[1].getAttribute('data-client-id');
                    var value = cells[2].textContent.trim().replace('R$', '').replace('.', '')
                        .replace(',', '').trim();
                    var typeId = cells[3].getAttribute('data-type-id');

                    var date = cells[4].textContent.trim();
                    var dateParts = date.split('/');
                    var formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];

                    var clientInput = document.getElementById('modal-client_id');
                    clientInput.value = clientName;

                    var valueInput = document.getElementById('modal-value');
                    valueInput.value = value;

                    var typeIdSelect = document.getElementById('modal-type_id');
                    typeIdSelect.value = typeId;

                    var dateInput = document.getElementById('modal-date');
                    dateInput.value = formattedDate;

                    var editForm = document.getElementById('editPaymentModalForm');
                    editForm.action = '/payments/' + paymentId;
                });
            });
        });
    </script>
@endsection
