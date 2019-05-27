@extends('layouts.layout')
@section('content')
    <div class="container">
        <h2 class="py-4">
            Encontros
        </h2>
        <div class="meetings">
            @foreach($meetings as $meeting)
                <div class="alert alert-primary" role="alert">
                    <a href="">
                        {{ $meeting->day }}
                    </a>
                    @if($meeting->description)
                        <p>
                            {{ $meeting->description }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
