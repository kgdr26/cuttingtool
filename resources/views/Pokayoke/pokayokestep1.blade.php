@extends('main')
@section('content')

<section>
    <div class="grid-flow">
        <div class="card-step">
            <div class="header">
                <p>STEP 1  Scan Machine</p>
                <p>Scan QRcode in Machine</p>
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
                        <li id="step_progress_2" class="float-start progressbar-list">
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
                <p>SCAN MACHINE</p>
                <p id="qr_machine"></p>
                <i></i>
                <i></i>
                <i></i>
                <i></i>
            </button>

            <div class="card-content-information">
                <div class="header">
                    Machine Information
                </div>
                <div class="body">
                    <input type="hidden" id="id_list_machine">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Plant ID</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="id_plant" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Asset No</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="asset_id" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">WCT ID</label>
                                <div class="col-12">
                                    <input type="text" id="id_wct" class="form-control" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Machine Name</label>
                                <div class="col-12">
                                    <input type="text" id="machine_name" class="form-control" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">OP Name</label>
                                <div class="col-12">
                                    <input type="text" id="op_name" class="form-control" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Communication</label>
                                <div class="col-12">
                                    <input type="text" id="ip_address" class="form-control" value="" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-button">
            <div class="row">
                <div class="col-12">
                    <button id="next_step_2" class="btn btn-save w-100" disabled >NEXT</button>
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
                    <input type="text" class="form-control" id="qr_code" readonly>
                    <audio id="successSound" src="{{asset('assets/suarscane.mp3')}}"></audio>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel me-1" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" disabled id="check_machine_by_asset_id"><span>Scan</span></button>
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
        $('#check_machine_by_asset_id').prop('disabled', false);
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
        $('#check_machine_by_asset_id').prop('disabled', true);
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

{{-- check if param is exist then show data --}}
<script>
    $(document).ready(function(){
        var asset_id = '{{ $asset_id }}';
        if(asset_id != ''){
            machinebyqr(asset_id);
        }
    });
</script>

<script>
$(document).ready(function(){
    var screenWidth             = $(window).width();
    var screenHeight            = $(window).height();
    
    console.log("Screen width: " + screenWidth);
    console.log("Screen height: " + screenHeight);
});
</script>

<script>
document.getElementById('check_machine_by_asset_id').addEventListener('click', function() {
    var qr_code = document.getElementById('qr_code').value;
    
    if(qr_code == ''){
        alert('Please scan QR Code');
    }else{
        machinebyqr(qr_code);
    }
});
</script>

<script>
    const machinebyqr = (qr_code) => {
        
        fetch("{{route('machinebyqr')}}", {
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
                document.getElementById('qr_machine').innerHTML = 'QR Number : ' + row.asset_id;
                document.getElementById('id_plant').value = row.id_plant;
                document.getElementById('asset_id').value = row.asset_id;
                document.getElementById('id_wct').value = row.id_wct;
                document.getElementById('machine_name').value = row.machine_name;
                document.getElementById('op_name').value = row.op_name;
                document.getElementById('ip_address').value = row.ip_address + ' : ' + row.port;
                document.getElementById('id_list_machine').value = row.id;
                $('#modal_scan').modal('hide');
                document.getElementById('next_step_2').removeAttribute('disabled');
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

<script>
    document.getElementById('next_step_2').addEventListener('click', function() {
        var id_list_machine = document.getElementById('id_list_machine').value;
        var id_list_machine = btoa(document.getElementById('id_list_machine').value);
        window.location.href = "{{route('pokayokestep2')}}" + '?id_list_machine=' + id_list_machine;
    });
</script>

@stop