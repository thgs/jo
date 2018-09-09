@extends('layouts.container')

@section('container')

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Feed</div>

            <div class="card-body">

                {!! Form::open(['route' => 'feeds.store']) !!}

                    @include('feeds.fields')

                    {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection
