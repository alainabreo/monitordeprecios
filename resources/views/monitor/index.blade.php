@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Monitoreo de Precios
                </div>
                <div class="card-body">
                    <form action="{{ url('/monitor') }}" method="get">
                        <div class="form-group">
                            <label for="search">Buscar Item</label>
                            <input type="text" name="search" id="search" value="{{ $search }}" class="form-control" placeholder="Ingresar nombre de item y presionar ENTER">
                        </div>
                    </form>
                    <p class="text-center">Valores cargados en la última semana ({{ $startDate }} - {{ $endDate }})</p>

                    {{ $items->appends(['search' => $search])->links() }}                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Menor Valor</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td width="60%">
                                        {{ $item->name }}
                                    </td>
                                    <td> {{ $item->lowestValue($startDate, $endDate) }} </td>
                                    <td>
                                        <a href="{{
                                            route('monitor', [
                                                'search' => $search,
                                                'page' => $items->currentPage(),
                                                'item_id' => $item->id
                                            ])
                                        }}" class="btn btn-primary">
                                            <i class="fas fa-binoculars"></i>
                                        </a>                                       
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            @if (count($prices) > 0)
            <div class="card mt-4">
                <div class="card-header">
                    Detalles del item seleccionado
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Ubicación</th>
                                <th>Valor cargado</th>
                                <th>Fecha</th>
                                @if (auth()->user()->is_admin)
                                    <th>Opciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prices as $price)
                                <tr>
                                    <td>{{ $price->user->name }}</td>
                                    <td>{{ $price->location->name }}</td>
                                    <td>{{ $price->value }}</td>
                                    <td> {{ $price->created_at }} </td>
                                    @if (auth()->user()->is_admin)
                                        <td align="right">
                                            <form action="{{ url('/prices/'.$price->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" href="" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
