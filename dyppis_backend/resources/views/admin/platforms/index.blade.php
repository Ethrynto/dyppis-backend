<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.template')
@section('title', 'DYPPIS - Platforms Dashboard')

@section('body')
    <div class="container admin-panel">
        <div class="row g-2 mt-5 mb-5">
            <h1 class="col-md-10">Platforms</h1>
            <a href="{{ route('admin.platforms.create') }}" class="btn btn-success col-md-2 d-flex justify-content-center align-items-center">Create a new platform</a>
        </div>

        <!-- Filters and sorting -->
        <form method="GET" action="" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="sortBy" class="form-label">Sort by</label>
                    <select name="sortBy" id="sortBy" class="form-select">
                        <option value="title" {{ $sortBy === 'title' ? 'selected' : '' }}>Name</option>
                        <!-- Add other sortable fields if needed -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="orderBy" class="form-label">Order</label>
                    <select name="orderBy" id="orderBy" class="form-select">
                        <option value="asc" {{ $orderBy === 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ $orderBy === 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="size" class="form-label">Records per page</label>
                    <select name="size" id="size" class="form-select">
                        @for($i = 5; $i <= 100; $i += 5)
                            <option value="{{ $i }}" {{ $size == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3 align-self-end">
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div>
            </div>
        </form>

        <!-- Table of platforms -->
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($platforms as $platform)
                <tr>
                    <td>
                        <img src="{{ $logoCategory }}/{{ $platform->logo->file_name }}" width="60px" height="60px" alt="{{ $platform->title }} logo">
                    </td>
                    <td>{{ $platform->title }} @if($platform->parent != null) <i>({{ $platform->parent->title }})</i> @endif</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Remove</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">Platforms not found!</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center align-items-center">
            {{ $platforms->appends(['sortBy' => $sortBy, 'orderBy' => $orderBy, 'size' => $size])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
