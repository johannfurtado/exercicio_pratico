@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <h2>Olá Admin :)</h2>
                <br>
                <h5>Aqui estão todos os arquivos carregados pelos usuários:</h5>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Usuário</th>
                            <th>Nome do arquivo</th>
                            <th>Data</th>
                            <th class="text-center align-middle">Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $file)
                            <tr class="align-middle">
                                <td>{{ $file->user->name }}</td>
                                <td>{{ $file->name }}</td>
                                <td>{{ $file->created_at->format('d/m/Y') }}</td>
                                <td class="text-center align-middle">
                                    @if ($file->status == 'approved')
                                        <i class="fas fa-check text-success"></i> <!-- Ícone de check verde -->
                                    @elseif($file->status == 'rejected')
                                        <i class="fas fa-times text-danger"></i> <!-- Ícone de x vermelho -->
                                    @else
                                        <span>Pendente</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.approve', ['id' => $file->id, 'name' => $file->name]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Aprovar</button>
                                    </form>
                                    <form action="{{ route('admin.reject', ['id' => $file->id, 'name' => $file->name]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger">Reprovar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
