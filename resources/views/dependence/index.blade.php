@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>    
@endif
<div class="container">
    <h2 class="text-center">Dependencias</h2>
    <div class="text-right">
        <a href="{{ route('dependences.create') }}" class="btn btn-lg btn-primary">Nueva</a>
    </div>
    <hr>
    @if (count($dependences)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{__('Codigo')}}</th>
                    <th>{{__('Nombre')}}</th>
                    <th>{{__('Acciones')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dependences as $dependence)
                    <tr>
                        <td>{{ $dependence->code }}</td>
                        <td>{{ $dependence->name }}</td>
                        <td>
                            <a href="{{ route('dependences.edit', ['dependence' => $dependence->id])}}" class="btn btn-sm btn-primary">Editar</a>
                        </td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
        {{ $dependences->links() }}
    @else
        <h3 class="text-center">No se encontraron registros en la base de datos.</h3>        
    @endif
</div>
@endsection