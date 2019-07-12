@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Ubicaciones
                </div>
                <div class="card-body">
                    <form action="{{ url('/locations') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Ubicación</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ubicación</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations as $location)
                                <tr>
                                    <td width="80%">
                                        {{ $location->name }}
                                    </td>
                                    <td align="right" width="20%">
                                        <form action="{{ url('/locations/'.$location->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" href="" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
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
@endsection
