@extends('layouts.template')
@section('title', 'Cre')
@section('body')
    <div class="container">
        <h1 class="mt-5">Dashboard</h1>
        <p>Welcome to the admin dashboard!</p>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text">253</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Posts</h5>
                        <p class="card-text">25253</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Comments</h5>
                        <p class="card-text">777</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
