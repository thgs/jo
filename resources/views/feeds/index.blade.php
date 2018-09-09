@extends('layouts.container')

@section('container')

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Feed</div>

            <div class="card-body">

                <a target="_blank" href="{{ route('feeds.create') }}">Add new feed</a>


                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>URL / Updated At</th>
                        <th></th>
                    </tr>
                    @forelse ($feeds as $f)
                    <tr>
                        <td>{{ $f->id }}</td>
                        <td>{{ $f->name }}</td>
                        <td>
                            <small>
                                {{ $f->url }}<br />
                                <b>Last Update: </b><br />
                                {{ $f->updated_at->format('d/m/y H:i:s') }}
                            </small>
                        </td>
                        <td>
                            <a href="{{ route('feeds.show', $f->id) }}">show</a>
                            <a href="#">force-update</a>
                            <a href="{{ route('feeds.edit', $f->id) }}">edit</a>
                            <a href="{{ route('feeds.delete', $f->id) }}">delete</a>
                        </td>
                    </tr>
                    @empty
                    <p>No feeds yet</p>
                    @endforelse
                </table>

            </div>
        </div>
    </div>

@endsection
