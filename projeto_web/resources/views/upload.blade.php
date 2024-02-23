@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <h5><label for="file">Selecione um arquivo para fazer upload:</label></h5>
                            <input type="file" name="file" class="form-control-file" id="file">
                        </div>
                        @if (Session::has('success'))
                            <br>
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <br>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
