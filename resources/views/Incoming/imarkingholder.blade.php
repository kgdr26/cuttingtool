@extends('main')
@section('content')

<section>
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <a href="{{route('imarkingholder')}}" class="btn tabs-header active">
                    Holder
                </a>
                
                <a href="{{route('imarkingtool')}}" class="btn tabs-header">
                    Cutting Tool
                </a>
            </div>
            <div class="col-4">
                <div class="input-group style-search mx-4 w-100">
                    <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                    <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Marking Holder</p>
            </div>
            <div class="col-6">

            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>PART NO</th>
                        <th>ENGINEERING NO</th>
                        <th>HES NO</th>
                        <th>SPESIFICATION</th>
                        <th>TYPE</th>
                        <th>MATERIAL</th>
                        <th>MARKING PROGRAM</th>
                        <th>QTY</th>
                        <th>LIFETIME</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="getallmarkingholder">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>08-91-00137</td>
                            <td>-</td>
                            <td>IN-5JC547</td>
                            <td>IN-5JC547 HOLDER C4-PSSNL-27042-12 SANDVIK</td>
                            <td>CAPTO</td>
                            <td>ST</td>
                            <td>0000</td>
                            <td>20</td>
                            <td>2.000.000</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-execute" data-name="execute"><i class="bi bi-caret-right-fill"></i>Execute</button>
                                    <button class="btn btn-verify" data-name="verify"><i class="bi bi-caret-right-fill"></i>Verify</button>
                                </div>
                            </td>
                        </tr>
                    @endfor --}}
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Modal Marking --}}
<div class="modal fade" id="modal_execute" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Marking Manager</h5>
                <input type="hidden" id="id_holder_register">
            </div>
            <div class="modal-body">
                <div class="card-auto mb-3 p-0">
                    <div class="card-header-input">
                        Information
                    </div>
                    <div class="card-body-input">
                        <div class="row">
                            <div class="col-6">
                                <dl class="row mb-0">
                                    <dt class="col-12">Part No</dt>
                                    <dd class="col-12" id="part_no">:-</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">ENGINEERING NO</dt>
                                    <dd class="col-12" id="engineering_no">: -</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">HES NO</dt>
                                    <dd class="col-12" id="hes_no">:-</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">SPESIFICATION</dt>
                                    <dd class="col-12" id="spesification">:-</dd>
                                </dl>
                            </div>
                            <div class="col-6">
                                <dl class="row mb-0">
                                    <dt class="col-12">TYPE</dt>
                                    <dd class="col-12" id="holder_type">:-</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MATERIAL</dt>
                                    <dd class="col-12" id="material_type">:-</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MARKING PROGRAM</dt>
                                    <dd class="col-12" id="marking_program">:-</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-auto mb-3">
                    <div class="row mb-3">
                        <label for="" class="text-label col-3">WCT ID</label>
                        <div class="col-9">
                            <select class="form-select select-2-execute" name="" id="id_wct">
                                <option value="" disabled selected>--select WCT ID--</option>
                                @forelse ($wct as $key => $row)
                                    <option value="{{$row->id}}">{{$row->id_wct}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-3">OP Name</label>
                        <div class="col-9">
                            <select class="form-select select-2-execute" name="" id="id_machine_regis">
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="text-label col-3">Tool Port</label>
                        <div class="col-9">
                            <select class="form-select select-2-execute" name="" id="id_tool_port">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-auto">
                    <div class="d-flex align-items-start justify-content-end w-100 mb-3">
                        <div class="flex-shrink-0 me-3">
                            <i class="icon-marking-step-1"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-step-1">1. Make sure your Holder is in the right position.</p>

                            <div class="row w-100">
                                <div class="col-12">
                                    <dl class="row mb-0">
                                        <dt class="col-12">QR Code</dt>
                                        <input type="hidden" id="qr_code_value">
                                        <dd class="col-12 m-0" id="qr_code">
                                            {{-- [1.JC547.23.016];[1.20.01]
                                            <br>
                                            [WCT_ID.HES_NO.TAHUN.QUANTITY_HOLDER_PER_WCT_ID].[WCT_ID.OP_NAME.TOOL_PORT] --}}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-start justify-content-end w-100">
                        <div class="flex-shrink-0 me-3">
                            <i class="icon-marking-step-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-step-1">2. Press Start Marking when ready.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="start_marking" disabled><span>Start Marking</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Marking --}}

{{-- Modal Verify --}}
<div class="modal fade" id="modal_verify" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verify Marking</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <p class="text-step-1 text-center mb-3"></p>

                    <div class="card-form-scane">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-qr-code"></i></span>
                            <input type="text" id="qr_code_input" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="verify"><span>Verify</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Verify --}}

{{-- chaining select --}}
<script>
    $(document).ready(function () {
        $('#id_wct').on('change', function () {
            let id_wct = $(this).val();
            if (id_wct) {
                $.ajax({
                    url: "{{route('getmachineregisterbyidwct')}}",
                    type: "POST",
                    data: {
                        id: id_wct
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data.arr);
                        $('#id_machine_regis').empty();
                        $('#id_machine_regis').append('<option value="" disabled selected>--select OP Name--</option>');
                        $.each(data.arr, function (key, value) {
                            console.log(data.arr[key].op_name)
                            $('#id_machine_regis').append('<option value="' + data.arr[key].id + '">' + data.arr[key].op_name + '</option>');
                        });
                    }
                });
            } else {
                $('#id_machine_regis').empty();
                $('#id_tool_port').empty();
            }
        });

        $('#id_machine_regis').on('change', function () {
            let id_machine_regis = $(this).val();
            if (id_machine_regis) {
                $.ajax({
                    url: "{{route('gettoolportbyidmachineregister')}}",
                    type: "POST",
                    data: {
                        id: id_machine_regis
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $('#id_tool_port').empty();
                        $('#id_tool_port').append('<option value="" disabled selected>--select Tool Port--</option>');
                        $.each(data.arr, function (key, value) {
                            $('#id_tool_port').append('<option value="' + data.arr[key].id + '">' + data.arr[key].tool_port + '</option>');
                        });
                    }
                });
            } else {
                $('#id_tool_port').empty();
            }
        });
    });
</script>

{{-- initiate data --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        getallmarkingholder();
    });

    const getallmarkingholder = () => {
        fetch("{{route('getallmarkingholder')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data.arr);
            if (data.status) {
                document.getElementById('getallmarkingholder').innerHTML = data.arr;
            } else {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch(error => {
            Swal.fire({
                position:'center',
                title: 'Failed!',
                text: error,
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }
</script>

{{-- if id_machine_regis is selected then button disabled --}}
<script>
    $(document).on('change', '#id_machine_regis', function () {
        document.getElementById('start_marking').disabled = true;
    });
</script>
{{-- if id_wct is selected then button enabled --}}
<script>
    $(document).on('change', '#id_wct', function () {
        let id_wct = $(this).val();
        document.getElementById('start_marking').disabled = true;
    });
</script>
{{-- if id_tool_port is selected then button enabled --}}
<script>
    $(document).on('change', '#id_tool_port', function () {
        let id_tool_port = $(this).val();
        if (id_tool_port) {
            document.getElementById('start_marking').disabled = false;
            // fetch to get qr_code
            let id_wct             = $('#id_wct').val();
            let id_machine_regis   = $('#id_machine_regis').val();
            let id_tool_port       = $('#id_tool_port').val();
            let id_holder_register = $('#id_holder_register').val();

            fetch("{{route('getqrholder')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: JSON.stringify({id_wct: id_wct, id_machine_regis: id_machine_regis, id_tool_port: id_tool_port, id_holder_register: id_holder_register})
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data.arr);
                if (data.status) {
                    document.getElementById('qr_code').innerHTML = data.qr_code;
                    $('#qr_code_value').val(data.qr_code);
                    // write qr_code to input
                } else {
                    Swal.fire({
                        position:'center',
                        title: 'Failed!',
                        text: data.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: error,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            });


        } else {
            document.getElementById('start_marking').disabled = true;
        }
    });
</script>


{{-- JS Marking --}}
<script>
    $(document).on("click", "[data-name='execute']", function (e) {
        $("#modal_execute").modal('show');
        let id = $(this).data('item');
        $('#id_holder_register').val(id);
        
        // fetch data holder by id_holder_register
        fetch("{{route('getholderregisbyid')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({id: id})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            if (data.status) {
                $('#part_no').text(': ' + data.arr.part_no);
                $('#engineering_no').text(': ' + data.arr.engineering_no);
                $('#hes_no').text(': ' + data.arr.hes_no);
                $('#spesification').text(': ' + data.arr.spesification);
                $('#holder_type').text(': ' + data.arr.holder_type);
                $('#material_type').text(': ' + data.arr.material_type);
                $('#marking_program').text(': ' + data.arr.marking_program);

            } else {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch(error => {
            Swal.fire({
                position:'center',
                title: 'Failed!',
                text: error,
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
</script>
{{-- start marking --}}
<script>
    $(document).on('click', '#start_marking', function () {
        let id_holder_register = $('#id_holder_register').val();
        let id_wct = $('#id_wct').val();
        let qr_code = $('#qr_code_value').val();
        let formData = new FormData();
        formData.append('id_wct', id_wct);
        formData.append('id_machine_regis', $('#id_machine_regis').val());
        formData.append('id_tool_port', $('#id_tool_port').val());
        formData.append('qr_code', qr_code);
        formData.append('id_holder_register', id_holder_register);

        fetch("{{route('startmarking')}}", {
            method: 'POST',
            headers: {
                // 'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            if (data.status) {
                Swal.fire({
                    position:'center',
                    title: 'Success!',
                    text: data.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                $("#modal_execute").modal('hide');
            } else {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch(error => {
            Swal.fire({
                position:'center',
                title: 'Failed!',
                text: error,
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
</script>
{{-- End JS Marking --}}

{{-- JS verify --}}
<script>
    $(document).on("click", "[data-name='verify']", function (e) {
        $("#modal_verify").modal('show');
        let id      = $(this).data('item');
        let qr_code = $(this).data('arr');

        // cek input qr_code
        $('#verify').on('click', function () {
            let qr_code_input = $('#qr_code_input').val();

            if (qr_code_input == qr_code) {
                // success verify
                fetch("{{route('verifyholdermarking')}}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({
                        id_holder_register: id,
                        qr_code: qr_code_input
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.status) {
                        Swal.fire({
                            position:'center',
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#modal_verify").modal('hide');
                        // refresh data
                        getallmarkingholder();
                    } else {
                        Swal.fire({
                            position:'center',
                            title: 'Failed!',
                            text: data.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        position:'center',
                        title: 'Failed!',
                        text: error,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            } else {
                // failed verify
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: 'QR Code not match!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });


    });
</script>
{{-- End JS verify --}}

{{-- JS Select2 --}}
<script>
    $(".select-2-execute").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_execute')
    });

    $(".select-2-edit").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_edit')
    });
</script>
{{-- End JS Select2 --}}



@stop