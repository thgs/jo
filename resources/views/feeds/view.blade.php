@extends('layouts.container')

@section('container')


    <div class="col-md-12">
        <div class="card">
            <div class="card-header">View / Feed / {{ $feed->name }}</div>

            <div class="card-body">

                <table class="table">
                @foreach ($items as $i)
                <tr>
                    <td><h2><a href="{{ $i->link }}">{{ $i->title }}</a></h2></td>
                </tr>
                <tr>
                    <td>
                        {!! $i->body !!}
                    </td>
                </tr>
                @endforeach

            </div>
        </div>
    </div>

@endsection
