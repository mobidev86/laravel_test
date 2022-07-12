<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Test Application</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="//code.jquery.com/jquery-1.12.3.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
        <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <center><h1>Edit Reservation Rules</h1></center>
        <div class="container">
        <form id="addReservationRule" action="{{ route('edit_reservation_rule') }}" method="POST">
          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
          <input name="rule_id" type="hidden" value="{{ $rule_data->id}}"/>
          <div class="form-group">
            <label for="name">No. Of People</label>
            <input type="text" class="form-control" id="no_of_people" name="no_of_people" placeholder="How many person?" value="{{ $rule_data->n}}">
          </div>
          <div class="form-group">
              <label for="type">Time Period</label>
              <select class="form-control" id="time_period" name="time_period">
                <option value="">-Select-</option>
                <option value="day" {{ ( $rule_data->d == "day" ) ? 'selected' : '' }}>Day</option>
                <option value="week" {{ ( $rule_data->d == "week" ) ? 'selected' : '' }}>Week</option>
                <option value="month" {{ ( $rule_data->d == "month" ) ? 'selected' : '' }}>Month</option>
              </select>
            </div>
          <div class="form-group">
            <label for="reservation_type">Reservation Type</label>
            <select class="form-control" id="reservation_type" name="reservation_type">
                <option value="">-Select-</option>
                <option value="individual" {{ ( $rule_data->g == "individual" ) ? 'selected' : '' }}>Individual</option>
                <option value="group" {{ ( $rule_data->g == "group" ) ? 'selected' : '' }}>Group</option>
            </select>
          </div>
          <div class="form-group">
            <label for="timezone">Timezone</label>
            <select class="form-control" id="timezone" name="timezone">
                <option value="">-Select-</option>
                <option value="UTC" {{ ( $rule_data->tz == "UTC" ) ? 'selected' : '' }}>UTC</option>
                <option value="Asia/Kolkata" {{ ( $rule_data->tz == "Asia/Kolkata" ) ? 'selected' : '' }}>Asia/Kolkata</option>
                <option value="America/NewYork" {{ ( $rule_data->tz == "America/NewYork" ) ? 'selected' : '' }}>America/NewYork</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="/reservation-settings" id="cancel" name="cancel" class="btn btn-default">Cancel</a>
        </form>
      </div>
    </body>
</html>