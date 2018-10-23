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
                    <th>Subject / From</th>
                    <th>Stored at</th>
                </tr>
            @foreach ($messages as $m)
            <tr>
                <td class="col-md-6 text-primary">
                    <h5>
                        {!! wordwrap(imap_utf8( $m->subject ), 50, '<br />', true) !!}
                    </h5>
                    {{-- @php(dump( $m->getSubject() )) --}}
                    <small class="text-danger">
                        {{ $m->from }}
                        {{-- @php(dump( $m->getFrom() )) --}} 
                        |
                        UID: {{ $m->uid }}
                        |
                        Size: {{ $m->getSize() }}
                    </small>
                </td>
                <td>
                    {{ $m->created_at->format('H:i:s d/m/y') }}
                    {{-- @php(dump( $m->getDate() )) --}}
                </td>
            </tr>
            @endforeach

        </div>
    </div>

@endsection
