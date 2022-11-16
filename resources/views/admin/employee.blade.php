@extends('layouts.main')

@section('content')
@include('includes.messages')
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
                                    <div class="input-group">
                                        <div>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addnew" style="margin-right: 10px">Add New Employee
                                            </button>
                                        </div>
                                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table-bordered table" id="table-id">
                            <thead>
                                <tr class="table__header">
                                    <th>Employee ID</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Position</th>
                                    <th>Member Since</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="myTable">
                                @foreach ($employees as $employee)
                                <tr class="table__row">
                                    <td>{{ $employee->employee_id }}</td>
                                    <td>{{ $employee->username }}</td>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>{{ $employee->created_at->format('m/d/Y') }}</td>
                                    <td>
                                        <button type="button" data-bs-target="#edit{{ $employee->employee_id }}"
                                            data-bs-toggle="modal" class="btn btn-success">Edit</button>
                                        <button type="button" data-bs-target="#delete{{ $employee->id }}"
                                            data-bs-toggle="modal" class="btn btn-danger">Delete</button>
                                    </td>
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



@foreach ($employees as $employee)
<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('admin.store') }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="employee_id" class="col-sm-2 col-form-label">Employee ID <span
                                style="color: red">*</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="employee_id" placeholder="Employee ID"
                                required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username <span
                                style="color: red">*</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="first_name" class="col-sm-2 col-form-label">First Name <span
                                style="color: red">*</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="last_name" class="col-sm-2 col-form-label">Last Name <span
                                style="color: red">*</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="position" class="col-sm-2 col-form-label">Position <span
                                style="color: red">*</label>

                        <div class="col-sm-10">
                            <select class="form-select" name="position" required>
                                <option value="Data" selected hidden>Display Position Here</option>
                                {{-- Loop Here --}}
                                <option value="" class="hidden" selected disabled>Choose</option>
                                <option>CEO</option>
                                <option>Super Admin - Admin Staff</option>
                                <option>Operations Manager</option>
                                <option>Designer - Quality Analyst</option>
                                <option>Bookkeeper</option>
                                <option>Admin Support</option>
                                <option>Head Graphic Designer</option>
                                <option>Graphic Designer</option>
                                <option>Relevate Designer</option>
                                <option>Project Coordinator</option>
                                <option>Digital Marketing Associate</option>
                                <option>Senior Project Coordinator</option>
                                <option>Web Developer</option>
                                <option>Production Support Staff</option>
                                <option>Virtual Assistant</option>
                                <option>Channel Associate</option>
                                <option>Organizational Development Manager</option>
                                <option>Intern</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Password <span
                                style="color: red">*</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Employee -->
<div class="modal fade" id="edit{{ $employee->employee_id }}" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.update', ['id' => $employee->id]) }}" id="evaluateForm"
                class="text-dark text-left" autocomplete="off" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="employee_id" class="col-sm-2 col-form-label">Employee ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="employee_id"
                                            value="{{ $employee->employee_id }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ $employee->first_name }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ $employee->last_name }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="username"
                                            value="{{ $employee->username }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="password"
                                            value="{{ $employee->password }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="position" class="col-sm-2 col-form-label">Position</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="position" autofocus
                                            style="margin-bottom: 2%;">
                                            <option value="{{ $employee->position }}">
                                                {{ $employee->position }}</option>
                                            <option value="CEO">CEO</option>
                                            <option value="Super Admin - Admin Staff">Super Admin - Admin Staff</option>
                                            <option value="Operations Manager">Operations Manager</option>
                                            <option value="Designer - Quality Analyst">Designer - Quality Analyst</option>
                                            <option value="Bookkeeper">Bookkeeper</option>
                                            <option value="Admin Support">Admin Support</option>
                                            <option value="Head Graphic Designer">Head Graphic Designer</option>
                                            <option value="Graphic Designer">Graphic Designer</option>
                                            <option value="Relevate Designer">Relevate Designer</option>
                                            <option value="Project Coordinator">Project Coordinator</option>
                                            <option value="Digital Marketing Associate">Digital Marketing Associate</option>
                                            <option value="Senior Project Coordinator">Senior Project Coordinator</option>
                                            <option value="Web Developer">Web Developer</option>
                                            <option value="Production Support Staff">Production Support Staff</option>
                                            <option value="Virtual Assistant">Virtual Assistant</option>
                                            <option value="Channel Associate">Channel Associate</option>
                                            <option value="Organizational Development Manager">Organizational Development Manager</option>
                                            <option value="Intern">Intern</option>
                                        </select required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile__overlay__vv">
                    <button type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Employee -->

<div class="modal fade" id="delete{{ $employee->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b><span class="employee_id">Delete Employee</span></b></h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p>Are you sure?</p>
                    <h2 class="bold del_employee_name"></h2>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('admin.destroy', $employee->id) }}" class="btn btn-danger btn-flat"><i
                        class="fa fa-trash"></i> Delete</a>

            </div>
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