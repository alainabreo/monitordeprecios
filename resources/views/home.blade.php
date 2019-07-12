@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Cargar valores
                </div>

                <div class="card-body">
                    <form action="{{ url('/prices') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="location">Ubicacion</label>
                            <select name="location_id" id="location" class="form-control">
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="item">Item</label>
                            <select name="item_id" id="item" class="form-control">
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="value">Valor a cargar</label>
                            <input type="text" class="form-control" name="value" id="value" placeholder="0.00">
                        </div>
                        <div class="form-group">
                            <label for="date">Fecha actual</label>
                            <input type="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" disabled>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Confirmar y cargar valor
                        </button>          
                    </form>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    Últimos valores cargados
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Ubicacion</th>
                                <th>Valor</th>
                                <th>Fecha de Carga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prices as $price)
                                <tr>
                                    <td>{{ $price->item->name }}</td>
                                    <td>{{ $price->location->name }}</td>
                                    <td>{{ $price->value }}</td>
                                    <td>{{ $price->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $prices->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
