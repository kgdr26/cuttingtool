@extends('main')
@section('content')

<section>
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <a href="{{route('imarkingholder')}}" class="btn tabs-header">
                    Holder
                </a>
                
                <a href="{{route('imarkingtool')}}" class="btn tabs-header active">
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
                <p class="judul-menu"><i></i>Marking Tool</p>
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
                        <th>JUDGEMENT</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="getallmarkingtool">
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
                <input type="hidden" id="id_tool_regis">
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
                                    <dd class="col-12" id="part_no">: Part No 08-91-00137</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">ENGINEERING NO</dt>
                                    <dd class="col-12" id="engineering_no">: -</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">HES NO</dt>
                                    <dd class="col-12" id="hes_no">: IN-5JC547</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">SPESIFICATION</dt>
                                    <dd class="col-12" id="spesification">: TOOL C4-PSSNL-27042-12</dd>
                                </dl>
                            </div>
                            <div class="col-6">
                                <dl class="row mb-0">
                                    <dt class="col-12">TYPE</dt>
                                    <dd class="col-12" id="tool_type">: CAPTO</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MATERIAL</dt>
                                    <dd class="col-12" id="material_type">: ST</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MARKING PROGRAM</dt>
                                    <dd class="col-12" id="marking_program">: 0000</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">JUDGEMENT</dt>
                                    <dd class="col-12" id="judgement">: REGRIND</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-auto mb-3">
                    <div class="row">
                        <label for="" class="text-label col-3">WCT ID</label>
                        <div class="col-9">
                            <select class="form-select select-2-execute" name="" id="id_wct">
                                <option value="" disabled selected>-- select WCT ID --</option>
                                @forelse ($wct as $key => $row)
                                    <option value="{{$row->id}}">{{$row->id_wct}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
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
                            <p class="text-step-1">1. Make sure your Tool is in the right position.</p>

                            <div class="row w-100">
                                {{-- <div class="col-6">
                                    <dl class="row mb-0">
                                        <dt class="col-12">Program No</dt>
                                        <dd class="col-12 m-0">0008</dd>
                                    </dl>
                                </div> --}}
                                <div class="col-12">
                                    <dl class="row mb-0">
                                        <dt class="col-12">QR Code</dt>
                                        <input type="hidden" id="qr_code_value">
                                        <dd class="col-12 m-0" id="qr_code">-</dd>
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

{{-- initiate Data --}}
<script>
    document.addEventListener('DOMContentLoaded', function(){
        getallmarkingtool();
    })

    const getallmarkingtool = () => {
        fetch("{{route('getallmarkingtool')}}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('getallmarkingtool').innerHTML = data.arr;

        })
        .catch(error => console.error('Error:', error));
    }
</script>

{{-- JS Marking --}}
<script>
    $(document).on("click", "[data-name='execute']", function (e) {
        $("#modal_execute").modal('show');
        let id = $(this).data('item');
        $("#id_tool_regis").val(id);
        
        // fetch data tool regis
        fetch("{{route('gettoolregisbyid')}}", {
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
            if (data.status) {
                let row = data.arr.tool;
                $('#part_no').text(': ' + row.part_no);
                $('#engineering_no').text(': ' + row.engineering_no);
                $('#hes_no').text(': ' + row.hes_no);
                $('#spesification').text(': ' + row.spesification);
                $('#tool_type').text(': ' + row.tool_type);
                $('#material_type').text(': ' + row.material_type);
                $('#marking_program').text(': ' + row.marking);
                $('#judgement').text(': ' + row.judgement);
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

{{-- if id_wct is selected then button enabled --}}
<script>
    $(document).on('change', '#id_wct', function () {
        let id_wct = $(this).val();
        let id_tool_regis = $("#id_tool_regis").val();
        document.getElementById('start_marking').disabled = false;

        fetch("{{route('getqrtool')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({id_wct: id_wct, id_tool_regis: id_tool_regis})
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

<script>
    $(document).on('click', '#start_marking', function () {
        let id_wct = $("#id_wct").val();
        let qr_code = $("#qr_code_value").val();
        let id_tool_regis = $("#id_tool_regis").val();

        fetch("{{route('startmarkingtool')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({id_wct: id_wct, qr_code: qr_code, id_tool_regis: id_tool_regis})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
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
                getallmarkingtool();
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

{{-- JS verify --}}
<script>
    $(document).on("click", "[data-name='verify']", function (e) {
        $("#modal_verify").modal('show');
        let id = $(this).data('item');
        let qr_code = $(this).data('arr');
        $('#verify').on('click', function () {
            let qr_code_input = $('#qr_code_input').val();
            // alert(qr_code_input);

            if (qr_code_input == qr_code) {
                // success verify
                fetch("{{route('verifymarkingtool')}}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({
                        id_tool_regis: id,
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
                        getallmarkingtool();
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