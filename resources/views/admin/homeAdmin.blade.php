@extends('layouts.main')

@section('content')
@include('includes.messages')
<div class="user__dashboard container-py">
    <div class="row">
        <div class="col">
            <div class="user__dashboard__grid">
                <div class="user__dashboard__item">
                    <div class="user__dashboard__grid">
                        <div class="user__dashboard__item">
                            <div class="user__dashboard__table">
                                <div class="user__dashboard__title">Welcome Back, <span>{{Auth::user()->username}}!</span>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <div class="style-header">ATTENDANCES FOR TODAY</div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table-bordered table" id= "table-id">
                                            <thead>
                                                <tr class="table__header">
                                                    <th>Date</th>
                                                    <th>Employee Name</th>
                                                    <th>Time in</th>
                                                    <th>Time out</th>
                                                    <th>Actions</th>
                                                </tr>                                  
                                            </thead>

                                            <tbody>
                                                @foreach( $attendances as $attendance)
                                                <tr class="table__row">
                                                    <td>{{$attendance->attendance_date}}</td>
                                                    <td>{{$attendance->user->first_name}} {{$attendance->user->last_name}}</td>                                                        
                                                    <td>{{$attendance->time_in}}</td>
                                                    <td>{{$attendance->time_out}} </td>
                                                    <td><a href="/admin/attendance"><button type="submit" class="btn btn-primary" name="view">View</button></a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        
                                        <div class="form-group float-right"><br><br>
                                            <div class="table__data">Rows per page:</div>
                                            <select class  ="form-control" name="rows" id="maxRows" style="width:90px">
                                                <option value="5000">Show All Rows</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="70">70</option>
                                                <option value="100">100</option>
                                            </select>			 		
                                        </div>

                                        <div class="pagination-container" >
                                            <nav>
                                                <ul class="pagination-pag">
                                                    <li data-page="prev" >
                                                        <span class="page-link" > Prev <span class="sr-only"></span></span>
                                                    </li>
                                                        
                                                    <li data-page="next" id="prev" >
                                                        <span class="page-link"> Next <span class="sr-only"></span></span>
                                                    </li>
                                                </ul>
                                            </nav>                                                            
                                        </div>
                                    </div>
                                </div>               
                            </div>
                        </div>
                    </div>

                    <div class="user__dashboard__calendar">
                        <div class="card">
                            <div class="calendar">
                                <div class="calendar-header">
                                    <span>Activity</span>
                                    <div class="month-picker">
                                        <span class="month-change" id="prev-month">
                                            <pre><</pre>
                                        </span>
                                        <span class="month-picker" id="month-picker">Month</span>
                                        <span class="year" id="year">Year</span>
                                        <span class="month-change" id="next-month">
                                            <pre>></pre>
                                        </span>
                                    </div>
                                </div>
                                <hr class="mx-2 my-0">
                                <div class="calendar-body">
                                    <div class="calendar-week-day">
                                        <div>S</div>
                                        <div>M</div>
                                        <div>T</div>
                                        <div>W</div>
                                        <div>TH</div>
                                        <div>F</div>
                                        <div>S</div>
                                    </div>
                                    <div class="calendar-days"></div>
                                </div>
                                <div class="month-list"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>






@endsection


@section('script')
<script>
const element = document.getElementById('date');
element.valueAsNumber = Date.now() - (new Date()).getTimezoneOffset() * 60000;
</script>