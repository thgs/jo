@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        @yield('container')

    </div>
</div>



@endsection

@section('scripts')
    @yield('page-scripts')
@endsection
