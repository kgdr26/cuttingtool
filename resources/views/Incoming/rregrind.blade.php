@extends('main')
@section('content')

<section>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-8">
                <p class="judul-menu"><i></i>Cutting Tool Regrinding</p>
            </div>
            <div class="col-4">
                <div class="input-group style-search w-100">
                    <input type="text" id="scan_qr" class="form-control" placeholder="Scan QR" aria-describedby="basic-addon2" data-name="val_qr">
                    <button type="button" class="input-group-text" id="basic-addon2" data-name="action_scane"><i class="bi bi-qr-code"></i></button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>PART NO</th>
                        <th>QR CODE</th>
                        {{-- <th>ENGINEERING NO</th> --}}
                        {{-- <th>HES NO</th> --}}
                        <th>SPESIFICATION</th>
                        <th>TYPE</th>
                        <th>MAKER</th>
                        <th>MATERIAL</th>
                        <th>MARKING PROGRAM</th>
                        <th>ALREADY REGRIN</th>
                        <th>MAX REGRIND</th>
                        <th>STATUS</th>
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody id="dataregrind">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>08-91-00137</td>
                            <td>-</td>
                            <td>IN-5JC547</td>
                            <td>IN-5JC547 HOLDER C4-PSSNL-27042-12 SANDVIK</td>
                            <td>CAPTO</td>
                            <td>SANDVIK</td>
                            <td>ST</td>
                            <td>0000</td>
                            <td>8</td>
                            <td>10</td>
                            <td>
                                <div class="card-status st-{{$i}}"></div>
                            </td>
                        </tr>
                    @endfor --}}
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Modal Start Regrind --}}
<div class="modal fade" id="modal_start_regrind" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Start Regrinding Tool</h5>
                <input type="text" id="id_trx_regrind">
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
                                    <dd class="col-12" id="material">: ST</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MARKING PROGRAM</dt>
                                    <dd class="col-12" id="marking_program">: 0000</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">MAX REGRIND</dt>
                                    <dd class="col-12" id="max_regrind">: 10</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-auto mb-3">
                    <div class="row">
                        <label for="" class="text-label col-4">Machine Regrinding</label>
                        <div class="col-8">
                            <select class="form-select select-2-start-regrind" name="" id="">
                                <option value="0">-- select Machine --</option>
                                @forelse ($machine_regrind as $key => $row)
                                    <option value="{{$row->id}}">{{$row->machine_regrind}}</option>
                                @empty
                                    <option value="0">-- Machine Not Found --</option>                                    
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="start_regrind"><span>Start</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Start Regrind --}}

{{-- Modal Stop Regrind --}}
<div class="modal fade" id="modal_stop_regrind" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stop Regrinding Tool</h5>
                <input type="text" id="dimension">
                <input type="text" id="inspection_record">
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
                                    <dd class="col-12" id="stop_part_no" ></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">ENGINEERING NO</dt>
                                    <dd class="col-12" id="stop_engineering_no"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">HES NO</dt>
                                    <dd class="col-12" id="stop_hes_no"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">SPESIFICATION</dt>
                                    <dd class="col-12" id="stop_spesification"></dd>
                                </dl>
                            </div>
                            <div class="col-6">
                                <dl class="row mb-0">
                                    <dt class="col-12">TYPE</dt>
                                    <dd class="col-12" id="stop_tool_type"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MATERIAL</dt>
                                    <dd class="col-12" id="stop_material"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MARKING PROGRAM</dt>
                                    <dd class="col-12" id="stop_marking_program"></dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">MAX REGRIND</dt>
                                    <dd class="col-12" id="stop_max_regrind"></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="card-auto mb-3">
                            <table class="table table-bordered mb-0">
                                <thead class="thead-insp">
                                    <tr>
                                        <th scope="col" class="text-center">LOG NO</th>
                                        <th scope="col" class="text-center">DESCRIPTION</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-insp">
                                    <tr>
                                        <td class="fw-bold">ENG. NO</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">QR Code</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-auto position-relative">
                            <div class="card-foto">
                                <img src="{{asset('assets/images/default.svg')}}" alt="user avatar" id="img_add_insp">
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-auto">
                            <table class="table table-bordered mb-0" id="table_inspection_record">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel me-1" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="stop_regrind"><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Stop Regrind --}}

{{-- Modal Check QC Regrind --}}
<div class="modal fade" id="modal_check_qc_regrind" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Check QC Regrinding Tool</h5>
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
                                    <dd class="col-12" id="qc_part_no"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">ENGINEERING NO</dt>
                                    <dd class="col-12" id="qc_engineering_no" ></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">HES NO</dt>
                                    <dd class="col-12" id="qc_hes_no"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">SPESIFICATION</dt>
                                    <dd class="col-12" id="qc_spesification"></dd>
                                </dl>
                            </div>
                            <div class="col-6">
                                <dl class="row mb-0">
                                    <dt class="col-12">TYPE</dt>
                                    <dd class="col-12" id="qc_tool_type"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MATERIAL</dt>
                                    <dd class="col-12" id="qc_material"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MARKING PROGRAM</dt>
                                    <dd class="col-12" id="qc_marking_program"></dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">MAX REGRIND</dt>
                                    <dd class="col-12" id="qc_max_regrind"></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="card-auto mb-3">
                            <table class="table table-bordered mb-0">
                                <thead class="thead-insp">
                                    <tr>
                                        <th scope="col" class="text-center">LOG NO</th>
                                        <th scope="col" class="text-center">DESCRIPTION</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-insp">
                                    <tr>
                                        <td class="fw-bold">ENG. NO</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">CODE</td>
                                        <td>NC012.23.00017</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-auto position-relative">
                            <div class="card-foto">
                                <img src="{{asset('assets/images/default.svg')}}" alt="user avatar" id="img_add_insp">
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-auto">
                            <table class="table table-bordered mb-0" id="table_inspection_record_check">
                                {{-- <thead class="thead-insp">
                                    <tr>
                                        <th scope="col" colspan="3" class="text-center">Dimension</th>
                                        <th scope="col" class="text-center">00</th>
                                        @for($i = 1; $i <= 10; $i++)
                                            <th scope="col" class="text-center">{{sprintf("%02d", $i);}}</th>
                                        @endfor
                                    </tr>
                                </thead>
                            <tbody class="tbody-insp">
                                @for($k = 1; $k <= 9; $k++)
                                    <tr>
                                        <td class="text-center">D{{$k}}</td>
                                        <td class="text-center">⌀0,1</td>
                                        <td class="text-center">±0,05</td>
                                        <td class="text-center">0,04</td>
                                        @for($i = 1; $i <= 10; $i++)
                                            <td class="text-center"><input type="text" class="form-control-td"></td>
                                        @endfor
                                    </tr>
                                @endfor
                            </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel me-1" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_qc"><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Check QC Regrind --}}

{{-- dataregrind --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getRegrind();
    });

    const getRegrind = () => {

        fetch("{{route('getregrind')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            let html = '';
            if(data.arr.length === 0){
                html += `
                    <tr>
                        <td colspan="13" class="text-center">No Data</td>
                    </tr>
                `;
            }else {
                for (let i = 0; i < data.arr.length; i++) {
                    html += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${data.arr[i].part_no}</td>
                            <td>${data.arr[i].qr_code}</td>
                            <td>${data.arr[i].spesification}</td>
                            <td>${data.arr[i].tool_type}</td>
                            <td>${data.arr[i].maker_name}</td>
                            <td>${data.arr[i].material_type}</td>
                            <td>${data.arr[i].marking}</td>
                            <td>${data.arr[i].total_regrind_indexing}</td>
                            <td>${data.arr[i].max_regrind}</td>
                            <td>
                                <div class="card-status st-${data.arr[i].status + 1}"></div>
                            </td>
                        </tr>
                    `;
                }
            }

            document.getElementById('dataregrind').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
    }
</script>

{{-- on enter scan_qr --}}
<script>
    document.getElementById('scan_qr').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            let scan_qr = $(this).val();
            checkQR(scan_qr);
        }
    });

    const checkQR = (scan_qr) => {
        fetch("{{route('checkregrindstatus')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({qr_code: scan_qr})
        })
        .then(response => response.json())
        .then(data => {
            if(data.status){
                let status = data.arr.status;
                document.getElementById('id_trx_regrind').value = data.arr.id;
                if(status == 0){
                    startRegrind(scan_qr);
                    // $("#modal_start_regrind").modal('show');
                }else if(status == 1){
                    stopRegrind(scan_qr);
                    // $("#modal_stop_regrind").modal('show');
                }else if(status == 2){
                    checkQCRegrind(scan_qr);
                    // $("#modal_check_qc_regrind").modal('show');
                }
            }else {
                swal.fire({
                    title: 'Error',
                    text: 'QR Code Not Found',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

{{-- start regrind --}}
<script>
    const startRegrind = (qr_code) => {
        
        fetch("{{route('toolbyqr')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({qr_code: qr_code})
        })
        .then(response => response.json())
        .then(data => {
            if(data.status){
                let row = data.arr[0];
                // set value modal start regrind
                document.getElementById('part_no').innerHTML = ': ' + row.part_no;
                document.getElementById('engineering_no').innerHTML = ': ' + row.engineering_no;
                document.getElementById('hes_no').innerHTML = ': ' + row.hes_no;
                document.getElementById('spesification').innerHTML = ': ' + row.spesification;
                document.getElementById('tool_type').innerHTML = ': ' + row.tool_type;
                document.getElementById('material').innerHTML = ': ' + row.material_type;
                document.getElementById('marking_program').innerHTML = ': ' + row.marking;
                document.getElementById('max_regrind').innerHTML = ': ' + row.max_regrind;
                $("#modal_start_regrind").modal('show');

            }else {
                swal.fire({
                    title: 'Error',
                    text: 'Start Regrind Failed',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
{{-- click start regrind --}}
<script>
    document.getElementById('start_regrind').addEventListener('click', function() {
        let id_trx_regrind      = document.getElementById('id_trx_regrind').value;
        let machine_regrind     = document.querySelector('.select-2-start-regrind').value;
        let qr_code             = document.getElementById('scan_qr').value;

        if(machine_regrind == 0){
            swal.fire({
                title: 'Error',
                text: 'Please Select Machine Regrind',
                icon: 'error',
                confirmButtonText: 'OK',
                timer: 1500
            });
        }else {
            fetch("{{route('startregrind')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: JSON.stringify({
                    id_trx_regrind: id_trx_regrind, 
                    machine_regrind: machine_regrind,
                    qr_code: qr_code
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.status){
                    swal.fire({
                        title: 'Success',
                        text: 'Start Regrind Success',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 1500
                    });
                    getRegrind();
                    $("#modal_start_regrind").modal('hide');
                }else {
                    swal.fire({
                        title: 'Error',
                        text: 'Start Regrind Failed',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        timer: 1500
                    });
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
</script>

{{-- stop regrind --}}
<script>
    const stopRegrind = (qr_code) => {
        // show modal stop regrind
        fetch("{{route('toolbyqr')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({qr_code: qr_code})
        })
        .then(response => response.json())
        .then(data => {
            if(data.status){
                let row = data.arr[0];
                // set value modal start regrind
                document.getElementById('stop_part_no').innerHTML = ': ' + row.part_no;
                document.getElementById('stop_engineering_no').innerHTML = ': ' + row.engineering_no;
                document.getElementById('stop_hes_no').innerHTML = ': ' + row.hes_no;
                document.getElementById('stop_spesification').innerHTML = ': ' + row.spesification;
                document.getElementById('stop_tool_type').innerHTML = ': ' + row.tool_type;
                document.getElementById('stop_material').innerHTML = ': ' + row.material_type;
                document.getElementById('stop_marking_program').innerHTML = ': ' + row.marking;
                document.getElementById('stop_max_regrind').innerHTML = ': ' + row.max_regrind;
                $('#modal_stop_regrind').modal('show');

            }else {
                swal.fire({
                    title: 'Error',
                    text: 'Start Regrind Failed',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
            }
        })
        .catch(error => console.error('Error:', error));

        // detail record inspection
        fetch("{{route('inspectionrecordbyqr')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({qr_code: qr_code})
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if(data.status){
                let html = '';
                let jml_regrind = data.arr.max_regrind;
                
                html += `
                    <table class="table table-bordered mb-0">
                        <thead class="thead-insp">
                            <tr>
                                <th scope="col" colspan="3" class="text-center">Dimension</th>
                                <th scope="col" class="text-center">00</th>
                `;
                for (let i = 1; i <= jml_regrind; i++) {
                    html += `
                        <th scope="col" class="text-center">` + i.toString().padStart(2, '0') + `</th>

                    `;
                }
                // close thead
                html += `
                    </tr>
                        </thead>
                        <tbody class="tbody-insp" id="tbody_insp_add">
                `;
                let tabledata   = JSON.parse(data.arr.json_dimension)
                let record      = JSON.parse(data.arr.json_inspection_record);

                // write to id dimension and inspection record
                document.getElementById('dimension').value          = data.arr.json_dimension;
                document.getElementById('inspection_record').value  = data.arr.json_inspection_record;
                let max_regrind = data.arr.max_regrind;
                    tabledata.forEach((item, index) => {
                        // console.log(item);
                        for (let i = 0; i < item.length; i++) {
                            html += `
                                <td class="text-center">${item[i]}</td>
                            `;
                        }

                        for (let i = 0; i < record.length; i++) {
                            html += `
                                <td class="text-center">
                                    <input type="number" class="form-control-td" value="${record[i][index]}">
                                </td>
                            `;
                        }
                        for (let i = 0; i < (parseInt(max_regrind) + 1 )- record.length; i++) {
                            if(i == 0){
                                html += `
                                    <td class="text-center">
                                        <input type="number" class="form-control-td">    
                                    </td>
                                `;
                            }else {
                                html += `
                                    <td class="text-center"></td>
                                `;
                            }
                        }
                        html += `
                            </tr>
                        `;
                    });

                // close tbody
                html += `
                        </tbody>
                    </table>
                `;

                document.getElementById('table_inspection_record').innerHTML = html;



            
            }else {
                swal.fire({
                    title: 'Error',
                    text: 'Start Regrind Failed',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

<script>
    // Get all elements with the specified class
    var inputs = document.getElementsByClassName('form-control-td');
    
    // Loop through each input element
    for (var i = 0; i < inputs.length; i++) {
        // Add an input event listener to each input element
        inputs[i].addEventListener('input', function() {
            // Remove non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }
</script>

{{-- JS Select2 --}}
<script>
    $(".select-2-start-regrind").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_start_regrind')
    });

    $(".select-2-edit").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_edit')
    });
</script>
{{-- End JS Select2 --}}

{{-- stop regrind --}}
<script>
    document.getElementById('stop_regrind').addEventListener('click',function (){
        var tableData   = [];
        var table       = document.getElementById('tbody_insp_add');
        var qr_code     = document.getElementById('scan_qr').value;

        for (var i = 0, row; row = table.rows[i]; i++) {
            var rowData = [];
            for (var j = 0, col; col = row.cells[j]; j++) {
                var input = col.querySelector('input');
                if(input){
                    rowData.push(input.value);
                }
            }
            tableData.push(rowData);
        }

        var dimension           = document.getElementById('dimension').value;
        var id_trx_regrind      = document.getElementById('id_trx_regrind').value;

        fetch("{{route('stopregrind')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                qr_code: qr_code,
                dimension: dimension,
                id_trx_regrind: id_trx_regrind,
                inspection_record: tableData
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if(data.status){
                swal.fire({
                    title: 'Success',
                    text: 'Stop Regrind Success',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
                getRegrind();
                $("#modal_stop_regrind").modal('hide');
            }else {
                swal.fire({
                    title: 'Error',
                    text: 'Stop Regrind Failed',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
            }
        })
        .catch(error => console.error('Error:', error));

    })
</script>

{{-- qc Check --}}
<script>
    const checkQCRegrind = (qr_code) => {
        fetch("{{route('toolbyqr')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({qr_code: qr_code})
        })
        .then(response => response.json())
        .then(data => {
            if(data.status){
                let row = data.arr[0];
                // set value modal start regrind
                document.getElementById('qc_part_no').innerHTML = ': ' + row.part_no;
                document.getElementById('qc_engineering_no').innerHTML = ': ' + row.engineering_no;
                document.getElementById('qc_hes_no').innerHTML = ': ' + row.hes_no;
                document.getElementById('qc_spesification').innerHTML = ': ' + row.spesification;
                document.getElementById('qc_tool_type').innerHTML = ': ' + row.tool_type;
                document.getElementById('qc_material').innerHTML = ': ' + row.material_type;
                document.getElementById('qc_marking_program').innerHTML = ': ' + row.marking;
                document.getElementById('qc_max_regrind').innerHTML = ': ' + row.max_regrind;

                $('#modal_check_qc_regrind').modal('show');

            }else {
                swal.fire({
                    title: 'Error',
                    text: 'Start Regrind Failed',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
            }
        })
        .catch(error => console.error('Error:', error));

        // detail record inspection
        fetch("{{route('inspectionrecordbyqr')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({qr_code: qr_code})
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if(data.status){
                let html = '';
                let jml_regrind = data.arr.max_regrind;
                
                html += `
                    <table class="table table-bordered mb-0">
                        <thead class="thead-insp">
                            <tr>
                                <th scope="col" colspan="3" class="text-center">Dimension</th>
                                <th scope="col" class="text-center">00</th>
                `;
                for (let i = 1; i <= jml_regrind; i++) {
                    html += `
                        <th scope="col" class="text-center">` + i.toString().padStart(2, '0') + `</th>

                    `;
                }
                // close thead
                html += `
                    </tr>
                        </thead>
                        <tbody class="tbody-insp" id="tbody_insp_add_check">
                `;
                let tabledata   = JSON.parse(data.arr.json_dimension)
                let record      = JSON.parse(data.arr.json_inspection_record);

                // write to id dimension and inspection record
                document.getElementById('dimension').value          = data.arr.json_dimension;
                document.getElementById('inspection_record').value  = data.arr.json_inspection_record;
                let max_regrind = data.arr.max_regrind;
                    tabledata.forEach((item, index) => {
                        // console.log(item);
                        for (let i = 0; i < item.length; i++) {
                            html += `
                                <td class="text-center">${item[i]}</td>
                            `;
                        }

                        for (let i = 0; i < record.length; i++) {
                            html += `
                                <td class="text-center">
                                    <input type="number" class="form-control-td" value="${record[i][index]}">
                                </td>
                            `;
                        }
                        for (let i = 0; i < (parseInt(max_regrind) + 1 )- record.length; i++) {
                            if(i == 0){
                                html += `
                                    <td class="text-center">
                                        <input type="number" class="form-control-td">    
                                    </td>
                                `;
                            }else {
                                html += `
                                    <td class="text-center"></td>
                                `;
                            }
                        }
                        html += `
                            </tr>
                        `;
                    });

                // close tbody
                html += `
                        </tbody>
                    </table>
                `;

                document.getElementById('table_inspection_record_check').innerHTML = html;



            
            }else {
                swal.fire({
                    title: 'Error',
                    text: 'Start Regrind Failed',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
            }
        })
        .catch(error => console.error('Error:', error));

    }
</script>

{{-- click save regrind --}}
<script>
    document.getElementById('save_qc').addEventListener('click',function (){
        let id_trx_regrind      = document.getElementById('id_trx_regrind').value;
        let qr_code             = document.getElementById('scan_qr').value;

        fetch("{{route('qcregrind')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                qr_code: qr_code,
                id_trx_regrind: id_trx_regrind,
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if(data.status){
                swal.fire({
                    title: 'Success',
                    text: 'Stop Regrind Success',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
                getRegrind();
                $("#modal_check_qc_regrind").modal('hide');
            }else {
                swal.fire({
                    title: 'Error',
                    text: 'Stop Regrind Failed',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 1500
                });
            }
        })
        .catch(error => console.error('Error:', error));

    })
</script>

<script>
    document.addEventListener('click', function(event) {
        var modal = event.target.className;
        var idmodal = document.getElementById(event.target.id);
        if(modal === 'modal fade'){
            idmodal.style.display = "block";
            console.log(event.target.id);
        }
    });
</script>

@stop