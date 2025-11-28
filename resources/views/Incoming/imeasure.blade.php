@extends('main')
@section('content')

<section>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-8">
                <p class="judul-menu"><i></i>Measure Data</p>
            </div>
            <div class="col-4">
                <div class="input-group style-search w-100">
                    <input type="text" id="qr_measure" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                    <button type="button" class="input-group-text" id="basic-addon2" data-name="input_measure"><i class="bi bi-qr-code"></i></button>
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
                        <th></th>
                    </tr>
                </thead>
                <tbody id="getAssyMeasure">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>1.20.01.23.001</td>
                            <td>1.JC547.23.016;12001</td>
                            <td>170.051 mm</td>
                            <td>10.060 mm</td>
                        </tr>
                    @endfor --}}
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Modal Measure --}}
<div class="modal fade" id="modal_measure" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Measure</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto mb-3">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Assy Tool</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="id_assy" value="1.20.01.23.001" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">QR Holder</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="qr_holder" value="1.JC547.23.016;12001" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="text-label col-4">QR Zoller</label>
                        <div class="col-8">
                            {{-- 1.70.RS002;4;;;;;;2;Reamer 10H8;;130.069;4.996;;;;;;;;;;;;;;;; --}}
                            <input type="text" class="form-control" id="qr_zoller" value="">
                        </div>
                    </div>
                </div>

                <div class="card-auto mb-3 p-0">
                    <div class="card-header-input">
                        Zoller Machine
                    </div>
                    <div class="card-body-input">
                        <div class="row">
                            <div class="col-6" style="border-right: 2px solid #565555">
                                <div class="d-flex flex-wrap justify-content-center">
                                    <span class="title-value">Z VALUE (mm)</span>
                                    {{-- 152.117 --}}
                                    <input type="text" readonly class="form-value" id="zoller_z_value" value="">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="d-flex flex-wrap justify-content-center">
                                    <span class="title-value">X VALUE (mm)</span>
                                    {{-- 5.008 --}}
                                    <input type="text" readonly class="form-value" id="zoller_x_value" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel me-1" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_zoller"><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Measure --}}

{{-- inisiasi data --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        getAssyMeasure();
    });

    const getAssyMeasure = () => {

        fetch("{{route('getassymeasure')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                // id: id
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
                let html = '';
                for (let i = 0; i < row.length; i++) {
                    html += '<tr>';
                    html += '<td>' + (i + 1) + '</td>';
                    html += '<td>' + row[i].id_assy + '</td>';
                    html += '<td>' + row[i].holder_qr_code + '</td>';
                    html += '<td>' + row[i].zoller_z_value + '</td>';
                    html += '<td>' + row[i].zoller_x_value + '</td>';
                    html += '</tr>';
                }
                document.getElementById('getAssyMeasure').innerHTML = html;
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

{{-- JS Measure --}}
<script>
    $(document).on("change", "#qr_measure", function (e) {
        let qr_code = $(this).val();
        // get trx_assy from qr_code_holder
        fetch("{{route('trxassybyqrholder')}}", {
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
            console.log(data.arr)
            if(data.status){
                let trx_assy = data.arr.id_assy;
                let qr_holder = data.arr.holder_qr_code;
                let zoller_z_value = data.arr.zoller_z_value;
                let zoller_x_value = data.arr.zoller_x_value;

                console.log(trx_assy);

                $("#id_assy").val(trx_assy);
                $("#qr_holder").val(qr_holder);
                $("#zoller_z_value").val(zoller_z_value);
                $("#zoller_x_value").val(zoller_x_value);
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

        $("#modal_measure").modal('show');
    });

</script>
{{-- End Measure --}}

{{-- parse zoller qrcode to data --}}
<script>
    $(document).on("change", "#qr_zoller", function (e) {
        var dummyZoller = '1.70.RS002;4;;;;;;2;Reamer 10H8;;130.069;4.996;;;;;;;;;;;;;;;;';//jangan dihapus buat testing
        let qr_code     = $(this).val();
        let arr_qr      = qr_code.split(';');
        let z_value     = arr_qr[10];
        let x_value     = arr_qr[11];

        $("#zoller_z_value").val(z_value);
        $("#zoller_x_value").val(x_value);
    });
</script>

{{-- save zoller --}}
<script>
    $(document).on("click", "#save_zoller", function (e) {
        let qr_holder   = $("#qr_holder").val();
        let qr_zoller   = $("#qr_zoller").val();
        let z_value     = $("#zoller_z_value").val();
        let x_value     = $("#zoller_x_value").val();
        let id_assy     = $("#id_assy").val();

        // check if qr zoller is empty
        if(qr_zoller == '' || z_value == '' || x_value == ''){
            Swal.fire({
                position:'center',
                title: 'Failed!',
                text: 'Please Scan Zoller, Then Enter !',
                icon: 'error',
                showConfirmButton: false,
                timer: 2000
            });
            return;
        }

        fetch("{{route('savezoller')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                qr_holder: qr_holder,
                qr_zoller: qr_zoller,
                z_value: z_value,
                x_value: x_value,
                id_assy: id_assy
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
                Swal.fire({
                    position:'center',
                    title: 'Success!',
                    text: data.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                $("#modal_measure").modal('hide');
                getAssyMeasure();
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
