@extends('layouts.app')

@section('meta')
    <meta name="user-id" content="{{ Auth::user()->id }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <income-expense></income-expense>
            </div>
        </div>
    </div>
</div>
@endsection
