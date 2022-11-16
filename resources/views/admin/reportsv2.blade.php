@extends('layouts.main')

@section('content')
<div class="user__dashboard">
    <div class="row justify-content-center" style="padding-top: 30px; padding-bottom: 30px;">
        <div class="col-md-8">
            <div class="card">
                <label class="col-sm-2 col-form-label">Employee Name</label>
                <div class="col-sm-4">
                    <select class="form-select" id="name_of_employee">
                        <option class="hidden" selected disabled>Choose</option>
                        @foreach (array_combine($employees, $ids) as $employee => $id)
                        <option value="{{$id}}">{{$employee}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-space"></div>
                <hr>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Start Date</label>
                                <div class="col-sm-9">
                                    <input name="startDate" id="since" type="date" class="form-control" autofocus
                                        style="margin-bottom: 2%;" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">End Date</label>
                                <div class="col-sm-9">
                                    <input name="endDate" id="until" type="date" class="form-control" autofocus
                                        style="margin-bottom: 2%;" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Days in Month</label>
                                <div class="col-sm-9">
                                    <button class="btn btn-warning" type="" id="gethrs-btn">Execute</button>
                                    <p id="result"></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Total Hours Rendered</label>
                                <div class="col-sm-9">
                                    <input name="totalHrs" id="totalHrs" class="form-control mb-3" placeholder=""
                                        aria-label="default input example" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="user__dashboard__grid">
            <div class="user__dashboard__item">
                <div class="user__dashboard__table">

                    <div class="card">
                        <div class="card-header">
                            <div class="table__grid">
                                <div class="table__item">
                                    <div class="table__search">
                                        <div class="input-group">
                                            <div>
                                                <a class="btn btn-danger"
                                                    href="{{ route('admin.generatePDF2') }}">Export PDF</a>
                                            </div>
                                            <div style="margin-left: 10px">
                                                <h4> // Date Range Here | January 01, 2022- January 15, 2022</h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <table class="table-bordered table" id="table-id">
                                <thead>
                                    <tr class="table__header">
                                        <th class="col-employee_id">Employee ID</th>
                                        <th class="col-attendance_date">Name</th>
                                        <th class="col-total_time">Total Hours</th>
                                    </tr>
                                </thead>
                                @foreach( $attendances as $attendance)
                                <tr class="table__row">
                                    <td>{{$attendance->user->employee_id}}</td>
                                    <td>{{$attendance->user->first_name}} {{$attendance->user->last_name}}</td>
                                    <td>{{$attendance->total_time}} </td>
                                </tr>
                                @endforeach
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

</div>

<script type="text/javascript">
    $(function() {
    $("#gethrs-btn").click(function () {
        var start_date = $("#since").val();
        var end_date = $("#until").val();
        var id = $("#name_of_employee").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('reportsv2/recordsfilter') }}",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    user_id: id
                },
                success: function(data) {
                    const res = JSON.parse(data);
                    if (res.length==0){
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
