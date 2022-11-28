@extends('layouts.main')
@section('content')


<div class="user__dashboard container-py">
    <div class="user__dashboard__grid">
        <div class="user__dashboard__table">
            <!-- Content Row -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="col-xl-8 col-lg-7">
                    <div class="user__dashboard__date">
                        <h5 style="color: black; padding-top: 8px; padding-right: 50px;"><span id="time"></span>
                        </h5>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <div class="table__grid">
                                    <h5 style="color: black; padding-top: 8px; padding-right: 50px;">All
                                        Employee
                                        Total
                                        Hours</h5>
                                    <input class=" form-control mb-3 w-20" style="margin-right:10px" id="myInput"
                                        type="text" placeholder="Search.." width="10%">
                                    <div class="table__item">
                                        <div class="table__search">
                                            <form method="post" action="{{ route('admin.displayReportsByDate') }}">
                                                @csrf
                                                <div class="input-group">
                                                    <label class="form-label"
                                                        style="padding-top:5px; padding-left:10px; padding-right:10px">Start
                                                        Date</label>
                                                    <div>
                                                        <input name="startDate" id="since-start" type="date"
                                                            class="form-control mb-3 w-53" value="{{ $dates[0] }}"
                                                            autofocus />
                                                    </div>
                                                    <label
                                                        style="padding-top:5px; padding-left:10px; padding-right:10px"
                                                        class="form-label">End Date</label>
                                                    <div style="padding-right:10px;">
                                                        <input name="endDate" id="until-end" type="date"
                                                            class="form-control mb-3 w-53" value="{{ $dates[1] }}"
                                                            autofocus />
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-warning"
                                                            id="">Execute</button>
                                                    </div>

                                                </div>
                                            </form>
                                            <div>
                                                <!--TEST-->
                                                <div>
                                                    <form method="get" action="{{ route('admin.generatePDF') }}">
                                                        @csrf
                                                        <div class="input-group">
                                                            <select class="form-control" name="option" id="option">
                                                                <option value="week">Week</option>
                                                                <option value="month">Month</option>
                                                                <option value="year">Year</option>
                                                            </select>
                                                            <button class="btn btn-outline-primary"
                                                                type="submit">EXPORT</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!--END TEST-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table class="table" id="table-id">
                                        <thead>
                                            <tr class="table__header">
                                                <th class="col-employee_id">Employee ID</th>
                                                <th class="col-name">Name</th>
                                                <th class="col-total_time"> Total Hours (hour-min-sec)</th>
                                            </tr>
                                        </thead>

                                        <tbody id="myTable">
                                            @foreach( $attendances as $attendance)
                                            <tr class="table__row">
                                                <td class="col-employee_id">{{$attendance->user->employee_id}}
                                                </td>
                                                <td class="col-name">{{$attendance->user->first_name}}
                                                    {{$attendance->user->last_name}}</td>
                                                <td class="col-total_time">{{$attendance->timeSum }} </td>
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


                <div class="col-xl-4 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <div class="table__grid">
                                    <h5 style="color: black;">Individual
                                        Employee
                                        Total Hours
                                    </h5>
                                    <div class="row card-body">
                                        <div class="row mb-3">
                                            <label class="form-label">Employee Name</label>
                                            <select class="form-select" id="name_of_employee">
                                                <option value="" class="hidden" selected disabled>Choose
                                                </option>
                                                @foreach (array_combine($employees, $ids) as $employee => $id)
                                                <option value="{{$id}}">{{$employee}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="form-label">Start Date</label>
                                            <input name="startDate" id="since" type="date"
                                                class="form-control mb-3 w-50" autofocus />
                                        </div>
                                        <div class="row mb-3">
                                            <label class="form-label">End Date</label>
                                            <input name="endDate" id="until" type="date" class="form-control mb-3 w-50"
                                                autofocus />
                                        </div>

                                            <div class="row mb-3">
                                                <label class="form-label">Total Hours Rendered</label>
                                                <div class="input-group">
                                                    <button class="btn btn-warning" id="gethrs-btn">Check</button>
                                                    <input name="totalHrs" id="totalHrs" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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


<script src="{{asset('js/search.js')}}"></script>


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
@endsection