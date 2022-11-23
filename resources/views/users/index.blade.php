@extends('layouts.app')

@section('content')
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cursos ({{count($cursospart)}}):</div>
                @if(count($cursospart) == 0)
                <p>Você ainda não se maticulou em algum curso</p>
            @else
                <div class="row my-3 justify-content-left">
                    @foreach ($cursospart as $cursosingle)
                        <div class="ms-3 mt-2 col-5">
                            {{ $cursosingle->name }}
                        </div>
                        <div class="mt-2 col-2">
                            Nota:10
                        </div>
                        <div class="col-3">
                            <form action="/cursos/leave/{{ $cursosingle->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger">
                                    Desmatricular-se
                                </button>
                            </form> 
                        </div>
                @endforeach
            </div>
            
            @endif
            @endsection
            
                </div>
            </div>
        </div>
    </div>
</div>

