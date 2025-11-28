@extends('main')
@section('content')

<section>
    <div class="grid-flow">
        <div class="card-step">
            <div class="header">
                <p>STEP 2  Scan Old Tool</p>
                <p>Scan QRcode in Old Tool</p>
            </div>
            <div class="body">
                <div class="wizard-form">
                    <ul class="progressbar">
                        <li id="step_progress_1" class="float-start progressbar-list active">
                            <i></i>
                            <i></i>
                            <p>Step 1</p>
                            <p>Scan Machine</p>
                        </li>
                        <li id="step_progress_2" class="float-start progressbar-list active">
                            <i></i>
                            <i></i>
                            <p>Step 2</p>
                            <p>Scan Old Tool</p>
                        </li>
                        <li id="step_progress_3" class="float-start progressbar-list">
                            <i></i>
                            <i></i>
                            <p>Step 3</p>
                            <p>Scan New Tool</p>
                        </li>
                        <li id="step_progress_4" class="float-start progressbar-list">
                            <i></i>
                            <i></i>
                            <p>Step 4</p>
                            <p>Verify</p>
                        </li>
                        <li id="step_progress_5" class="float-start progressbar-list">
                            <i></i>
                            <i></i>
                            <p>Step 5</p>
                            <p>Result</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-information">
            <button type="button" class="card-btn-scane" data-name="action_scane">
                <p>SCAN OLD TOOL</p>
                <p id="qr_holder"></p>
                <i></i>
                <i></i>
                <i></i>
                <i></i>
            </button>

            <div class="card-content-information">
                <div class="header">
                    Assy Tool Information
                </div>
                <div class="body">

                    <div class="row w-100">
                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Assy ID</label>
                                <div class="col-12">
                                    <input type="text" id="assy_id" class="form-control" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Tool Port</label>
                                <div class="col-12">
                                    <input type="text" id="tool_port" class="form-control" value="" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-table">
                        <table id="table_list_tool">
                            <thead>
                                <tr>
                                    <th>TYPE</th>
                                    <th>Spesification</th>
                                    <th>QR CODE</th>
                                    <th>LIFETIME</th>
                                    <th>MAX</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @for($i = 1; $i <= 9; $i++)
                                    <tr>
                                        <td rowspan="3">CUTTING TOOL</td>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                    <tr>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                    <tr>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                    <tr>
                                        <td>HOLDER</td>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">ACCESSORIES</td>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                    <tr>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                @endfor --}}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="card-button">
            <div class="row">
                <div class="col-6">
                    <button id="step_1" class="btn btn-save w-100">PREVIOUS</button>
                </div>
                <div class="col-6">
                    <button id="step_3" class="btn btn-save w-100" disabled >NEXT</button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Modal Scan Assy Tool --}}
<div class="modal fade" id="modal_scan" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan QR CODE</h5>
            </div>
            <div class="modal-body">
                <div class="card-cam">
                    <div id="qr_reader"></div>
                </div>
                <div class="form-costum">
                    <label for="" class="form-label">QR Code</label>
                    <input type="text" class="form-control" name="" placeholder="" id="qr_code" disabled>
                    <audio id="successSound" src="{{asset('assets/suarscane.mp3')}}"></audio>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel me-1" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" disabled id="check_trx_assy_by_qr"><span>Scan</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Scan Assy Tool --}}

{{-- JS Scane QR --}}
<script>
    $(document).on("click", "[data-name='action_scane']", function (e) {
        $("#modal_scan").modal('show');
    });

    $('#modal_scan').on('shown.bs.modal', function (e) {
        initQrCodeScanner();
    });

    function initQrCodeScanner() {
        var resultContainer = document.getElementById('qr_reader_results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById("successSound").play();
            $('#qr_code').val(decodedText);
            $('#check_trx_assy_by_qr').prop('disabled', false);
            // alert(decodedText)
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr_reader", { fps: 10, qrbox: 200 });
        html5QrcodeScanner.render(onScanSuccess);

        // Close the modal and stop the scanner
        $('#modal_scan').on('hidden.bs.modal', function (e) {
            html5QrcodeScanner.clear();
            // clear qr code
            $('#qr_code').val('');
            $('#check_trx_assy_by_qr').prop('disabled', true);
        });
    }

    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        // Initialize scanner when DOM is ready
        initQrCodeScanner();
    });
</script>
{{-- End JS Scane QR --}}

{{-- get data trx assy by QR --}}
<script>
    document.getElementById('check_trx_assy_by_qr').addEventListener('click', function () {
        var qr_code = $('#qr_code').val();

        if(qr_code == ''){
            alert('Please scan QR Code');
        }else{
            fetch("{{route('gettrxassybyqr')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: JSON.stringify({
                    qr_code: qr_code
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
                if(data.status){
                    let row = data.arr;
                    document.getElementById('assy_id').value = row.id_assy;
                    document.getElementById('tool_port').value = row.tool_port;
                    document.getElementById('qr_holder').innerHTML = 'QR Number : ' + qr_code;
                    $('#modal_scan').modal('hide');
                    document.getElementById('step_3').removeAttribute('disabled');
                    // get data for table_list_tool
                    table_list_tool(qr_code);
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
    });
</script>

<script>
    $('#table_list_tool').floatThead({
        scrollContainer: function ($table) {
            return $table.closest('.card-table');
        }
    });
</script>

<script>
    const table_list_tool = (qr_code) => {

        fetch("{{route('gettrxassytoolbyqr')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                qr_code: qr_code
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
            if(data.status){
                let html        = '';
                let r_tool      = data.tool;
                let r_holder    = data.holder;
                let r_acc       = data.acc;
                
                for (let i = 0; i < r_tool.length; i++) {
                    html += '<tr>';
                    if(i == 0){
                        html += '<td rowspan="'+r_tool.length+'">CUTTING TOOL</td>';
                    }
                    if(r_tool[i].judgement == 'regrind'){
                        var lifetime = r_tool[i].replacement * r_tool[i].max_regrind;
                    }else {
                        var lifetime = r_tool[i].replacement * r_tool[i].max_indexing;
                    }

                    html += '<td>'+r_tool[i].spesification+'</td>';
                    html += '<td>'+r_tool[i].qr_code+'</td>';
                    html += '<td>'+r_tool[i].actual_lifetime+'</td>';
                    html += '<td>'+lifetime+'</td>';
                    html += '</tr>';
                }

                for (let i = 0; i < r_holder.length; i++) {
                    html += '<tr>';
                    if(i == 0){
                        html += '<td rowspan="'+r_holder.length+'">HOLDER</td>';
                    }

                    html += '<td>'+r_holder[i].spesification+'</td>';
                    html += '<td>'+r_holder[i].qr_code+'</td>';
                    html += '<td>'+r_holder[i].actual_lifetime+'</td>';
                    html += '<td>'+r_holder[i].lifetime+'</td>';
                    html += '</tr>';
                }

                for (let i = 0; i < r_acc.length; i++) {
                    html += '<tr>';
                    if(i == 0){
                        html += '<td rowspan="'+r_acc.length+'">ACCESSORIES</td>';
                    }

                    html += '<td>'+r_acc[i].spesification+'</td>';
                    html += '<td>'+r_acc[i].part_no+'</td>';
                    html += '<td>'+r_acc[i].actual_lifetime+'</td>';
                    html += '<td>'+r_acc[i].lifetime+'</td>';
                    html += '</tr>';
                }

                document.getElementById('table_list_tool').getElementsByTagName('tbody')[0].innerHTML = html;
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

{{-- click previous step --}}
<script>
    document.getElementById('step_1').addEventListener('click', function() {
        var id_list_machine     = btoa('{!! $id_list_machine !!}');
        window.location.href    = "{{route('pokayokestep1')}}" + '?id_list_machine=' + id_list_machine;
    });
</script>

{{-- click next step --}}
<script>
    document.getElementById('step_3').addEventListener('click', function() {
        var id_list_machine     = btoa('{!! $id_list_machine !!}');
        var id_assy_old         = btoa($('#assy_id').val());
        var tool_port           = btoa($('#tool_port').val());

        window.location.href    = "{{route('pokayokestep3')}}" + '?id_list_machine=' + id_list_machine + '&id_assy_old=' + id_assy_old + '&tool_port=' + tool_port;
    });
</script>

@stop