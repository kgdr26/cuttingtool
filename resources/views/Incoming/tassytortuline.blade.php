@extends('main')
@section('content')

<section>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-8">
                <p class="judul-menu"><i></i>Send Assy To RTU Line</p>
            </div>
            <div class="col-4">
                <div class="input-group style-search w-100">
                    <input type="text" class="form-control" id="scan_qr_holder" placeholder="Scan QR Holder" aria-describedby="basic-addon2">
                    <button type="button" class="input-group-text" id="basic-addon2" data-name="send_rtu_line"><i class="bi bi-qr-code"></i></button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ASSY TOOL</th>
                        <th>QR HOLDER</th>
                        <th>Z VALUE</th>
                        <th>X VALUE</th>
                        <th>STATUS</th>
                        <th>ACTUAL LIFETIME</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tortuline">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>1.20.01.23.001</td>
                            <td>1.JC547.23.016;12001</td>
                            <td>170.051 mm</td>
                            <td>10.060 mm</td>
                            <td>
                                <div class="card-status st-1"></div>
                            </td>
                            <td>2.000</td>
                        </tr>
                    @endfor --}}
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Modal Send RTU LINE --}}
<div class="modal fade" id="modal_send_rtu_line" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send To RTU Line</h5>
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
                                    <dt class="col-12">Assy Tool</dt>
                                    <dd class="col-12" id="id_assy">: 1.20.01.23.001</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">Z Value</dt>
                                    <dd class="col-12" id="zoller_z_value">: 170.051 mm	</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">Actual Lifetime</dt>
                                    <dd class="col-12" id="actual_lifetime">: 0</dd>
                                </dl>
        
                            </div>
                            <div class="col-6">
                                <dl class="row mb-0">
                                    <dt class="col-12">QR Holder</dt>
                                    <dd class="col-12" id="holder_qr_code">: 1.JC547.23.016;12001</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">X Value</dt>
                                    <dd class="col-12" id="zoller_x_value">: 10.060 mm</dd>
                                </dl>        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="send_rtu_line"><span>Send</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Send RTU LINE --}}

{{-- initiate data --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        getTortuLine();
    });

    const getTortuLine = () => {
        fetch("{{route('gettortuline')}}", {
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
                // document.getElementById('tortuline').innerHTML = data.arr;
                let html = '';

                if(data.arr.data.length === 0) {
                    html += `
                        <tr>
                            <td colspan="8" class="text-center">No Data</td>
                        </tr>
                    `;
                }
                
                data.arr.data.forEach((item, index) => {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.id_assy}</td>
                            <td>${item.holder_qr_code}</td>
                            <td>${item.zoller_z_value}</td>
                            <td>${item.zoller_x_value}</td>
                            <td>
                                <div class="card-status st-${item.id_location}"></div>
                            </td>
                            <td>${item.actual_lifetime}</td>
                            <td></td>
                        </tr>
                    `;
                });

                document.getElementById('tortuline').innerHTML = html;
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

{{-- onenter scan_qr_holder --}}
<script>
    document.getElementById('scan_qr_holder').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            let qr_holder = document.getElementById('scan_qr_holder').value;
            if (qr_holder === '') {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: 'QR Holder cannot be empty!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                fetch("{{route('gettortuline')}}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({qr_holder: qr_holder})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.arr.status) {
                        let row = data.arr.data;
                        let id_assy = row.id_assy;
                        let zoller_z_value = row.zoller_z_value;
                        let zoller_x_value = row.zoller_x_value;
                        let holder_qr_code = row.holder_qr_code;
                        let actual_lifetime = row.actual_lifetime;

                        document.getElementById('id_assy').innerHTML = `: ${id_assy}`;
                        document.getElementById('id_assy').value = id_assy;
                        document.getElementById('zoller_z_value').innerHTML = `: ${zoller_z_value}`;
                        document.getElementById('actual_lifetime').innerHTML = `: ${actual_lifetime}`;
                        document.getElementById('holder_qr_code').innerHTML = `: ${holder_qr_code}`;
                        document.getElementById('zoller_x_value').innerHTML = `: ${zoller_x_value}`;

                        // show modal
                        $("#modal_send_rtu_line").modal('show');
                    } else {
                        Swal.fire({
                            position:'center',
                            title: 'Failed!',
                            text: data.arr.message,
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
        }
    });
</script>

{{-- JS Send RTU LINE --}}
<script>
    $(document).on("click", "[data-name='send_rtu_line']", function (e) {
        let qr_holder = document.getElementById('scan_qr_holder').value;
        if (qr_holder === '') {
            Swal.fire({
                position:'center',
                title: 'Failed!',
                text: 'QR Holder cannot be empty!',
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            fetch("{{route('gettortuline')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: JSON.stringify({qr_holder: qr_holder})
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                if (data.arr.status) {
                    let row = data.arr.data;
                    let id_assy = row.id_assy;
                    let zoller_z_value = row.zoller_z_value;
                    let zoller_x_value = row.zoller_x_value;
                    let holder_qr_code = row.holder_qr_code;
                    let actual_lifetime = row.actual_lifetime;

                    document.getElementById('id_assy').innerHTML = `: ${id_assy}`;
                    document.getElementById('zoller_z_value').innerHTML = `: ${zoller_z_value}`;
                    document.getElementById('actual_lifetime').innerHTML = `: ${actual_lifetime}`;
                    document.getElementById('holder_qr_code').innerHTML = `: ${holder_qr_code}`;
                    document.getElementById('zoller_x_value').innerHTML = `: ${zoller_x_value}`;

                    // show modal
                    $("#modal_send_rtu_line").modal('show');
                } else {
                    Swal.fire({
                        position:'center',
                        title: 'Failed!',
                        text: data.arr.message,
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

{{-- clcik send rtu line --}}
<script>
    document.getElementById('send_rtu_line').addEventListener('click', function () {
        let id_assy = document.getElementById('id_assy').value;
        if (id_assy === '') {
            Swal.fire({
                position:'center',
                title: 'Failed!',
                text: 'QR Holder cannot be empty!',
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            fetch("{{route('sendrtuline')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: JSON.stringify({id_assy: id_assy})
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
                    getTortuLine();
                    $("#modal_send_rtu_line").modal('hide');
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

{{-- End JS Send RTU LINE --}}


@stop