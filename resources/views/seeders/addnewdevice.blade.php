@extends('layouts.app')

@section('content')

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Add New Device') }}</div>

            <div class="card-body">
                <form id="cform">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Make</label>
                                <input type="text" name="make" id="make" class="form-control"
                                    placeholder="i.e. Apple, HP, Samsung" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Manufacturer of the device</small>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Model</label>
                                <input type="text" name="model" id="model" class="form-control"
                                    placeholder="i.e. Dell Latitude 4950" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Model of the device</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Year</label>
                                <input type="text" name="year" id="year" class="form-control" placeholder="2015, 2020"
                                    aria-describedby="helpId">
                                <small id="helpId" class="text-muted">year device was manufactured</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">OS</label>
                                <select class="form-control" name="opsys" id="opsys">
                                    <option value="0">-Select OS--</option>
                                    <option value="windows 10 Enterprise">Windows</option>
                                    <option value="MacOS">MacOS</option>
                                    <option value="Linux">Linux</option>
                                    <option value="AndroidOS">AndroidOS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Serial Number</label>
                                <input type="text" name="serial_number" id="serial_number" class="form-control"
                                    placeholder="i.e. ZSE52555PT654" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Unique identification of the device. (found in System
                                    info or at the bottom of the device)</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Device Name</label>
                                <input type="text" name="device_name" id="device_name" class="form-control"
                                    placeholder="i.e. A0002555PT654" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Device name given by the organization</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <a href="" class="btn btn-success" id="ajaxSubmit"
                                    onclick="event.preventDefault();CreateNewDeviceAjax()">Add New Device to System
                                    (seeder)</a>
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
        function CreateNewDeviceAjax() {
            $('#ajax_messages ol').remove();
            //Post requests
            var make = $('#make').val();
            var model = $('#model').val();
            var year = $('#year').val();
            var opsys = $('select#opsys').val();
            var serial_number = $('#serial_number').val();
            var Device_name = $('#device_name').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                }
            }); //End of AjaxSetup
            $.ajax({
                url: "/seeder/adddevices/devicenewseed",
                method: "post",
                data: {
                    make: make,
                    model: model,
                    year: year,
                    OS: opsys,
                    serial_number: serial_number,
                    Device_name: Device_name,


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
                    }, 1400);



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
@endsection
