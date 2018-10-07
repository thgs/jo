@extends('layouts.container')

@section('container')

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Settings</div>

            <div class="card-body">

                {!! Form::open(['route' => 'settings.store']) !!}

                    @include('settings.all')

                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>


@endsection
