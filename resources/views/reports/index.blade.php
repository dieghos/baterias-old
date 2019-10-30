@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($products))
            <div class="row">
                <div class="col-md-6">
                    <select-request-component></select-request-component>
                </div>
            </div>
            <hr>
            @switch($products->type)
                @case('monthly')
                    @include('partials.monthTable', ['products' => $products])
                    @break
                @case('yearly')
                    @include('partials.yearlyTable',['products'=>$products])  
                    @break
                @case('model')
                    @include('partials.modelTable',['products'=>$products])        
                    @break
                @default
                <h3>Default</h3>        
            @endswitch
        @else
            <h4 class="text-center">No hay estadisticas para mostrar</h4>    
            <select-request-component></select-request-component>
        @endif
    </div>
    
@endsection