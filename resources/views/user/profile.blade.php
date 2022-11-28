@extends('layouts.app')
@section('content')

@if ( Session::get('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif
@if ( Session::get('error'))
<div class="alert alert-danger">
    {{ Session::get('error') }}
</div>
@endif

<div class="user__dashboard">
    <div class="row justify-content-center" style="padding-top: 30px; padding-bottom: 30px;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{Auth::user()->first_name}}'s Profile</div>

                <form class="form-horizontal" method="POST" action="{{ route('user.UpdateInfo') }}">
                    @csrf

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane">
                                <div class="form-group row">
                                    <label for="user_employee_id" class="col-sm-2 col-form-label">Employee ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="user_employee_id"
                                            value="{{ Auth::user()->employee_id }}" required disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ Auth::user()->first_name }}"
                                            name="first_name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ Auth::user()->last_name }}"
                                            name="last_name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ Auth::user()->username }}"
                                            name="username" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="position" class="col-sm-2 col-form-label">Position</label>
                                    <div class="col-sm-10">
                                        <select name="position" class="form-select" id="position">
                                            <option value="{{ Auth::user()->position }}">
                                                {{ Auth::user()->position }}</option>
                                            <option value="CEO">CEO</option>
                                            <option value="Operations Manager">Operations Manager</option>
                                            <option value="Designer - Quality Analyst">Designer - Quality Analyst
                                            </option>
                                            <option value="Bookkeeper">Bookkeeper</option>
                                            <option value="Admin Support">Admin Support</option>
                                            <option value="Head Graphic Designer">Head Graphic Designer</option>
                                            <option value="Graphic Designer">Graphic Designer</option>
                                            <option value="Relevate Designer">Relevate Designer</option>
                                            <option value="Project Coordinator">Project Coordinator</option>
                                            <option value="Digital Marketing Associate">Digital Marketing Associate
                                            </option>
                                            <option value="Senior Project Coordinator">Senior Project Coordinator
                                            </option>
                                            <option value="Web Developer">Web Developer</option>
                                            <option value="Production Support Staff">Production Support Staff</option>
                                            <option value="Virtual Assistant">Virtual Assistant</option>
                                            <option value="Channel Associate">Channel Associate</option>
                                            <option value="Organizational Development Manager">Organizational
                                                Development Manager</option>
                                            <option value="Intern">Intern</option>
                                        </select required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" id="myInput" class="form-control"
                                            placeholder="Input your password" name="password" required> <br>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>

@endsection