@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Registrar Item
                </div>
                <div class="card-body">
                    <form action="{{ url('/items') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Item</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese el Nombre del nuevo Item y de [ENTER]">
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">
                    Items
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <form action="{{ url('/items') }}" method="get">
                                        <div class="form-group">
                                            <input type="text" name="search" class="form-control" placeholder="Buscar item" value="{{ $search }}">
                                        </div>
                                    </form>                                    
                                    Item
                                </th>
                                <th>Fecha de registro</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td width="50%">                                        
                                        {{ $item->name }}
                                    </td>
                                    <td width="30%">
                                        {{ $item->created_at }}
                                    </td>
                                    <td align="right" width="20%">
                                        <form action="{{ url('/items/'.$item->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <a href="{{ url('/items/'.$item->id) }}" class="btn btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>                                            
                                            <button type="submit" href="" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- appends permite asociar parametros get adicionales a los enlaces -->
                    {{ $items->appends(['search' => $search])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
