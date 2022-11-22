@extends('layouts.app')

@section('content')

<form method="POST" action="/home/update/password/{{ $user->id}}">
    @csrf
    @method('PUT')

<div class="card-body">

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

<div class="row mb-3">
    <label for="antigopassword" class="col-md-4 col-form-label text-md-end">Confirmar Senha</label>

    <div class="col-md-6">
        <input id="antigopassword" type="password"   class="form-control @error('antigopassword') is-invalid @enderror" name="antigopassword">

        @error('antigopassword')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="row mb-3">
    <label for="password" class="col-md-4 col-form-label text-md-end">Nova Senha</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Nova Senha') }}</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    </div>
</div>
<div class="row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Editar') }}
        </button>
    </div>
</form>




@endsection