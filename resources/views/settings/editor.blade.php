@extends('layouts.container')

@section('container')

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Settings</div>

            <div class="card-body">

                {!! Form::open(['route' => 'settings.store']) !!}

                    <input type="hidden" name="editor" value="true" />

                    <div class="form-group">
                        <textarea class="form-control" rows="10" name="settings">{{ $settings }}</textarea>
                    </div>
                    
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>


@endsection
