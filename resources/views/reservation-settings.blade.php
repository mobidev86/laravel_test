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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <center><h1>Reservation Rules Listing</h1>
        @if(Session::has('success_message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success_message') }}</p>
        @endif
        <h4><a href="{{url('add_rule')}}" style="float: right;margin-right: 80px;">Add New Rule</a></h4><br/><br/>
             <table class="table" style="width: 85%;margin-left:50px;border: 1px solid;">
                  <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">No. Of Users / Group</th>
                          <th scope="col">D/W/M</th>
                          <th scope="col">G/I</th>
                          <th scope="col">Timezone</th>
                          <th scope="col">Action</th>
                        </tr>
                  </thead>
                  <tbody>
                     @if(count($rules) > 0)
                         @foreach($rules as $rule)
                                 <tr>
                                    <td>{{ $rule->id }}</td>
                                    <td>{{ $rule->n }}</td>
                                    <td>{{ $rule->d }}</td>
                                    <td>{{ $rule->g }}</td>
                                    <td>{{ $rule->tz }}</td>
                                    <td>                            
                                        <a href="{{ route('edit_rule', ['id' => $rule->id]) }}" class="mr-3">
                                           {{ method_field('EDIT') }}
                                             <i class="fa fa-edit fa-font-24" style="color: red;"></i>
                                         </a>
                                        <a href="#" class="mr-3" id="delete" onclick="myFunction({{ $rule->id }})">
                                           {{ method_field('DELETE') }}
                                             <i class="fa fa-trash-o fa-font-24" style="color: red;"></i>
                                         </a>
                                    </td>
                                 </tr>
                         @endforeach
                         @else
                            <tr>
                                <td>No Rules found</td>
                            </tr>
                        @endif
                  </tbody>
            </table>
    </body>
</html>