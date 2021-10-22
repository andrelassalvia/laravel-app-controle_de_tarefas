@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Falta pouco agora. Necessita validaçao de email.</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                           Reenviamos um email para voce com um link de validacao.
                        </div>
                    @endif

                    Antes de utilizar or recursos valide seu email.
                    Caso não tenha recebido o email, clique no link a seguir.
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clique Aqui</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
