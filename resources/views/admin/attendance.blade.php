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
                        <div class="table__grid">
                            <div class="table__item">
                                <div class="table__search">
                                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" id="table-id">
                            <thead>
                                <tr class="table__header">
                                    <th>Date</th>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Tasks Done For the Day</th>
                                    <th>Project</th>
                                    <th>Location</th>
                                    <th>Supervisor Assessment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="myTable">
                                @foreach( $attendances as $attendance)
                                <tr class="table__row">
                                    <td>{{$attendance->attendance_date}}</td>
                                    <td>{{$attendance->user->employee_id}}</td>
                                    <td>{{$attendance->user->first_name}} {{$attendance->user->last_name}}</td>
                                    <td>{{$attendance->time_in}} </td>
                                    <td>{{$attendance->time_out}} </td>
                                    <td>{{$attendance->task}} </td>
                                    <td>{{$attendance->project}} </td>
                                    <td>{{$attendance->location}} </td>
                                    <td>{{$attendance->supervisor_ass}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#evaluate{{ $attendance->id }}">Evaluate</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group float-right" style="margin-right:20px"><br><br>
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



<!-- Evaluate-->
@foreach( $attendances as $attendance)
<div class="modal fade" id="evaluate{{ $attendance->id }}" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Employee Evaluation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="form-horizontal" method="POST"
                action="{{ route('admin.assessment', ['id' => $attendance->id]) }}">
                @csrf
                @method('PUT')
                <div>
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="supervisor_ass" class="col-sm-2 col-form-label">Assessment</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" name="supervisor_ass"
                                            id="supervisor_ass" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile__overlay__vv">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach




<script type="text/javascript">
var timeElement = document.getElementById('time');

function time() {
    timeElement.textContent = new Date().toLocaleString();
}

setInterval(time, 1000);
</script>

<script src="{{asset('js/search.js')}}"></script>

@endsection