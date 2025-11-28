@extends('main')
@section('content')

<section>
    <div id="loading-overlay" class="president" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(107, 102, 102, 0.8); z-index: 9999;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-5">
                <div class="card-action">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="flex-shrink-0">
                            <i class="icon-qr-label"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="d-flex justify-content-start">
                                <span class="text-lale-qr d-block">PLEASE SCAN QR HOLDER</span>
                            </div>

                            <div class="d-flex justify-content-start">
                                <input type="text" id="scan_qr_code" class="form-control qr-code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-7">
                <div class="card-action">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="flex-shrink-0">
                            <div class="card-image-machine">
                                <img src="{{asset('assets/images/machine.svg')}}" alt="">
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row mb-1">
                                        <label for="" class="text-label col-3">PLANT ID</label>
                                        <div class="col-9">
                                            <input type="text" id="plant" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="" class="text-label col-3">WCT ID</label>
                                        <div class="col-9">
                                            <input type="text" id="wct" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="row mb-1">
                                        <label for="" class="text-label col-3">OP Name</label>
                                        <div class="col-9">
                                            <input type="text" id="op_name" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="" class="text-label col-3">Tool Port</label>
                                        <div class="col-9">
                                            <input type="text" id="tool_port" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- cutting tool --}}
        <div class="row">
            <div class="col-6">
                <div class="d-flex justify-content-start">
                    <p class="text-judul"><i class="bi bi-dot"></i> Cutting Tool</p>
                </div>
            </div>

            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <p class="text-count-to">5/30</p>
                </div>
            </div>
        </div>

        <div class="gridtable-tool">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SPESIFICATION</th>
                        <th>TYPE</th>
                        <th>JUDGEMENT</th>
                        <th>MAX REPLACEMENT</th>
                        <th>ACTUAL & MAX INDEXING/ REGRIND</th>
                        <th>PRICE</th>
                        <th>QR CODE</th>
                        <th>RESULT</th>
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody id="tool">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>Single Edged Square BT</td>
                            <td>Single Edged Square BT</td>
                            <td>INDEXING</td>
                            <td>2.000</td>
                            <td>3 of 4</td>
                            <td>Rp. 2.000.000</td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text" id=""><i class="bi bi-qr-code"></i></span>
                                    <input type="text" class="form-control">
                                </div>
                            </td>
                            <td>
                                <i class="bi bi-check-circle-fill"></i> --}}
                                {{-- <i class="bi bi-x-circle-fill"></i> --}}
                            {{-- </td>
                        </tr>
                    @endfor --}}
                </tbody>
            </table>
        </div>

        {{-- holder --}}
        <div class="row">
            <div class="col-6">
                <div class="d-flex justify-content-start">
                    <p class="text-judul"><i class="bi bi-dot"></i> Holder</p>
                </div>
            </div>

            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <p class="text-count-to">1/1</p>
                </div>
            </div>
        </div>

        <div class="gridtable-holder">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SPESIFICATION</th>
                        <th>TYPE</th>
                        <th>MAX LIFETIME</th>
                        <th>ACTUAL LIFETIME</th>
                        <th>PRICE</th>
                        <th>QR CODE</th>
                        <th>RESULT</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="holder">
                    {{-- <tr>
                        <td>1</td>
                        <td>Single Edged Square BT</td>
                        <td>Single Edged Square BT</td>
                        <td>2.000</td>
                        <td>100</td>
                        <td>Rp. 2.000.000</td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text" id=""><i class="bi bi-qr-code"></i></span>
                                <input type="text" class="form-control">
                            </div>
                        </td>
                        <td> --}}
                            {{-- <i class="bi bi-check-circle-fill"></i> --}}
                            {{-- <i class="bi bi-x-circle-fill"></i>
                        </td> --}}
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- accesories --}}
        <div class="row">
            <div class="col-6">
                <div class="d-flex justify-content-start">
                    <p class="text-judul"><i class="bi bi-dot"></i> Accessories</p>
                </div>
            </div>

            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <p class="text-count-to">5/30</p>
                </div>
            </div>
        </div>

        <div class="gridtable-accesories">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SPESIFICATION</th>
                        <th>TYPE</th>
                        <th>MAX LIFETIME</th>
                        <th>ACTUAL LIFETIME</th>
                        <th>PRICE</th>
                        <th>QR CODE [PART_NO]</th>
                        <th>RESULT</th>
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody id="accesories">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>Single Edged Square BT</td>
                            <td>Single Edged Square BT</td>
                            <td>2.000</td>
                            <td>100</td>
                            <td>Rp. 2.000.000</td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text" id="" data-name="qr_accesories"><i class="bi bi-qr-code"></i></span>
                                    <input type="text" class="form-control">
                                </div>
                            </td>
                            <td>
                                <i class="bi bi-check-circle-fill"></i>
                                <i class="bi bi-x-circle-fill"></i>
                            </td>
                        </tr>
                    @endfor --}}
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-save" disabled id="create_assy_tool"><span>Create Assy Tool</span></button>
        </div>
    </div>
</section>

{{-- Modal Modal Show QR --}}
<div class="modal fade" id="modal_qr_accesories" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Accessories Information</h5>
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
                                    <dd class="col-12">: Part No 08-91-00137</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">ENGINEERING NO</dt>
                                    <dd class="col-12">: -</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">HES NO</dt>
                                    <dd class="col-12">: IN-5JC547</dd>
                                </dl>
                            </div>
                            <div class="col-6">
                                <dl class="row mb-0">
                                    <dt class="col-12">TYPE</dt>
                                    <dd class="col-12">: CAPTO</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">MATERIAL</dt>
                                    <dd class="col-12">: ST</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">SPESIFICATION</dt>
                                    <dd class="col-12">: HOLDER C4-PSSNL-27042-12</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-auto">
                    <div class="d-flex justify-content-center">
                        <img class="qr-show" src="{{asset('assets/images/qr-default.svg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel me-1" data-bs-dismiss="modal"><span>Close</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Show QR --}}

<script>
    $(document).on("change", "#plant", function (e) {
        var id_plant    = $(this).val();
        var wct         = $("#wct");
        wct.empty();

        fetch("{{route('getwctbyplant')}}",{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({id_plant: id_plant})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            wct.append('<option value="">-- select WCT ID --</option>');
            for (let i = 0; i < data.length; i++) {
                wct.append('<option value="' + data[i].id + '">' + data[i].line_name + '</option>');
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
    $(document).on("change", "#wct", function (e) {
        var id_wct    = $(this).val();
        var op_name   = $("#op_name");
        op_name.empty();

        fetch("{{route('getopnamebywct')}}",{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({id: id_wct})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            op_name.append('<option value="">-- select OP NAME --</option>');
            for (let i = 0; i < data.arr.length; i++) {
                op_name.append('<option value="' + data.arr[i].id + '">' + data.arr[i].op_name + '</option>');
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
    $(document).on("change", "#op_name", function (e) {
        var id_op_name    = $(this).val();
        var tool_port     = $("#tool_port");
        tool_port.empty();

        fetch("{{route('gettoolportbyopname')}}",{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({id: id_op_name})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            tool_port.append('<option value="">-- select Tool Port --</option>');
            for (let i = 0; i < data.arr.length; i++) {
                tool_port.append('<option value="' + data.arr[i].id + '">' + data.arr[i].tool_port + '</option>');
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
    $(document).on("change", "#tool_port", function (e) {
        // alert('tes')
        let id = $(this).val();
        // alert(id);
        fetch("{{route('fetchhtmlassy')}}",{
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
            console.log(data)
            wct.append('<option value="">-- select WCT ID --</option>');
            for (let i = 0; i < data.length; i++) {
                wct.append('<option value="' + data[i].id + '">' + data[i].line_name + '</option>');
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

{{-- JS Modal Show QR --}}
<script>
    $(document).on("click", "[data-name='qr_accesories']", function (e) {
        // generate html cutting tool. holder, accesories
    });

</script>
{{-- End Modal Show QR --}}

{{-- if scan qr code input value or enter --}}
<script>
    $(document).on("keyup", "#scan_qr_code", function (e) {
        if (e.keyCode === 13) {
            var qr_code = $(this).val();
            if (qr_code == '') {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: 'Please input QR Code !',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else {
                  // Show loading overlay
                $('#loading-overlay').show();
                // fetch data qr code
                fetch("{{route('fetchhtmlassy')}}",{
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({qr_code: qr_code})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data)
                    let tool = data.tool;
                    let max_regrind_indexing = 0;
                    let html_tool = '';
                    for (let i = 0; i < tool.length; i++) {
                        if(tool[i].judgement == 'indexing'){
                            let max_regrind_indexing = tool[i].max_regrind;
                        } else {
                            let max_regrind_indexing = tool[i].max_indexing;
                        }
                        html_tool += '<tr>';
                        html_tool += '<td>' + (i+1) + '</td>';
                        html_tool += '<td>' + tool[i].spesification + '</td>';
                        html_tool += '<td>' + tool[i].tool_type + '</td>';
                        html_tool += '<td>' + tool[i].judgement + '</td>';
                        html_tool += '<td>' + tool[i].replacement + '</td>';
                        html_tool += '<td>' + max_regrind_indexing + '</td>';
                        html_tool += '<td>' + tool[i].price + '</td>';
                        html_tool += '<td>';
                        html_tool += '<div class="input-group">';
                        html_tool += '<span class="input-group-text" ><i class="bi bi-qr-code"></i></span>';
                        html_tool += '<input type="text" data-type="tool" name="scan_tool[]" data-item="'+tool[i].id+'" class="form-control checkqr">';
                        html_tool += '</div>';
                        html_tool += '</td>';
                        html_tool += '<td id="result_tool_'+tool[i].id+'">';
                        // html_tool += '<i class="bi bi-check-circle-fill"></i>';
                        html_tool += '</td>';
                        html_tool += '</tr>';
                        $("#tool").html(html_tool);
                    }

                    let holder = data.holder;
                    let html_holder   = '';
                    for (let i = 0; i < holder.length; i++) {
                        html_holder += '<tr>';
                        html_holder += '<td>' + (i+1) + '</td>';
                        html_holder += '<td>' + holder[i].spesification + '</td>';
                        html_holder += '<td>' + holder[i].holder_type + '</td>';
                        html_holder += '<td>' + holder[i].lifetime + '</td>';
                        html_holder += '<td>' + holder[i].actual_lifetime + '</td>';
                        html_holder += '<td>' + holder[i].price + '</td>';
                        html_holder += '<td>';
                        html_holder += '<div class="input-group">';
                        html_holder += '<span class="input-group-text" ><i class="bi bi-qr-code"></i></span>';
                        html_holder += '<input type="text" data-type="holder" name="scan_holder[]" data-item="'+holder[i].id+'" class="form-control checkqr">';
                        html_holder += '</div>';
                        html_holder += '</td>';
                        html_holder += '<td id="result_holder_'+holder[i].id+'">';
                        // html_holder += '<i class="bi bi-check-circle-fill"></i>';
                        html_holder += '</td>';
                        html_holder += '</tr>';
                        $("#holder").html(html_holder);
                    }
                    
                    let acc = data.acc;
                    let html_acc   = '';
                    for (let i = 0; i < acc.length; i++) {
                        html_acc += '<tr>';
                        html_acc += '<td>' + (i+1) + '</td>';
                        html_acc += '<td>' + acc[i].spesification + '</td>';
                        html_acc += '<td>' + acc[i].accesories_type + '</td>';
                        html_acc += '<td>' + acc[i].lifetime + '</td>';
                        html_acc += '<td>' + acc[i].actual_lifetime + '</td>';
                        html_acc += '<td>' + acc[i].price + '</td>';
                        html_acc += '<td>';
                        html_acc += '<div class="input-group">';
                        html_acc += '<span class="input-group-text" ><i class="bi bi-qr-code"></i></span>';
                        html_acc += '<input data-type="acc" type="text" name="scan_acc[]" data-item="'+acc[i].id+'" class="form-control checkqr">';
                        html_acc += '</div>';
                        html_acc += '</td>';
                        html_acc += '<td id="result_acc_'+acc[i].id+'">';
                        // html_acc += '<i class="bi bi-check-circle-fill"></i>';
                        html_acc += '</td>';
                        html_acc += '</tr>';
                        $("#accesories").html(html_acc);
                    }

                    $('#loading-overlay').hide();
                    $('#create_assy_tool').removeAttr('disabled');
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

                    $('#loading-overlay').hide();

                });
            }
        }
    });
</script>

<script>
    // on change input qr code
    $(document).on("change", ".checkqr", function (e) {
        let qr_code = $(this).val();
        let item    = $(this).data('item');
        let type    = $(this).data('type');

        fetch("{{route('checkqrassy')}}",{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                qr_code: qr_code,
                id: item,
                type: type
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            if(data.status){
                $("#result_"+type+"_"+item).html('<i class="bi bi-check-circle-fill"></i>');
            } else {
                $("#result_"+type+"_"+item).html('<i class="bi bi-x-circle-fill"></i>');
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
    document.getElementById('create_assy_tool').addEventListener('click', function() {
        let qr_tool         = document.querySelectorAll('input[data-type="tool"]');
        let qr_holder       = document.querySelectorAll('input[data-type="holder"]');
        let qr_acc          = document.querySelectorAll('input[data-type="acc"]');
        let qr_tool_arr     = [];
        let qr_holder_arr   = [];
        let qr_acc_arr      = [];

        qr_tool.forEach(function(item) {
            qr_tool_arr.push(item.value);
        });

        qr_holder.forEach(function(item) {
            qr_holder_arr.push(item.value);
        });

        qr_acc.forEach(function(item) {
            qr_acc_arr.push(item.value);
        });

        fetch("{{route('createassy')}}",{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                qr_tool: qr_tool_arr,
                qr_holder: qr_holder_arr,
                qr_acc: qr_acc_arr
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            if(data.status){
                Swal.fire({
                    position:'center',
                    title: 'Success!',
                    text: data.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    location.reload();
                });
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

{{-- JS Select2 --}}
<script>
    $(".select-2").select2({
        allowClear: false,
        width: '100%'
    });
</script>
{{-- End JS Select2 --}}

@stop
