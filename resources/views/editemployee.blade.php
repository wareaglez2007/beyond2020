@extends('layouts.app')

@section('content')
    <div class="container large-container">

        <div class="card">
            <div class="card-header">Edit {{ $employee_info->name }} {{ $employee_info->l_name }}</div>

            <div class="card-body">
                <form id="cform">
                    <input type="hidden" name="id" id="id" value="{{ $employee_info->id }}">
                    @csrf
                    <!---EMPLOYEE INFORMATION NAME,M,L-->
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">First Name:</label>
                                <input type="text" name="name" id="name" value="{{ $employee_info->name }}"
                                    class="form-control disabled" placeholder="First name" aria-describedby="helpId"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Middle Name:</label>
                                <input type="text" name="m_name" id="m_name" value="{{ $employee_info->m_name }}"
                                    class="form-control disabled" placeholder="Middle name" aria-describedby="helpId"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Last Name:</label>
                                <input type="text" name="l_name" id="l_name" value="{{ $employee_info->l_name }}"
                                    class="form-control disabled" placeholder="Last name" aria-describedby="helpId"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <!--EMPLOYEE EMAIL & PHONE # -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Work Email:</label>
                                <input type="email" name="email" id="email" value="{{ $employee_info->email }}"
                                    class="form-control" placeholder="emplyeename@irs.gov" aria-describedby="helpId"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Work Phone#:</label>
                                <input type="text" name="work_number" id="work_number"
                                    value="{{ $employee_info->work_number }}" class="form-control disabled"
                                    placeholder="(###-###-####)" aria-describedby="helpId" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Employee POD:</label>
                                <input type="text" name="office" id="office" value="{{ $employee_info->office }}"
                                    class="form-control disabled" placeholder="POD" aria-describedby="helpId" disabled>
                            </div>
                        </div>
                    </div>
                    <!--EMPLOYEE ADDRESS -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Address 1:</label>
                                <input type="text" name="address1" id="address1" value="{{ $employee_info->address1 }}"
                                    class="form-control disabled" placeholder="123 North circle street"
                                    aria-describedby="helpId" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Address 2 (optional):</label>
                                <input type="text" name="address2" id="address2" value="{{ $employee_info->address2 }}"
                                    class="form-control disabled" placeholder="Apt# 123" aria-describedby="helpId" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">City:</label>
                                <input type="text" name="city" id="city" value="{{ $employee_info->city }}"
                                    class="form-control disabled" placeholder="Los Angeles" aria-describedby="helpId"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">state:</label>
                                <input type="text" name="state" id="state" value="{{ $employee_info->state }}"
                                    class="form-control disabled" placeholder="CA" aria-describedby="helpId" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Zip code:</label>
                                <input type="text" name="zip" id="zip" value="{{ $employee_info->zip }}"
                                    class="form-control disabled" placeholder="91205" aria-describedby="helpId" disabled>
                            </div>
                        </div>
                    </div>
                    <!--GROUP ASSIGNMENT-->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Group:</label><br />
                                <select class="form-control btn-group btn-group-sm" name="groups" id="groups">
                                    <option value="0">--Select--</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}" @foreach ($assigned_group as $a_group)
                                            @if ($a_group->pivot->groups_id == $group->id)
                                                {{ $selected = 'selected' }}
                                            @endif
                                    @endforeach>{{ $group->id }} - {{ $group->group }}
                                    </option>
                                    @endforeach

                                </select>
                                <br />
                                <small id="helpId" class="alert-success">Select the groups that this employee will
                                    belong
                                    to.</small>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <!--Role ASSIGNMENT-->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Roles:</label><br />
                                <select multiple="multiple" class="form-control" name="roles[]" id="roles"
                                    style="height: 250px">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @foreach ($assigned_roles as $a_roles)
                                            @if ($a_roles->pivot->role_id == $role->id)
                                                {{ $selected = 'selected' }}
                                            @endif
                                    @endforeach >{{ $role->id }}
                                    - {{ $role->roles }}
                                    </option>
                                    @endforeach

                                </select>
                                <br />
                                <small id="helpId" class="alert-success">Select the roles that this employee will belong
                                    assigned to.</small>
                            </div>
                        </div>
                    </div>
                    <!--DEVICE TO ASSIGN-->

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Device</label><br />
                                <select class="form-control btn-group btn-group-sm" name="device" id="device">
                                    <option value="0">--None--</option>
                                    @foreach ($devices as $device)
                                        <option value="{{ $device->id }}" @if (count($assigned_device) != 0)
                                            @foreach ($assigned_device as $a_device)

                                                @if ($a_device->pivot->devices_id == $device->id)
                                                    {{ $selected = 'selected' }}
                                                @endif

                                            @endforeach
                                    @endif
                                    >{{ $device->make }} - {{ $device->model }}
                                    Serial#
                                    {{ $device->serial_number }}
                                    </option>
                                    @endforeach
                                </select>
                                <br />
                                <small id="helpId" class="alert-success">Select A Device to be assigned to this
                                    employee</small>
                            </div>
                        </div>
                    </div>
                    <!--Applications-->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Applications</label><br />
                                <table class="table table-hover" id='some_ajax'>
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">OS</th>
                                            <th scope="col">Application name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($apps as $app)
                                            <tr>
                                                <th scope="row"><input type="checkbox" class="app_check"
                                                        name="application[]" id="application" value="{{ $app->id }}"
                                                        @foreach ($assigned_applications as $a_apps)
                                                    @if ($a_apps->pivot->applications_id == $app->id)
                                                        {{ $checked = 'checked="checked"' }}
                                                    @endif
                                        @endforeach></th>
                                        <td>Windows</td>
                                        <td>{{ $app->application }}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="" class="btn btn-secondary" id="ajaxSubmit"
                                    onclick="event.preventDefault();EditNewEmployeeAjax()">Assign Employee Roles &
                                    Devices</a>
                            </div>
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

    <script>
        function EditNewEmployeeAjax() {
            $('#ajax_messages ol').remove();
            //Post requests
            var id = $('#id').val();
            var roles = $('#roles').val();
            var groups = $('#groups').val();
            var device = $('#device').val();
            var apps = $('.app_check:checked').serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                }
            }); //End of AjaxSetup
            $.ajax({
                url: "/employee/edit/ajax",
                method: "post",
                data: {
                    id: id,
                    roles: roles,
                    groups: groups,
                    device: device,
                    apps: apps,

                }, //End of data
                success: function(response) {
                    //   console.log(response);
                    $('#mtype').attr('class', 'btn btn-success');
                    $('#ajax_messages').append('<ol><li><h4>' + response
                        .success +
                        '</h4></li></ol>');
                    $('#modal').modal('show');
                    setTimeout(function() { // wait for 7 mili secs(2)
                        // $("#cform")[0].reset();

                        location.reload(); // then reload the page.(3)
                    }, 700);



                }, //end of respnse
                error: function(error) {
                    console.log(error);
                    $('#mtype').attr('class',
                        'btn btn-danger');
                    $('#ajax_messages').append('<ol>');
                    //for (var prop in error.responseJSON.errors) {
                    var item = error.responseJSON.error;
                    $('#ajax_messages ol').append('<li><h4>' + item +
                        '</h4></li>');
                    //
                    // console.log(item);
                    //}
                    $('#modal').modal('show')

                }

            }); //End of Ajax Call


        }

    </script>

@endsection
