@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Yama otário') }}
                </div>
            </div>
        </div>
    </div>
</div>

@if(count($cursospart) == 0)
    <p>Você ainda não se maticulou em algum curso</p>
@else
    <p>Cursos ({{count($cursospart)}}):</p>
    @foreach ($cursospart as $cursosingle)
        <p>{{ $cursosingle->name }}</p> 
        <a href="">Desmatricular-se</a>
    @endforeach

@endif
@endsection
