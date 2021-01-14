@extends('layouts.app')

@section('content')
    <div class="container large-container">
        <div class="card">
            <div class="card-header">{{ __('Employee Infoamtion') }}</div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">SEID</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee_info as $employee)
                                <tr>
                                    <th scope="row">{{ $employee->id }}</th>
                                    <td><a href="/employees/edit/{{ $employee->id }}"> {{ strtoupper($employee->seid) }}</a>
                                    </td>
                                    <td><a href="/employees/edit/{{ $employee->id }}"> {{ $employee->name }}</a></td>
                                    <td><a href="/employees/edit/{{ $employee->id }}"> {{ $employee->l_name }}</a></td>
                                    <td><a href="/employees/edit/{{ $employee->id }}">{{ $employee->email }}</a></td>
                                    <td><a href="" onclick="event.preventDefault();ActivateEmployeeAjax({{ $employee->id }})"> {!! $employee->active == 0 ?
                                            '<span class="badge bg-danger" style="color:#fff;">inactive</span>' : '<span
                                                class="badge bg-success" style="color:#fff;">active</span>' !!}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        ///employees/activate/{{ $employee->id }}
        function ActivateEmployeeAjax(id) {
            $('#ajax_messages ol').remove();
            //Post requests

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                }
            }); //End of AjaxSetup
            $.ajax({
                url: "/employee/activate",
                method: "post",
                data: {
                    id: id,

                }, //End of data
                success: function(response) {
                       console.log(response);
                  //  $('#mtype').attr('class', 'btn btn-success');
                   // $('#ajax_messages').append('<ol><li><h4>' + response
                    //    .success +
                     //   '</h4></li></ol>');
                   //$('#modal').modal('show');
                     setTimeout(function() { // wait for 7 mili secs(2)
                    // $("#cform")[0].reset();

                      location.reload(); // then reload the page.(3)
                       }, 300);



                }, //end of respnse
                error: function(error) {
                    console.log(error);
                  //  $('#mtype').attr('class',
                  //      'btn btn-danger');
                  //  $('#ajax_messages').append('<ol>');
                    //for (var prop in error.responseJSON.errors) {
                  //  var item = error.responseJSON.error;
                  //  $('#ajax_messages ol').append('<li><h4>' + item +
                   //     '</h4></li>');
                    //
                    // console.log(item);
                    //}
                 //   $('#modal').modal('show')

                }

            }); //End of Ajax Call


        }

    </script>
@endsection
