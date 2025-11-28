@extends('main')
@section('content')

<section>
    <div class="action">
        <div class="main-card-scan">
            <div class="input-scan">
                <div class="card-scane" data-hover="Scan Assy Tool" data-name="scane" data-action="scane">
                    <div class="card-scane-content">
                        <i class="icon-scan-dies"></i>
                        <div class="card-scane-text">
                            <p>Scan Assy Tool</p>
                            <p id="valqrassy">QR Number : </p>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="input-manual">
                <div class="card-scane" data-hover="Manual Input" data-name="scane" data-action="manual">
                    <div class="card-scane-content">
                        <i class="icon-scan-manual"></i>
                        <div class="card-scane-text">
                            <p>Manual Input</p>
                            <p id="valqrdies">QR Number : </p>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="card-info">

            </div>
        </div>
    </div>
</section>

{{-- MOdal Scane --}}
<div class="modal fade" id="modal_scane" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-style-1 modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="textmodal">Scane QR Code</h1>
            </div>
            <div class="modal-body">
                <div class="card-cam">
                    <div id="qr_reader"></div>
                    {{-- <div id="qr_reader_results"></div> --}}
                </div>
                <div class="form-costum">
                    <label for="" class="form-label">QR Code</label>
                    <input type="text" class="form-control" name="" placeholder="" id="qr_code">
                    <audio id="successSound" src="{{asset('assets/suarscane.mp3')}}"></audio>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-style-2" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-style-1" >Yes</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Scane --}}

<script>
    $(document).on("click", "[data-name='scane']", function (e) {
        // $('#successSound').play();
        // document.getElementById("successSound").play();
        $('#modal_scane').modal('show');
    });
    

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
        var resultContainer = document.getElementById('qr_reader_results');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            // if (decodedText !== lastResult) {
            //     ++countResults;
            //     lastResult = decodedText;
            //     // Handle on success condition with the decoded message.
            //     // console.log('Scan result ${decodedText}', decodedResult);
            //     // alert(decodedText);
            //     // showTooltip(decodedText);
            // }
            document.getElementById("successSound").play();
            $('#qr_code').val(decodedText);
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr_reader", { fps: 10, qrbox: 200 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>


@stop