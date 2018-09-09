@extends('layouts.mailview')

@section('side')

    <div class="card">
        <div class="card-header">{{ $account->name }}</div>

        <div class="card-body">

            @foreach ($folders as $folder)
                {{ $folder->name }}<br />
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
                    <th>Received</th>
                    <th>Size</th>
                </tr>
            @foreach ($messages as $m)
            <tr>
                <td>
                    {{ $m->getUid() }}
                    {{-- @php(dump( $m->getUid() )) --}}
                </td>
                <td>
                    {{ $m->getFrom()[0]->full }}
                    {{-- @php(dump( $m->getFrom() )) --}}
                    <br />
                    <small>
                        {{ imap_utf8( $m->getSubject() ) }}
                        {{-- @php(dump( $m->getSubject() )) --}}
                    </small>
                </td>
                <td>
                    {{ $m->getDate() }}
                    {{-- @php(dump( $m->getDate() )) --}}
                </td>
                <td>-</td>
            </tr>
            @endforeach

        </div>
    </div>

@endsection
