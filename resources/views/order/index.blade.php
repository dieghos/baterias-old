@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">{{__("Ordenes")}}</h3>
        <ul class="nav justify-content-center">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('orders.home',['type'=>'Entrega'])}}">{{__('Entregas')}}</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('orders.home',['type'=>'Devolución'])}}">{{__('Devoluciones')}}</a>
            </li>
        </ul>
        @if (count($orders)>0)
            <div class="list-group">
                @foreach ($orders as $order)
            <a href="{{route('orders.show',['order'=>$order->id])}}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $order->dependence->code .' - '.$order->dependence->name}}</h5>
                        <small>Orden Nº{{ $order->id}}</small>
                    </div>
                    <ul>
                        @foreach ($order->products()->get() as $product)
                            <li>{{ $product->name." - ". $product->pivot->quantity." unidades"}}</li>  
                        @endforeach
                    </ul>
                <small>Entregado: {{ $order["created_at"]}}</small>
                </a>        
                @endforeach
            </div>    
        @else
            <hr>
            <h5 class="text-center">No se encontraron registros</h5>
        @endif
    </div>
@endsection