@extends('layouts.app')

@section('content')
    <div class="container large-container">
        <div class="card">
            <div class="card-header">{{ __('Overview') }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <!--HOME Overview--->
                            <div class="card-body">
                                <p><i class="text-muted">Employees assigned under you count over view</i></p>
                                <h4>Active Employees&nbsp;<span class="badge bg-success rounded-pill"
                                        style="color:#fff;">{{ $a_e_count }}</span></h4>
                                <h4>Inactive Employees&nbsp;<span class="badge bg-danger rounded-pill"
                                        style="color:#fff;">{{ $d_e_count }}</span></h4>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <!--HOME Overview--->
                            <div class="card-body">
                                <p><i class="text-muted">Devices assigned to your group</i></p>
                                <h4>Active Devices: <span class="badge bg-success rounded-pill"
                                        style="color:#fff;">{{ $a_d_count }}</span></h4>
                                <h4>Inactive Devices: <span class="badge bg-danger rounded-pill"
                                        style="color:#fff;">{{ $in_d_count }}</span></h4>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <!--HOME Overview--->
                            <div class="card-body">
                                <p style="font-size: 15px;"><span class="badge bg-primary rounded-pill"
                                        style="color:#fff;">0</span> New
                                    Notifications</p>
                                <p style="font-size: 15px;"><span class="badge bg-danger rounded-pill"
                                        style="color:#fff;">0</span> New
                                    System Alert</p>
                                <p style="font-size: 15px;"><span class="badge bg-warning text-dark rounded-pill"
                                        style="color:#fff;">1</span> Updates Available</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        &nbsp;&nbsp;
        <!---EMPLOYEE INFORMATION ALONG WITH THEIR STATUS-->
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
                                <tr data-toggle="collapse" data-target="#accordion{{ $employee->id }}" class="clickable"
                                    style="cursor: pointer;">
                                    <th scope="row">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                        </svg>&nbsp;
                                        {{ $employee->id }}
                                    </th>
                                    <td>{{ strtoupper($employee->seid) }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->l_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{!! $employee->active == 0 ? '<span class="badge bg-danger"
                                            style="color:#fff;">inactive</span>' : '<span class="badge bg-success"
                                            style="color:#fff;">active</span>' !!}</td>
                                </tr>
                                <tr class="collapse text-muted" id="accordion{{ $employee->id }}" >
                                    <td colspan="6" style="border-top: none;">
                                        <div >
                                            @if (count($employee->devices) != 0)
                                                @foreach ($employee->devices as $employee_dev)

                                                    <i><b>Assigned Device:</b>
                                                        <span
                                                            class="text-success">{{ $employee_dev->Device_name }}</span></i>
                                                @endforeach
                                            @else
                                                <i><b>Assigned Device:</b><span class="text-danger">&nbsp; None</span></i>
                                            @endif
                                            <!---group-->
                                            @if (count($employee->groups) != 0)
                                                @foreach ($employee->groups as $employee_gro)
                                                    &nbsp;
                                                    <i><b>Assigned Group:</b><span class="text-primary">
                                                            {{ $employee_gro->group }}</span></i>
                                                @endforeach
                                            @else
                                                &nbsp;
                                                <i><b>Assigned Group:</b><span class="text-danger">&nbsp; None</span></i>
                                            @endif
                                            <!--Roles-->
                                            @if (count($employee->roles) != 0)
                                                <i><b>Assigned Roles:</b>
                                                    @foreach ($employee->roles as $employee_rol)
                                                        &nbsp;
                                                        <span class="text-info">
                                                            {{ $employee_rol->roles }}</span>,
                                                    @endforeach
                                                </i>
                                            @else
                                                &nbsp;
                                                <i><b>Assigned Roles:</b><span class="text-danger">&nbsp; None</span></i>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Device Infoamtion -->
        &nbsp;&nbsp;
        <!---EMPLOYEE INFORMATION ALONG WITH THEIR STATUS-->
        <div class="card">
            <div class="card-header">{{ __('Devices') }}</div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Make/Model</th>
                                <th scope="col">Assigned to</th>
                                <th scope="col">Device Name</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee_device as $device)
                                <tr>
                                    <td>{{ strtoupper($device->make) }}/{{ $device->model }}</td>
                                    @if (count($device->employees) != 0)
                                        @foreach ($device->employees as $emp_dev)

                                            <td><u>{{ $emp_dev->name }}&nbsp;{{ $emp_dev->l_name }}</u></td>
                                        @endforeach
                                    @else
                                        <td>Unassigned</td>
                                    @endif
                                    <td>{{ $device->Device_name }}</td>
                                    <td>{!! $device->active == 0 ? '<span class="badge bg-danger"
                                            style="color:#fff;">Unassigned</span>' : '<span class="badge bg-success"
                                            style="color:#fff;">Assigned</span>' !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
