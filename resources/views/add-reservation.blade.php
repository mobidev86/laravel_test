<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel Test Application</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="//code.jquery.com/jquery-1.12.3.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
        <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <center><h1>Add Reservation</h1></center>
        <div class="container">
        <form id="addReservationForm" method="POST">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label for="no_of_people1">User ID(s)</label>
                <input type="text" class="form-control" id="no_of_people1" name="no_of_people1">
            </div>
            <div class="form-group">
              <label for="datetime">Date</label>
              <input type="text" class="form-control" id="datetime" name="datetime">
            </div> 
            <div class="form-group">
              <label for="datetime1">Time</label>
              <input type="text" class="form-control" id="datetime1" name="datetime1">
            </div> 
            <div class="form-group">
                <label for="timezone">Timezone</label>
                <select class="form-control" id="timezone" name="timezone">
                    <option value="">-Select-</option>
                    <option value="UTC">UTC</option>
                    <option value="Asia/Kolkata">Asia/Kolkata</option>
                    <option value="America/NewYork">America/NewYork</option>
                </select>
            </div>
            <button type="button" id="addReservationBtn" class="btn btn-primary">Submit</button>
            <a href="/reservations" id="cancel" name="cancel" class="btn btn-default">Cancel</a>
        </form>
      </div>
      <script type="text/javascript">
        $(document).ready(function(){
            $("#datetime").datepicker({ minDate: 0});
            $('#datetime1').timepicker({
                timeFormat: 'HH:mm:ss',
                interval: 60,
                minTime: '10',
                maxTime: '23:59',
                defaultTime: '10',
                startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });
        $("#addReservationBtn").click(function(e){
            
            $("#addReservationForm").validate({
                rules: {
                    no_of_people1: 'required',
                    datetime: 'required',
                    datetime1: 'required',
                    timezone: 'required',
                },
           });

            var formValidate = $("#addReservationForm").valid();
            if(formValidate == true){
                var people = $("#no_of_people1").val();
                var date_period = $("#datetime").val();
                var time_period = $("#datetime1").val();    
                var timezone = $("#timezone").val();
                var dataPass =  JSON.stringify({people: people,date_period:date_period,time_period:time_period,timezone:timezone});
                var ajaxurl = "{{route('add_new_reservation')}}";

                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {dataPass},
                    success: function (response) {
                        if(response.data.is_booking_restricted == true){
                            alert("Booking is not allowed");
                            return false
                        }else{
                            alert("Booking is successful");
                            window.location.href = "/reservations";
                        }
                    }
                });
            }
        });
      </script>
    </body>
</html>
