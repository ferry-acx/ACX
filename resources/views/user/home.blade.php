@extends('layouts.app')

@section('content')
    @include('includes.messages')

<!-- <style>
    input[type="number"] {
    appearance: textfield;
    -webkit-appearance: textfield;
    -moz-appearance: textfield;
    }
</style> -->

    <div class="user__dashboard container-py">
        <div class="row">
            <div class="col">
                    <div id="task-overlay">

                        <form action="{{ route('user.logout', ['id' => Auth::user()->id]) }}" class="text-dark text-left" autocomplete="off" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="task__overlay">
                                <div class="task__overlay__item">
                                    <div class="card" onclick="task_on()">
                                        <div class="card-header">
                                            <div class="task__overlay__item">
                                                <div class="task__overlay__header">{{ __('Task Report') }}</div>
                                                <button  onclick="window.location.reload();" class="task__overlay__button">x</button>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="card-group">
                                                <label for="position" class="col-6">Position<span class="text-red">*</label>
                                                <input data-role="tagsinput" type="text" class="col" id="position" name="position" value="{{ Auth::user()->position }}" disabled>

                                            </div>

                                            <!-- <div class="card-body">
                                                <div class="card-group"> -->
                                                    <!-- <div class="customer_records">
                                                        <a class="extra-fields-customer" href="#">+</a>
                                                        <input name="customer_name" type="text" placeholder="Project">
                                                    </div>

                                                    <div class="customer_records_dynamic"></div> -->
                                                <!-- </div>
                                            </div> -->

                                            <div class="card-group">
                                                <label for="location" class="col-6">Location <span class="text-red">*</label>
                                                <select name="location" id="location" class="col" required>
                                                    <option value="" class="hidden">Choose</option>
                                                    <option value="Work from Home (WFH)">Work from Home (WFH)</option>
                                                    <option value="On-site">On-site</option>
                                                </select>
                                            </div>

                                            <div class="card-group">
                                                <label for="project" class="col-6">Project<span class="text-red">*</label>
                                            </div>

                                            <div class="card-group">
                                                <textarea type="text" class="col" id="project" name="project" placeholder="Project 1, Project 2,..." value="{{ Auth::user()->project }}"  required></textarea>
                                            </div>

                                            <div class="card-group">
                                                <label for="task" class="col-6">Tasks Done for the Day<span class="text-red">*</label>
                                            </div>

                                            <div class="card-group">
                                                <textarea class="col" name="task" placeholder="Enter all completed task done today" required></textarea>
                                            </div>
                                        </div>

                                        <div class="task__overlay__cta">
                                            <button type="submit">{{ __('Logout') }}</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                <div class="user__dashboard__grid">
                    <div class="user__dashboard__item">
                        <div class="user__dashboard__description">
                            <div class="user__dashboard__title">Hello, <span>{{ Auth::user()->username }}!</span></div>
                            <div class="user__dashboard__subtitle">You are logged in!</div>
                            <div class="user__dashboard__info">You have successfully marked your attendance!</div>

                            <div class="user__dashboard__timer">
                                <div class="card">
                                    <div class="card-header">{{ __('Time Tracker') }}</div>
                                    <div class="card-body">
                                        <div class="user__dashboard__content">
                                            <div class="user__dashboard__title m-b-md">
                                                <div class="user__dashboard__clockStyle" id="clock">Loading...</div>
                                            </div>
                                        </div>
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <div class="user__dashboard__cta">
                                            <button onclick="task_on()">Log Out</button>
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
        setInterval(displayclock, 500);

        function displayclock() {
            var time = new Date();
            var hrs = time.getHours();
            var min = time.getMinutes();
            var sec = time.getSeconds();
            var en = 'AM';
            if (hrs > 12) {
                en = 'PM';
            }
            if (hrs > 12) {
                hrs = hrs - 12;
            }
            if (hrs == 0) {
                hrs = 12;
            }
            if (hrs < 10) {
                hrs = '0' + hrs;
            }
            if (min < 10) {
                min = '0' + min;
            }
            if (sec < 10) {
                sec = '0' + sec;
            }
            document.getElementById("clock").innerHTML = hrs + ':' + min + ':' + sec + ' ' + en;
        }

        const element = document.getElementById('date');
        element.valueAsNumber = Date.now() - (new Date()).getTimezoneOffset() * 60000;
    </script>

    <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <script>  
        $('.extra-fields-customer').click(function() {
            $('.customer_records').clone().appendTo('.customer_records_dynamic');
            $('.customer_records_dynamic .customer_records').addClass('single remove');
            $('.single .extra-fields-customer').remove();
            $('.single').append('<a href="#" class="remove-field btn-remove-customer">-</a>');
            $('.customer_records_dynamic > .single').attr("class", "remove");
            
            $('.customer_records_dynamic input').each(function() {
            var count = 0;
            var fieldname = $(this).attr("name");
            $(this).attr('name', fieldname + count );
            count++;
            });
        
        });
        
        $(document).on('click', '.remove-field', function(e) {
            $(this).parent('.remove').remove();
            e.preventDefault();
        });
    </script> -->
    
@endsection
