@extends('main')
@section('content')

<section>
    <div class="main-card">
        <div class="card-old">
            <div class="card-action">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="flex-shrink-0">
                        <i class="icon-qr-label"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex justify-content-start">
                            <span class="text-lale-qr d-block">PLEASE SCAN QR OLD TOOL</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <input type="text" id="scan_old_tool" class="form-control qr-code">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-auto mb-3 p-0">
                <div class="card-header-input">
                    Information
                </div>
                <div class="card-body-input">
                    {{-- <div class="row">
                        <div class="col-4">
                            <dl class="row mb-0">
                                <dt class="col-12">WCT ID</dt>
                                <dd class="col-12">: P9CCA0</dd>
                            </dl>

                            <dl class="row mb-0">
                                <dt class="col-12">ASSET NO</dt>
                                <dd class="col-12">: 105000002448</dd>
                            </dl>
                        </div>
                        <div class="col-4">
                            <dl class="row mb-0">
                                <dt class="col-12">OP NAME</dt>
                                <dd class="col-12">: 10</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">Tool Port</dt>
                                <dd class="col-12">: 01</dd>
                            </dl>
                        </div>
                        <div class="col-4">
                            <dl class="row mb-0">
                                <dt class="col-12">MACHINE NAME</dt>
                                <dd class="col-12">: OP10 TURNING CENTER</dd>
                            </dl>
    
                            <dl class="row mb-0">
                                <dt class="col-12">PIC</dt>
                                <dd class="col-12">: EDI RUMPOKO</dd>
                            </dl>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <p class="judul-menu"><i></i>Assy Tool Information</p>
                </div>

                <div class="col-6">
                    <div class="d-flex justify-content-end">
                        <div class="card-no-assy">1.20.01.23.001</div>
                    </div>
                </div>
            </div>

            <div class="card-auto p-0 mb-3">
                <div class="card-header-asyy">
                    <div class="row">
                        <div class="col-1">

                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="col-4 text-center">
                                    CUTTING TOOL
                                </div>
                                <div class="col-4 text-center">
                                    QR CODE
                                </div>
                                <div class="col-2 text-center">
                                    LIFETIME
                                </div>
                                <div class="col-2 text-center">
                                    MAX LIFETIME
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body-asyy-1 old">
                    <div class="row">
                        <div class="col-1">
                            <div class="card-icon-assy-1">
                                <i class="icon-form-tool"></i>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="card-content-assy-1 old">
                                @for($i = 1; $i <= 10; $i++)
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <input type="text" class="form-control assy" value="Single Edged Square BT" disabled>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                                <span class="input-group-text assy" id=""><i class="bi bi-qr-code-scan"></i></span>
                                                <input type="text" class="form-control assy" value="HN547.23.00001" disabled>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control assy" value="2.000" disabled>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control assy" value="4.000" disabled>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-auto p-0 mb-3">
                <div class="card-header-asyy">
                    <div class="row">
                        <div class="col-1">

                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="col-4 text-center">
                                    HOLDER
                                </div>
                                <div class="col-4 text-center">
                                    QR CODE
                                </div>
                                <div class="col-2 text-center">
                                    LIFETIME
                                </div>
                                <div class="col-2 text-center">
                                    MAX LIFETIME
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body-asyy-2">
                    <div class="row">
                        <div class="col-1">
                            <div class="card-content-assy-2">
                                <i class="icon-form-holder"></i>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="card-content-assy-2">
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control assy" value="Single Edged Square BT" disabled>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <span class="input-group-text assy" id=""><i class="bi bi-qr-code-scan"></i></span>
                                            <input type="text" class="form-control assy" value="HN547.23.00001" disabled>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control assy" value="2.000" disabled>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control assy" value="4.000" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-auto p-0 mb-2">
                <div class="card-header-asyy">
                    <div class="row">
                        <div class="col-1">

                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="col-4 text-center">
                                    ACCESSORIES
                                </div>
                                <div class="col-4 text-center">
                                    QR CODE
                                </div>
                                <div class="col-2 text-center">
                                    LIFETIME
                                </div>
                                <div class="col-2 text-center">
                                    MAX LIFETIME
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body-asyy-1 old">
                    <div class="row">
                        <div class="col-1">
                            <div class="card-content-assy-1">
                                <div class="card-icon-assy-1">
                                    <i class="icon-form-accesories"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="card-content-assy-1 old">
                                @for($i = 1; $i <= 10; $i++)
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <input type="text" class="form-control assy" value="Single Edged Square BT" disabled>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                                <span class="input-group-text assy" id=""><i class="bi bi-qr-code-scan"></i></span>
                                                <input type="text" class="form-control assy" value="HN547.23.00001" disabled>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control assy" value="2.000" disabled>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control assy" value="4.000" disabled>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-new">
            <div class="card-action">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="flex-shrink-0">
                        <i class="icon-qr-label"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex justify-content-start">
                            <span class="text-lale-qr d-block">PLEASE SCAN QR NEW TOOL</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <input type="text" class="form-control qr-code">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <p class="judul-menu"><i></i>Assy Tool Information</p>
                </div>

                <div class="col-6">
                    <div class="d-flex justify-content-end">
                        <div class="card-no-assy">1.20.01.23.001</div>
                    </div>
                </div>
            </div>

            <div class="card-auto p-0 mb-3">
                <div class="card-header-asyy">
                    <div class="row">
                        <div class="col-1">

                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="col-4 text-center">
                                    CUTTING TOOL
                                </div>
                                <div class="col-4 text-center">
                                    QR CODE
                                </div>
                                <div class="col-2 text-center">
                                    LIFETIME
                                </div>
                                <div class="col-2 text-center">
                                    MAX LIFETIME
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body-asyy-1">
                    <div class="row">
                        <div class="col-1">
                            <div class="card-icon-assy-1">
                                <i class="icon-form-tool"></i>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="card-content-assy-1">
                                @for($i = 1; $i <= 10; $i++)
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <input type="text" class="form-control assy" value="Single Edged Square BT" disabled>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                                <span class="input-group-text assy" id=""><i class="bi bi-qr-code-scan"></i></span>
                                                <input type="text" class="form-control assy" value="HN547.23.00001" disabled>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control assy" value="2.000" disabled>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control assy" value="4.000" disabled>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-auto p-0 mb-3">
                <div class="card-header-asyy">
                    <div class="row">
                        <div class="col-1">

                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="col-4 text-center">
                                    HOLDER
                                </div>
                                <div class="col-4 text-center">
                                    QR CODE
                                </div>
                                <div class="col-2 text-center">
                                    LIFETIME
                                </div>
                                <div class="col-2 text-center">
                                    MAX LIFETIME
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body-asyy-2">
                    <div class="row">
                        <div class="col-1">
                            <div class="card-content-assy-2">
                                <i class="icon-form-holder"></i>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="card-content-assy-2">
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control assy" value="Single Edged Square BT" disabled>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <span class="input-group-text assy" id=""><i class="bi bi-qr-code-scan"></i></span>
                                            <input type="text" class="form-control assy" value="HN547.23.00001" disabled>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control assy" value="2.000" disabled>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control assy" value="4.000" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-auto p-0 mb-2">
                <div class="card-header-asyy">
                    <div class="row">
                        <div class="col-1">

                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="col-4 text-center">
                                    ACCESSORIES
                                </div>
                                <div class="col-4 text-center">
                                    QR CODE
                                </div>
                                <div class="col-2 text-center">
                                    LIFETIME
                                </div>
                                <div class="col-2 text-center">
                                    MAX LIFETIME
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body-asyy-1">
                    <div class="row">
                        <div class="col-1">
                            <div class="card-content-assy-1">
                                <div class="card-icon-assy-1">
                                    <i class="icon-form-accesories"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-11">
                            <div class="card-content-assy-1">
                                @for($i = 1; $i <= 10; $i++)
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <input type="text" class="form-control assy" value="Single Edged Square BT" disabled>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group">
                                                <span class="input-group-text assy" id=""><i class="bi bi-qr-code-scan"></i></span>
                                                <input type="text" class="form-control assy" value="HN547.23.00001" disabled>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control assy" value="2.000" disabled>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control assy" value="4.000" disabled>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-save w-100">SEND TO RTU LINE</button>
        </div>
    </div>
</section>

<script>
    $('#table_list_tool').floatThead({
        scrollContainer: function ($table) {
            return $table.closest('.card-table');
        }
    });
</script>

{{-- scan old tool --}}
<script>
	document.getElementById('scan_old_tool').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            let scan_old_tool = document.getElementById('scan_old_tool').value;
            if (scan_old_tool === '') {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: 'Please Scan QR Holder',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                let scan_old_tool = document.getElementById('scan_old_tool').value;
				
				fetch("{{route('trxassybyqrholder')}}", {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
					},
					body: JSON.stringify({
						qr_code: scan_old_tool
					})
				})
				.then(response => response.json())
				.then(data => {
					console.log(data);
				})
				.catch(error => console.error('Error:', error)
				);

			}
        }
    });
</script>

@stop