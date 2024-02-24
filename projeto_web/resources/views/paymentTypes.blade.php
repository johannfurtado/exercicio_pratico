@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Olá admin, aqui você pode criar novos tipos de pagamentos</h4>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cadastrar novo tipo de pagamento</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('paymentTypes.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="row">
                        <div>
                            <h5>Tipos de Pagamento Cadastrados:</h5>
                        </div>
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th class="col-8">Tipo de Pagamento</th>
                                        <th class="col-1 align-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentTypes as $paymentType)
                                        <tr>
                                            <td class="align-middle">{{ $paymentType->id }}</td>
                                            <td class="align-middle">{{ $paymentType->name }}</td>
                                            <td class="align-middle align-end">
                                                <button class="btn btn-primary edit-payment"
                                                    data-id="{{ $paymentType->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#editPaymentTypeModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form method="POST"
                                                    action="{{ route('paymentTypes.destroy', $paymentType->id) }}"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div class="modal fade" id="editPaymentTypeModal" tabindex="-1" role="dialog"
        aria-labelledby="editPaymentTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPaymentTypeModalLabel">Editar Tipo de Pagamento</h5>
                </div>
                <form id="editPaymentTypeForm" method="POST" action="{{ route('paymentTypes.update', $paymentType->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name">Nome:</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
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

                    var paymentTypeId = button.dataset.id;
                    var paymentTypeName = cells[1].textContent.trim();

                    var editNameInput = document.getElementById('edit_name');
                    editNameInput.value = paymentTypeName;

                    var editForm = document.getElementById('editPaymentTypeForm');
                    editForm.action = '/payment-types/' + paymentTypeId;
                });
            });
        });
    </script>
@endsection
