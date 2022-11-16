@extends('layouts.pdf')

@section('content')
<div>
    <table>
        <tr class="table__header">
            <th>Date</th>
            <th>Name</th>
            <th>Total Hours</th>
            <th>Supervisor Assessment</th>
            <th>Signature</th>
        </tr>

            @foreach( $attendances as $attendance)

            <tr class="table__row">
                <td>{{$attendance->attendance_date}}</td>
                <td>{{$attendance->user->first_name}} {{$attendance->user->last_name}}</td>
                <td>{{$attendance->total_time}} </td>
                <td>{{$attendance->supervisor_ass}}</td>
            </tr>

            @endforeach
    </table>
    <div class="page-break"></div>
</div>
    

@endsection