<?php

use App\Models\Event;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

$startDate = request()->has('start') ? Carbon::parse(request()->start)->startOfWeek() : Carbon::now()->startOfWeek();
$endDate = request()->has('start') ? Carbon::parse(request()->start)->endOfWeek() : Carbon::now()->endOfWeek();

$startPeriod = Carbon::parse('6:00');
$endPeriod = Carbon::parse('23:59');

$timePeriod = CarbonPeriod::create($startPeriod, '1 hour', $endPeriod);
$hours = [];

foreach ($timePeriod as $date) {
    $hours[] = $date->format('H:i');
}

$period = CarbonPeriod::between($startDate, $endDate);
$dates = [];

foreach ($period as $date) {
    $dates[] = $date->format('d M Y');
}

$events = Event::whereBetween('created_at', [$startDate->format('Y-m-d') . " 00:00:00", $endDate->format('Y-m-d') . " 23:59:59"])->get();

?>
@extends('user-layout')

@section('content')
    <div class="p-2 d-flex flex-row justify-content-between">
        <a href="?start={{ Carbon::parse(request()->start)->startOfWeek()->subWeek()->format('Y-m-d') }}" class="btn btn-primary">Previous Week</a>
        <a href="?start={{ Carbon::now()->startOfWeek()->format('Y-m-d') }}" class="btn btn-primary">Today</a>
        <a href="?start={{ Carbon::parse(request()->start)->startOfWeek()->addWeek()->format('Y-m-d') }}" class="btn btn-primary">Next Week</a>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            @foreach($dates as $date)
                <th class="{{ Carbon::now()->format('Y-m-d') === Carbon::parse($date)->format('Y-m-d') ? 'fw-bold': 'fw-light' }}">
                    {{$date}}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($hours as $hour)
            <tr class="day">
                <td>{{ $hour }}</td>
                @foreach($dates as $date)
                    <td>
                        @foreach($events as $event)
                            @if(
    date('Y-m-d', strtotime($event->start)) === date('Y-m-d', strtotime($date)) &&
     Carbon::parse($event->start)->format('G') === Carbon::parse($hour)->format('G')
     )
                                <div class="event-card">
                                    <div class="title mb-3">
                                        {{ $event->title }}
                                    </div>
                                    <div class="time-range mb-3">
                                        {{ $event->start }} - {{ $event->end }}
                                    </div>
                                    <a href="/event/delete?id={{ $event->id }}" class="delete-button btn btn-danger btn-sm">Delete</a>
                                </div>
                            @endif
                        @endforeach
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

