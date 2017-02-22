    <!doctype html>
<html lang='en'>
<head>

    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='{{asset('css/main.css')}}'>

    <!--    jQuery-->
    <script src='http://code.jquery.com/jquery-1.12.4.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!--    Date Picker -->
    <link href="{{asset('calendar/css/jquery.datepick.css')}}" rel="stylesheet">
    <link href="{{asset('calendar/css/redmond.datepick.css')}}" rel="stylesheet">
    <script src="{{asset('calendar/js/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('calendar/js/jquery.datepick.js')}}"></script>

    <!-- Time picky -->
    <link href="{{asset('time-picky/css/timepicki.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('time-picky/js/timepicki.js')}}"></script>


    <title>Sked</title>


    <meta http-equiv="Expires" content="0">

    <meta http-equiv="Last-Modified" content="0">

    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">

    <meta http-equiv="Pragma" content="no-cache">


</head>

<body>

<div class="row">
    <div class="col-xs-12">

        <h1 class="logo-text">Sked</h1>

    </div>
</div>

<div class="row">
    @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif


</div>

<div id="main-container" class="container">

    <div class="col-xs-12" style="height:100px;"></div>

    {!!Form::open(array('url' => '/order    ', 'method' => 'POST')) !!}
    {{Form::token()}}

    <div class="form-group row">
        <label for="inputEmail3" class="text-label-form col-sm-3 col-form-label">Name of the event</label>
        <div class="col-sm-7">
            <input required name="eventName" type="text" class="form-control input" id="eventName">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputEmail3" class="text-label-form col-sm-3 col-form-label">Your Name</label>
        <div class="col-sm-7">
            <input required name="userName" type="text" class="form-control input" id="userName">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputEmail3" class="text-label-form col-sm-3 col-form-label">Your e-mail</label>
        <div class="col-sm-7">
            <input required name="email" type="email" class="form-control input" id="email">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputEmail3" class="text-label-form col-sm-3 col-form-label">Deadline</label>
        <div class="col-sm-7">
            <input required name="deadline" type="text" class="form-control input" id="deadline">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-7 text"> *Number of days guests have to Sked it</div>
    </div>

    <div class="row divider">

        <div class="col-sm-2">
            <p class="divider-text text">Guests...</p>
        </div>
        <div class="col-sm-9">
            <hr class="line-divider">
        </div>

    </div>

    <div class="row">

        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <button type="button" id="btn-new-guests" class="btn text">+ Add guests</button>
        </div>

    </div>


    <div id="guests-input"></div>


    <div class="row divider">

        <div class="col-sm-2">
            <p class="divider-text text">Dates...</p>
        </div>
        <div class="col-sm-9">
            <hr class="line-divider">
        </div>

    </div>

    <div class="row">

        <div class="col-sm-4 col-sm-offset-4">

            <div id="date-picker" style="height: 200px"></div>
        </div>

    </div>

    <div class="row">

        <div id="dates-input">

        </div>

    </div>


    <div class="row">

        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <button type="submit" id="btn-done" class="btn text btn">Done</button>
        </div>

    </div>

    <div class="col-sm-12" style="height: 200px"></div>


    {!!Form::close()!!}

</div>

</body>
<script src='{{asset('js/admin-a1.js')}}'></script>
<script src="{{asset('js/admin-calendar.js')}}"></script>
<script src="{{asset('js/admin-send-request.js')}}"></script>

</html>



