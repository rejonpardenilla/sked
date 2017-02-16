<!doctype html>
<html lang='en'>
<head>

    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='{{asset('css/main.css')}}'>
    <link rel='stylesheet' href='{{asset('css/elements/circle-button.css')}}'>

    <!--    jQuery-->
    <script src='http://code.jquery.com/jquery-1.12.4.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>


    <title>Sked</title>


    <meta http-equiv="Expires" content="0">

    <meta http-equiv="Last-Modified" content="0">

    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">

    <meta http-equiv="Pragma" content="no-cache">

    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<div class="col-xs-12">

    <h1 class="logo-text">Sked</h1>

</div>

<div id="main-container" class="container">

    <form>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">
                <p class="description-text" style="text-align: left"> {{$event->name}} by {{$event->username}}</p>
            </div>
            <div class="col-sm-4 col-sm-offset-2">
                <p class="description-text" style="text-align: left"> {{$guest->name}}</p>
            </div>
        </div>


        <div class="row divider">

            <div class="col-sm-2">
                <p class="divider-text text">Dates...</p>
            </div>
            <div class="col-sm-9">
                <hr class="line-divider">
            </div>

        </div>

        <div class="row">

            <input id="eventId" type="hidden" value="{{$event->id}}"/>
            <input id="guestId" type="hidden" value="{{$guest->id}}"/>

            <div class="col-sm-6 col-sm-offset-3">
                <table id="datesTable" class="table">
                    <thead>
                    <tr>
                        <th class="hidden">Id</th>
                        <th class="table-head">Date</th>
                        <th class="table-head">Time</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dates as $date)
                        <tr>
                            <td class="hidden id-field">{{$date->id}}</td>
                            <td class="table-data">{{ Carbon\Carbon::parse($date->date)->format('F jS') }}</td>
                            <td class="table-data">{{$date->time}}</td>
                            <td class="table-data">
                                <button type="button" class="move up">
                                    <span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="move down">
                                    <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="remove">
                                    <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>


        <div class="row">
            <div class="col-xs-12" style="padding-top: 20px">

                <div id="button-sked" class="button-circle-small">
                    <p class="button-text">Sked it</p>
                </div>

            </div>
        </div>

    </form>

</div>

<script src="{{asset('js/guest.js')}}"></script>

</html>