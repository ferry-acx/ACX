@extends('layouts.pdf')

@section('content')
<br><br>
<div>
    <table>
        <tr class="table__header">
            <th>Name</th>
            <th>Total Hours</th>
            <th>Signature</th>
        </tr>

        @foreach( $attendances as $attendance)

        <tr class="table__row">
            <td>{{$attendance->user->first_name}} {{$attendance->user->last_name}}</td>
            <td>{{$attendance->total_time}} </td>
            <td></td>
        </tr>

        @endforeach
    </table>
    <div class="page-break"></div>
</div>


@endsection