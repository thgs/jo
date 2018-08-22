@extends('layouts.container')

@section('container')

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Email Account</div>

            <div class="card-body">

                {!! Form::open(['route' => 'emailaccounts.store']) !!}

                    @include('emailaccounts.fields')

                    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection
