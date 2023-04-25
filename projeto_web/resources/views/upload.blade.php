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
                    <br>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection