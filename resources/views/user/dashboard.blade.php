@extends('layouts.app')

@section('content')

<div class="user__dashboard container-py">
    <div class="user__dashboard__grid">
        <div class="user__dashboard__item">
            <div class="user__dashboard__table">
                <div class="user__dashboard__date">
                    <h5 style="color: black; padding-top: 8px; padding-right: 50px;"><span id="time"></span></h5>
                </div>

                @include('includes.messages')

                <div class="card">
                    <div class="card-header">
                        <div class="table__grid">
                            <div class="table__item">
                                <div class="table__search">
                                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                </div>
                            </div><br>
                        </div>


                        <div class="table-responsive">
                            <table class="table" id="table-id">
                                <thead>
                                    <tr class="table__header">
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Time in</th>
                                        <th>Time out</th>
                                        <th>Task done for the day</th>
                                        <th>Project</th>
                                        <th>Position</th>
                                        <th>Location</th>
                                        <th>Supervisor Assessment</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody id="myTable">
                                    @foreach ($attendances as $attendance)
                                    <tr class="table__row">
                                        <td>{{ $attendance->attendance_date }}</td>
                                        <td>{{ $attendance->user->first_name }} {{ $attendance->user->last_name }}</td>
                                        <td>{{ $attendance->time_in }} </td>
                                        <td>{{ $attendance->time_out }} </td>
                                        <td>{{ $attendance->task }} </td>
                                        <td>{{ $attendance->project }} </td>
                                        <td>{{ $attendance->user->position }} </td>
                                        <td>{{ $attendance->location }} </td>
                                        <td>{{ $attendance->supervisor_ass }} </td>
                                        <td>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $attendance->id }}">Edit</button>
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
</div>


<!-- Edit-->
@foreach( $attendances as $attendance)
<div class="modal fade" id="edit{{ $attendance->id }}" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Edit Project and Tasks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('user.editAttendance', ['id' => $attendance->id]) }}" class="text-dark text-left"
                autocomplete="off" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="card-group">
                                        <label for="project" class="col-6">Project<span class="text-red">*</label>
                                    </div>

                                    <div class="card-group">
                                        <textarea type="text" class="col" id="project" name="project"
                                            value="{{ $attendance->project }}" required></textarea>
                                    </div>

                                    <div class="card-group">
                                        <label for="task" class="col-6">Tasks Done for the Day<span
                                                class="text-red">*</label>
                                    </div>

                                    <div class="card-group">
                                        <textarea class="col" name="task" id="task" value="{{ $attendance->task }}"
                                            required></textarea>
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