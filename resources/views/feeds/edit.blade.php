@extends('layouts.container')

@section('container')

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Feed</div>

            <div class="card-body">

                {!! Form::model($model, ['route' => ['feeds.update', $model->id]]) !!}
                    {{ method_field('PUT') }}

                    @include('feeds.fields')

                    {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection
