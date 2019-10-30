@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Escritorio</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul>
                        <li>
                            <a href="{{ route('products.home')}}">{{__('Productos')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('dependences.home')}}">{{__('Dependencias')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('transactions.deliver')}}">{{__('Entrega de equipamiento')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('transactions.return')}}">{{__('Devolución de equipamiento')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('orders.home')}}">{{__('Ordenes')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('reports.home')}}">{{__('Reportes')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
