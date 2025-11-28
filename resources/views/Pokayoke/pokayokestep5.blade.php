@extends('main')
@section('content')

<style>
    .preloader {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1000; /* Sit on top */
        width: 50%; /* Width of the preloader */
        height: 50%; /* Height of the preloader */
        top: 50%; /* Center vertically */
        left: 50%; /* Center horizontally */
        transform: translate(-50%, -50%); /* Centering trick */
        /* background-color: rgba(255, 255, 255, 0.7);  */
    }

    .loading p {
        color: white; 
    }
</style>

<section>
    <div class="grid-flow">
        <div class="card-step">
            <div class="header">
                <p>STEP 4  Scan Machine</p>
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
                        <li id="step_progress_2" class="float-start progressbar-list active">
                            <i></i>
                            <i></i>
                            <p>Step 2</p>
                            <p>Scan Old Tool</p>
                        </li>
                        <li id="step_progress_3" class="float-start progressbar-list active">
                            <i></i>
                            <i></i>
                            <p>Step 3</p>
                            <p>Scan New Tool</p>
                        </li>
                        <li id="step_progress_4" class="float-start progressbar-list active">
                            <i></i>
                            <i></i>
                            <p>Step 4</p>
                            <p>Verify</p>
                        </li>
                        <li id="step_progress_5" class="float-start progressbar-list active">
                            <i></i>
                            <i></i>
                            <p>Step 5</p>
                            <p>Result</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-information" style="display: none">

            <i class="icon-success"></i>
            <p>Success!</p>
            <p>Machine & Assy Tool is match and ready to change</p>

            <div class="card-content-information mb-2">
                <div class="header">
                    OLD ASSY TOOL INFORMATION
                </div>
                <div class="body">
                    <div class="row w-100">
                        <div class="col-3">
                            <dl class="row mb-0">
                                <dt class="col-12">Assy ID</dt>
                                <dd class="col-12">: 1.20.01.23.00001</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">QR Code Holder</dt>
                                <dd class="col-12">: 1.JC547.23.016;12001</dd>
                            </dl>
                        </div>
                        <div class="col-3">
                            <dl class="row mb-0">
                                <dt class="col-12">Start Installed</dt>
                                <dd class="col-12">: 11-12-2023 08:00</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">PIC Installed</dt>
                                <dd class="col-12">: Kang Dru</dd>
                            </dl>
                        </div>
                        <div class="col-3">
                            <dl class="row mb-0">
                                <dt class="col-12">End Installed</dt>
                                <dd class="col-12">: 12-12-2023 12:12</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">PIC Uninstall</dt>
                                <dd class="col-12">: Kang Dru</dd>
                            </dl>
                        </div>
                        <div class="col-3">
                            <dl class="row mb-0">
                                <dt class="col-12">Lifetime</dt>
                                <dd class="col-12">: 2.000</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">Max Lifetime</dt>
                                <dd class="col-12">: 4.000</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-content-information mb-2">
                <div class="header">
                    NEW ASSY TOOL INFORMATION
                </div>
                <div class="body">
                    <div class="row w-100">
                        <div class="col-4">
                            <dl class="row mb-0">
                                <dt class="col-12">Assy ID</dt>
                                <dd class="col-12">: 1.20.01.23.00001</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">QR Code Holder</dt>
                                <dd class="col-12">: 1.JC547.23.016;12001</dd>
                            </dl>
                        </div>
                        <div class="col-4">
                            <dl class="row mb-0">
                                <dt class="col-12">Start Installed</dt>
                                <dd class="col-12">: 11-12-2023 08:00</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">PIC Installed</dt>
                                <dd class="col-12">: Kang Dru</dd>
                            </dl>
                        </div>
                        <div class="col-4">
                            <dl class="row mb-0">
                                <dt class="col-12">Lifetime</dt>
                                <dd class="col-12">: 2.000</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">Max Lifetime</dt>
                                <dd class="col-12">: 4.000</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-content-information">
                <div class="header">
                    MACHINE INFORMATION
                </div>
                <div class="body">
                    <div class="row w-100">
                        <div class="col-4">
                            <dl class="row mb-0">
                                <dt class="col-12">Plant ID</dt>
                                <dd class="col-12">: P6</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">WCT ID</dt>
                                <dd class="col-12">: 1</dd>
                            </dl>
                        </div>
                        <div class="col-4">
                            <dl class="row mb-0">
                                <dt class="col-12">Asset No</dt>
                                <dd class="col-12">: 105000002448</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">Machine Name</dt>
                                <dd class="col-12">: OP10 Turning Center</dd>
                            </dl>
                        </div>
                        <div class="col-4">
                            <dl class="row mb-0">
                                <dt class="col-12">OP Name</dt>
                                <dd class="col-12">: 10</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">Communication</dt>
                                <dd class="col-12">: 192.168.1.10 - 8193</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="card-button" style="display: none">
            <div class="row">
                <div class="col-12">
                    <a href="{{route('pokayokestep1')}}" class="btn btn-save w-100">DONE</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- make preloader so it will not display grid-flow class --}}
<div class="preloadercont preloader">
    <div class="wrapper-loader">
       <div class="loader">
          <div class="dot"></div>
       </div>
       <div class="loader">
          <div class="dot"></div>
       </div>
       <div class="loader">
          <div class="dot"></div>
       </div>
       <div class="loader">
          <div class="dot"></div>
       </div>
       <div class="loader">
          <div class="dot"></div>
       </div>
       <div class="loader">
          <div class="dot"></div>
       </div>
    </div>
    <div class="text">
        Please wait, a new tool is being installed on the machine
    </div>
 </div>

{{-- Modal Scan Assy Tool --}}
<div class="modal fade" id="modal_scan" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan QR CODE</h5>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel me-1" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id=""><span>Save</span></button>
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
</script>
{{-- End JS Scane QR --}}

<script>
    $('#table_list_tool').floatThead({
        scrollContainer: function ($table) {
            return $table.closest('.card-table');
        }
    });
</script>

{{-- inisiate ajax to always check status in each 5 seconds --}}
<script>
    $(document).ready(function () {
        $(".preloader").show();
        

        // alert(id_list_machine + ' ' + id_assy_old + ' ' + id_assy_new + ' ' + tool_port)

        var interval = setInterval(function () {
            let id_list_machine = '{!! $id_list_machine !!}';
            let id_assy_old     = '{!! $id_assy_old !!}';
            let id_assy_new     = '{!! $id_assy_new !!}';
            let tool_port       = '{!! $tool_port !!}';

            // alert(id_list_machine + ' ' + id_assy_old + ' ' + id_assy_new + ' ' + tool_port)
            fetch("{{ route('pokayokestep5check') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: JSON.stringify({
                    id_list_machine: id_list_machine,
                    id_assy_old: id_assy_old,
                    id_assy_new: id_assy_new,
                    tool_port: tool_port
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.status && data.status_check) {
                    clearInterval(interval);
                    $(".preloader").hide();
                    $(".card-information").show();
                    $(".card-button").show();
                } else {
                    $(".preloader").show();
                    $(".card-information").hide();
                    $(".card-button").hide();
                }
            })
            .catch(error => {
                // Handle error here, e.g., show error message or retry
            });
        }, 5000);

    });
</script>

@stop