@extends('dashboard')

@section('User')

<div class="container">
    <h2 class="text-center mb-4">Your Fitness Calendar</h2>

    <div class="calendar">
        <div class="month-header text-center">
            <h3>{{ \Carbon\Carbon::create($currentYear, $currentMonth)->format('F Y') }}</h3>
        </div>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $firstDayOfMonth = \Carbon\Carbon::create($currentYear, $currentMonth, 1)->dayOfWeek;
                    $dayCounter = 1;
                @endphp

                <tr>
                    {{-- Add empty cells for days before the first day of the month --}}
                    @for ($i = 0; $i < $firstDayOfMonth; $i++)
                        <td></td>
                    @endfor

                    {{-- Loop through the days of the month --}}
                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        <td>
                            <strong>{{ $day }}</strong>
                            
                            {{-- Check if there are any events for this day --}}
                            @foreach ($events as $event)
                                @if (\Carbon\Carbon::parse($event->start)->day == $day)
                                    <div class="event">
                                        <strong>{{ $event->title }}</strong><br>
                                        <small>{{ $event->description }}</small>
                                    </div>
                                @endif
                            @endforeach
                        </td>

                        {{-- Break the row after every 7 days (week) --}}
                        @if (($day + $firstDayOfMonth) % 7 == 0)
                            </tr><tr>
                        @endif
                    @endfor

                    {{-- Add empty cells for the rest of the week if the month ends mid-week --}}
                    @for ($i = 0; ($daysInMonth + $firstDayOfMonth) % 7 != 0 && $i < 7 - ($daysInMonth + $firstDayOfMonth) % 7; $i++)
                        <td></td>
                    @endfor
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .calendar {
        width: 100%;
        margin: 0 auto;
        max-width: 900px;
        padding: 30px 0;
    }
    .event {
        background-color: #f8d7da;
        padding: 5px;
        margin-top: 5px;
        border-radius: 5px;
    }
</style>

@endsection
