@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar dependencia') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('dependences.update',['dependence' => $dependence->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Codigo') }}</label>
    
                                <div class="col-md-6">
                                    <input id="code" value="{{ $dependence->code }}" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="code"> @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $dependence->name }}" required autocomplete="name" autofocus> @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar') }}
                                    </button>
                                    <a class="btn btn-light" href="{{ route('dependences.home') }}">
                                            {{ __('Atras') }}
                                        </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection