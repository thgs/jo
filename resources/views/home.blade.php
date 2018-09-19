@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        You are logged in!
                    </p>

                    <p>
                        We currently store <b>{{ $emailsCount }}</b> emails in <b>{{ $emailAccounts->count() }}</b> email
                        accounts and <b>{{ $postsCount }}</b> posts for <b>{{ $feeds->count() }}</b> subscribed feeds!
                    </p>


                </div>
            </div>
        </div>
    </div>

    <br />

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-info">Email Accounts</div>

                <div class="card-body">

                    <table class="table">
                        <tr>
                            <th>Account name</th>
                            <th>Last Sync</th>
                            <th>Sync Every (mins)</th>
                            <th>&nbsp;</th>
                        </tr>
                    @foreach ($emailAccounts as $account)
                    <tr>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->updated_at->format('H:i:s d/M') }}</td>
                        <td>{{ $account->sync_every }}</td>
                        <td>
                            <a href="{{ route('emailaccounts.view', $account->id) }}" class="col-sm-2">View</a>
                            <a href="{{ route('emailaccounts.edit', $account->id) }}" class="col-sm-2">Settings</a>
                            <a href="{{ route('emailaccounts.delete', $account->id) }}" class="col-sm-2">Remove</a>
                        </td>
                    </tr>
                    @endforeach
                    </table>


                </div>
            </div>


        </div>
    </div>

    <br />

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning">Subscribed Feeds</div>

                <div class="card-body">

                    <table class="table">
                        <tr>
                            <th>Feed name</th>
                            <th>Last Sync</th>
                            <th>Sync Every (mins)</th>
                            <th>&nbsp;</th>
                        </tr>
                    @foreach ($feeds as $feed)
                    <tr>
                        <td>{{ $feed->name }}</td>
                        <td>{{ $feed->updated_at->format('H:i:s d/M') }}</td>
                        <td>{{ $feed->update_every }}</td>
                        <td>
                            <a href="{{ route('feeds.show', $account->id) }}" class="col-sm-2">Posts</a>
                            <a href="{{ route('feeds.edit', $account->id) }}" class="col-sm-2">Edit</a>
                            <a href="{{ route('feeds.delete', $account->id) }}" class="col-sm-2">Remove</a>
                        </td>
                    </tr>
                    @endforeach
                    </table>


                </div>
            </div>


        </div>
    </div>


</div>
@endsection
