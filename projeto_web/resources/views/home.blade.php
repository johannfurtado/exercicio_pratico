@extends('layouts.app')

@section('content')
@php
$user = auth()->user();
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    {{ __('Você está logado, faça upload de arquivos clicando') }}
                    <a href="/upload">
                        <span> aqui!</span>
                    </a>
                </div>
            </div>
            <br>
            <h5>Aqui estão seus arquivos carregados:</h5>
            @if ($user->files()->count() > 0)
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome do arquivo</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->files as $file)
                    <tr>
                        <td>{{ $file->name }}</td>
                        <td>{{ $file->created_at->format('d/m/Y') }}</td>
                        <td>{{ $file->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Você não possui nenhum arquivo carregado.</p>
            @endif
        </div>
    </div>
</div>
@endsection