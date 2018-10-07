@extends('layouts.mailview')

@section('side')

    <div class="card">
        <div class="card-header">
            <small>Account Name</small>
            <b>{{ $account->name }}</b>            
        </div>

        <div class="card-body">

            @foreach ($folders as $folderName => $folder)
                {{ $folderName }}<br />
            @endforeach

        </div>
    </div>

@endsection

@section('body')

    <div class="card">
        <div class="card-header">FOLDER NAME</div>

        <div class="card-body">

            <table class="table">
                <tr>
                    <th>UID</th>
                    <th>From</th>
                    <th>Stored at</th>
                    <th>Size</th>
                </tr>
            @foreach ($messages as $m)
            <tr>
                <td>
                    {{ $m->uid }}
                    {{-- @php(dump( $m->getUid() )) --}}
                </td>
                <td>
                    {{ $m->from }}
                    {{-- @php(dump( $m->getFrom() )) --}}
                    <br />
                    <small>
                        {{ imap_utf8( $m->subject ) }}
                        {{-- @php(dump( $m->getSubject() )) --}}
                    </small>
                </td>
                <td>
                    {{ $m->created_at->format('H:i:s d/m/y') }}
                    {{-- @php(dump( $m->getDate() )) --}}
                </td>
                <td>
                    {{ $m->getSize() }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    {!! $m->body !!}
                </td>
            </tr>
            @endforeach

        </div>
    </div>

@endsection
