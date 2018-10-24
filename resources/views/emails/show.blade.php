@extends('layouts.mailview')


@section('topbar')
    <div class="bg-info">
        <h1 class="display-5">{!! imap_utf8( $model->subject ) !!}</h5>
        <small>
            Received : {{ $model->created_at->format('d/m/y H:i:s') }}
            <br />
            From : {{ $model->from }} |
            To : {{ $model->to }} |
            CC : {{ $model->cc }} |
            BCC : {{ $model->bcc }} |
            UID : {{ $model->uid }} |
            Size : {{ $model->getSize() }} | 
            Priority : {{ $model->priority }}
        </small>
    </div>

@endsection

@section('body')

    {!! $model->body !!}

@endsection