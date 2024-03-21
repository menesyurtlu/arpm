@extends('user-layout')

@section('content')
    <form class="row g-3 p-5" method="POST">
        @csrf
        <div class="col-12">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="New Event">
        </div>
        <div class="col-md-6">
            <label for="start" class="form-label">Start Date</label>
            <input type="datetime-local" class="form-control" name="start" id="start">
        </div>
        <div class="col-md-6">
            <label for="end" class="form-label">End Date</label>
            <input type="datetime-local" class="form-control" name="end" id="end">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-full" type="submit">Save</button>
        </div>
    </form>
@endsection
