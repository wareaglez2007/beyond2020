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
                                <tr>
                                    <th scope="row">{{ $employee->id }}</th>
                                    <td>{{ strtoupper($employee->seid) }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->l_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{!! $employee->active == 0 ? '<span class="badge bg-danger"
                                            style="color:#fff;">inactive</span>' : '<span class="badge bg-success"
                                            style="color:#fff;">active</span>' !!}</td>
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
                                <th scope="col">OS</th>
                                <th scope="col">Serial#</th>
                                <th scope="col">Device Name</th>
                                <th scope="col" >Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($devices as $device)
                                <tr>
                                    <td>{{ strtoupper($device->make) }}/{{ $device->model }}</td>
                                    <td>{{ $device->OS }}</td>
                                    <td>{{ $device->serial_number}}</td>
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
