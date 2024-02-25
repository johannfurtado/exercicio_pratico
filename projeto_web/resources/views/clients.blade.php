@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Gerenciar Clientes</h4>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cadastrar Clientes</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('clients.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="name">Nome:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col">
                                    <label for="phone">Telefone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="zipcode">CEP:</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode" required>
                                </div>
                                <div class="col">
                                    <label for="address">Endereço:</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="col">
                                    <label for="city">Cidade:</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                                <div class="col">
                                    <label for="state">Estado:</label>
                                    <input type="text" class="form-control" id="state" name="state" required>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Novo Cliente</button>
                        </form>

                    </div>

                </div>
                <br><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-2">Nome</th>
                            <th class="col-2">E-mail</th>
                            <th class="col-1">Telefone</th>
                            <th class="col-1">CEP</th>
                            <th class="col-1">Endereço</th>
                            <th class="col-1">Cidade</th>
                            <th class="col-1">Estado</th>
                            @if (Auth::check() && Auth::user()->isAdmin())
                                <th class="col-1 align-end">Ações</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td class="align-middle">{{ $client->id }}</td>
                                <td class="align-middle">{{ $client->name }}</td>
                                <td class="align-middle">{{ $client->email }}</td>
                                <td class="align-middle">{{ $client->phone }}</td>
                                <td class="align-middle">{{ $client->zipcode }}</td>
                                <td class="align-middle">{{ $client->address }}</td>
                                <td class="align-middle">{{ $client->city }}</td>
                                <td class="align-middle">{{ $client->state }}</td>
                                @if (Auth::check() && Auth::user()->isAdmin())
                                    <td class="align-middle align-end">
                                        <button class="btn btn-primary edit-client" data-id="{{ $client->id }}"
                                            data-bs-toggle="modal" data-bs-target="#editclientModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div class="modal fade" id="editclientModal" tabindex="-1" aria-labelledby="editclientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editclientModalLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id= "editclientModalForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label for="name">Nome:</label>
                                <input type="text" class="form-control" id="modal-name" name="name" required>
                            </div>
                            <div class="col">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" id="modal-email" name="email" required>
                            </div>
                            <div class="col">
                                <label for="phone">Telefone:</label>
                                <input type="text" class="form-control" id="modal-phone" name="phone" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="zipcode">CEP:</label>
                                <input type="text" class="form-control" id="modal-zipcode" name="zipcode" required>
                            </div>
                            <div class="col">
                                <label for="address">Endereço:</label>
                                <input type="text" class="form-control" id="modal-address" name="address" required>
                            </div>
                            <div class="col">
                                <label for="city">Cidade:</label>
                                <input type="text" class="form-control" id="modal-city" name="city" required>
                            </div>
                            <div class="col">
                                <label for="state">Estado:</label>
                                <input type="text" class="form-control" id="modal-state" name="state" required>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editClientModal = document.querySelectorAll('.edit-client');

            editClientModal.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    var row = event.target.closest('tr');
                    var cells = row.querySelectorAll('td');

                    var clientId = button.dataset.id;
                    var clientName = cells[1].textContent.trim();
                    var clientEmail = cells[2].textContent.trim();
                    var clientPhone = cells[3].textContent.trim();
                    var clientZipcode = cells[4].textContent.trim();
                    var clientAddress = cells[5].textContent.trim();
                    var clientCity = cells[6].textContent.trim();
                    var clientState = cells[7].textContent.trim();

                    var nameInput = document.getElementById('modal-name');
                    nameInput.value = clientName;

                    var emailInput = document.getElementById('modal-email');
                    emailInput.value = clientEmail;

                    var phoneInput = document.getElementById('modal-phone');
                    phoneInput.value = clientPhone;

                    var zipcodeInput = document.getElementById('modal-zipcode');
                    zipcodeInput.value = clientZipcode;

                    var addressInput = document.getElementById('modal-address');
                    addressInput.value = clientAddress;

                    var cityInput = document.getElementById('modal-city');
                    cityInput.value = clientCity;

                    var stateInput = document.getElementById('modal-state');
                    stateInput.value = clientState;

                    var editForm = document.getElementById('editclientModalForm');
                    editForm.action = '/clients/' + clientId;

                });
            });
        });
    </script>
@endsection
