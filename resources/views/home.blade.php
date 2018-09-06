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

                    You are logged in!
                </div>
            </div>
        </div>
    </div>

    <br />

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Email Accounts</div>

                <div class="card-body">

                    <table class="table">
                        <tr>
                            <th>Account name</th>
                            <th>Server</th>
                            <th>&nbsp;</th>
                        </tr>
                    @foreach ($emailAccounts as $account)
                    <tr>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->host }}</td>
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
</div>
@endsection
