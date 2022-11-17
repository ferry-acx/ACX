@extends('layouts.main')

@section('content')


<div class="user__dashboard container-py">
    <div class="user__dashboard__grid">

        <div class="user__dashboard__item">
            <div class="user__dashboard__table">
                <div class="user__dashboard__date">
                    <h5 style="color: black; padding-top: 8px; padding-right: 50px;"><span id="time"></span></h5>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="row card-body">
                            <div class="col-3">
                                <label class="form-label">Employee Name</label>
                                <select class="form-select" id="name_of_employee">
                                    <option class="hidden" selected disabled>Choose</option>
                                    @foreach (array_combine($employees, $ids) as $employee => $id)
                                    <option value="{{$id}}">{{$employee}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4" style="margin-right:-15%;">
                                <label class="form-label">Start Date</label>
                                <input name="startDate" id="since" type="date" class="form-control mb-3 w-50"
                                    autofocus />
                            </div>
                            <div class="col-md-4" style="margin-right:-15%;">
                                <label class="form-label">End Date</label>
                                <input name="endDate" id="until" type="date" class="form-control mb-3 w-50" autofocus />
                            </div>
                            
                            <div class="col-md-4" style="margin-right:-90px;">
                            <label class="form-label">Total Hours Rendered</label>
                                <div class="input-group">
                                    <button class="btn btn-warning" id="gethrs-btn">Execute</button>
                                    <input name="totalHrs" id="totalHrs" class="form-control" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="table__grid">
                                <div class="table__item">
                                    <div class="table__search">
                                        <div class="input-group">
                                            <input class="form-control" style="margin-right:10px" id="myInput"
                                                type="text" placeholder="Search..">
                                            <div>
                                                <a class="btn btn-success"
                                                    href="{{ route('admin.generatePDF') }}">Export
                                                    PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <table class="table-bordered table" id="table-id">
                                <thead>
                                    <tr class="table__header">
                                        <th class="col-employee_id">Employee ID</th>
                                        <th class="col-attendance_date">Date</th>
                                        <th class="col-name">Name</th>
                                        <th class="col-time_in">Time In</th>
                                        <th class="col-time_out">Time Out</th>
                                        <th class="col-total_time">Total Hours</th>
                                        <th class="col-task">Tasks Done For the Day</th>
                                        <th class="col-supervisor_ass">Supervisor Assessment</th>
                                    </tr>
                                </thead>

                                <tbody id="myTable">
                                    @foreach( $attendances as $attendance)
                                    <tr class="table__row">
                                        <td class="col-employee_id">{{$attendance->user->employee_id}}</td>
                                        <td class="col-attendance_date">{{$attendance->attendance_date}}</td>
                                        <td class="col-name">{{$attendance->user->first_name}}
                                            {{$attendance->user->last_name}}</td>
                                        <td class="col-time_in">{{$attendance->time_in}} </td>
                                        <td class="col-time_out">{{$attendance->time_out}} </td>
                                        <td class="col-total_time">{{$attendance->total_time }} </td>
                                        <td class="col-task">{{$attendance->task}} </td>
                                        <td class="col-supervisor_ass">{{$attendance->supervisor_ass}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="form-group float-right"><br><br>
                                <div class="table__data">Rows per page:</div>
                                <select class="form-control" name="rows" id="maxRows" style="width:90px">
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

                            <div class="pagination-container">
                                <nav>
                                    <ul class="pagination-pag">
                                        <li data-page="prev">
                                            <span class="page-link"> Prev <span class="sr-only"></span></span>
                                        </li>

                                        <li data-page="next" id="prev">
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
    </div>

    <script type="text/javascript">
    var timeElement = document.getElementById('time');

    function time() {
        timeElement.textContent = new Date().toLocaleString();
    }

    setInterval(time, 1000);
    </script>

    <script type="text/javascript">
    $(function() {
        $("#gethrs-btn").click(function() {
            var start_date = $("#since").val();
            var end_date = $("#until").val();
            var id = $("#name_of_employee").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('reports/recordsfilter') }}",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    user_id: id
                },
                success: function(data) {
                    const res = JSON.parse(data);
                    if (res.length == 0) {
                        $("#totalHrs").val('0');
                    } else {
                        $("#totalHrs").val(res[0].timeSum)
                    }
                }
            });
        })
    });
    </script>

    <script src="{{asset('js/search.js')}}"></script>
    @endsection