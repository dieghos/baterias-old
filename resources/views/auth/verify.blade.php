@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique su casilla de email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Ha sido enviado un enlace de verificación a su email.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, revise si recibió en su email un enlace de verificación.') }}
                    {{ __('Si no recibió el email:') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
		                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Clickee para reenviar') }}</button>.
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
