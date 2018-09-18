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
                        {{ substr(strip_tags($i->body), 0, 150) }}
                    </td>
                </tr>
                @endforeach

            </div>
        </div>
    </div>

@endsection
