@extends('layouts.app')

@section('content')

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Add New Employee') }}</div>

            <div class="card-body">
                <form id="cform">
                    @csrf
                    <!---EMPLOYEE INFORMATION NAME,M,L-->
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">First Name:</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="First name"
                                    aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Middle Name:</label>
                                <input type="text" name="m_name" id="m_name" class="form-control" placeholder="Middle name"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Last Name:</label>
                                <input type="text" name="l_name" id="l_name" class="form-control" placeholder="Last name"
                                    aria-describedby="helpId" required>
                                <small id="helpId" class="text-muted">Employee Last Name</small>
                            </div>
                        </div>
                    </div>
                    <!--EMPLOYEE EMAIL & PHONE # -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Work Email:</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="emplyeename@irs.gov" aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Work Phone#:</label>
                                <input type="text" name="work_number" id="work_number" class="form-control"
                                    placeholder="(###-###-####)" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Employee POD:</label>
                                <input type="text" name="office" id="office" class="form-control" placeholder="POD"
                                    aria-describedby="helpId" required>
                            </div>
                        </div>
                    </div>
                    <!--EMPLOYEE ADDRESS -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Address 1:</label>
                                <input type="text" name="address1" id="address1" class="form-control"
                                    placeholder="123 North circle street" aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Address 2 (optional):</label>
                                <input type="text" name="address2" id="address2" class="form-control" placeholder="Apt# 123"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">City:</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="Los Angeles"
                                    aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">state:</label>
                                <input type="text" name="state" id="state" class="form-control" placeholder="CA"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Zip code:</label>
                                <input type="text" name="zip" id="zip" class="form-control" placeholder="91205"
                                    aria-describedby="helpId">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <a href="" class="btn btn-success" id="ajaxSubmit"
                                onclick="event.preventDefault();CreateNewEmployeeAjax()">Create</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content" id="modal_messages">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" id="ajax_messages">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="mtype">Close</button>
                </div>
            </div>

        </div>
    </div>
    &nbsp;
    @if ($emp_count > 0)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee Data') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">SEID</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($employee_data as $employee)
                                <tr>
                                    <th scope="row">{{ $employee->id }}</th>
                                    <td>{{ $employee->seid }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->l_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif


@endsection

<script>
    function CreateNewEmployeeAjax() {
        $('#ajax_messages ol').remove();
        //Post requests
        var name = $('#name').val();
        var m_name = $('#m_name').val();
        var l_name = $('#l_name').val();
        var email = $('#email').val();
        var work_number = $('#work_number ').val();
        var office = $('#office').val();
        var address1 = $('#address1').val();
        var address2 = $('#address2').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var zip = $('#zip').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            }
        }); //End of AjaxSetup
        $.ajax({
            url: "/seeder/adduser/employeenewseed",
            method: "post",
            data: {
                name: name,
                m_name: m_name,
                l_name: l_name,
                email: email,
                work_number: work_number,
                office: office,
                address1: address1,
                addrss2: address2,
                city: city,
                state: state,
                zip: zip,

            }, //End of data
            success: function(response) {
                //   console.log(response);
                $('#mtype').attr('class', 'btn btn-success');
                $('#ajax_messages').append('<ol><li><h4>' + response
                    .success +
                    '</h4></li></ol>');
                $('#modal').modal('show');
                setTimeout(function() { // wait for 7 mili secs(2)
                    $("#cform")[0].reset();

                    location.reload(); // then reload the page.(3)
                }, 700);



            }, //end of respnse
            error: function(error) {
                $('#mtype').attr('class',
                    'btn btn-danger');
                $('#ajax_messages').append('<ol>');
                for (var prop in error.responseJSON.errors) {
                    var item = error.responseJSON.errors[prop];
                    $('#ajax_messages ol').append('<li><h4>' + item +
                        '</h4></li>');
                    //
                    // console.log(item);
                }
                $('#modal').modal('show')

            }

        }); //End of Ajax Call


    }

</script>
