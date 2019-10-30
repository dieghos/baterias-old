@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="font-weight-bold mb-1">Detalles</h3>
        <h4>Orden Nº {{$order["order_id"]}}</h4>
        <hr>
        <dt class="font-weight-bold">Dependencia</dt>
        <dd>{{ $order->dependence->name }}</dd>
        <dt class="font-weight-bold">Productos</dt>
        <dd>
            <ul>
                @foreach ($order->products()->get() as $product)
                    <li>{{ $product->name }}</li>  
                @endforeach
            </ul>
        </dd>

        <p class="text-center mt-2">
            <a class="btn btn-lg btn-primary" href="#">{{__('Regenerar recibo')}}</a>
            <a class="btn btn-lg btn-light" href="#">{{__('Guardar recibo')}}</a>
        </p>
    </div>
@endsection