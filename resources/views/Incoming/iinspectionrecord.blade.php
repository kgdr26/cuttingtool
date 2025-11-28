@extends('main')
@section('content')

<section>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-8">
                <p class="judul-menu"><i></i>Inspection Record Cutting Tool</p>
            </div>
            <div class="col-4">
                <div class="input-group style-search w-100">
                    <input type="text" id="search_inspection_record" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                    <button type="button" class="input-group-text" id="basic-addon2" data-name="inspection_record"><i class="bi bi-qr-code"></i></button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>QR CODE</th>
                        <th>SPESIFICATION</th>
                        <th>CUTTING TOOL TYPE</th>
                        <th>MATERIAL</th>
                        <th>MARKING PROGRAM</th>
                        <th>REPLACEMENT</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="getinspectionrecord">
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Modal Inpection Record --}}
<div class="modal fade" id="modal_inspection_record" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inspection Record</h5>
                <input type="hidden" id="id_regrind_inspection_record">
            </div>
            <div class="modal-body">
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
                                        <td class="fw-bold">QR CODE</td>
                                        <td id="qr_code"></td>
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
                            <table class="table table-bordered mb-0">
                                <thead class="thead-insp" id="thead_insp">
                                </thead>
                            <tbody class="tbody-insp" id="tbody_insp">
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel me-1" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_inspection_record"><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Inspection Record --}}

{{-- initiate data --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // initiate data
        getInspectionRecord();
    });

    const getInspectionRecord = () => {
        fetch("{{route('getinspectionrecord')}}",{
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
            document.getElementById('getinspectionrecord').innerHTML = data.arr;
            if(data.arr == ''){
                document.getElementById('getinspectionrecord').innerHTML = `<tr><td colspan="8" class="text-center">No Data Available !</td></tr>`;
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
    $(document).on("keypress", "#search_inspection_record", function (e) {
        let qr_code = document.getElementById('search_inspection_record').value;
        alert(qr_code)
        if (e.key === 'Enter') {
            if(qr_code == '' || qr_code == null) {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: 'QR Code cannot be empty!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });

                return false;
            }

            fetch("{{route('searchinspectionrecord')}}",{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: JSON.stringify({
                    search: document.getElementById('search_inspection_record').value
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
                $("#modal_inspection_record").modal('show');

                $('#id_regrind_inspection_record').val(data.arr.isp.id);
                let status          = data.arr.status;
                let dimension       = JSON.parse(data.arr.isp.dimension);
                let max_regrind     = data.arr.isp.max_regrind;
                let data_ins        = [];

                // if(data.arr.isp.inspection_record != null){
                //     let data_ins        = JSON.parse(data.arr.isp.inspection_record);
                // }else {
                //     let data_ins        = [];
                // }
                let length_row      = dimension.length;
                let html_head       = '';
                let html_body       = '';
                console.log()

                if(status){
                    html_head += `<tr>`;
                    html_head += `<th scope="col" colspan="3" class="text-center">Dimension</th>
                                    <th scope="col" class="text-center">00</th>`;
                    for (let i = 0; i < max_regrind; i++) {
                        html_head += `<th scope="col" class="text-center">${(i+1).toString().padStart(2, '0')}</th>`;
                       
                    }
                    html_head += `</tr>`;

                    for (let i = 0; i < length_row; i++) {
                        let left_1 = dimension[i][0];
                        let left_2 = dimension[i][1];
                        let left_3 = dimension[i][2];
                        let nil    = data_ins[i];
                        html_body += `<tr>
                                        <td class="text-center">`+left_1+`</td>
                                        <td class="text-center">`+left_2+`</td>
                                        <td class="text-center">`+left_3+`</td>
                                        <td class="text-center"><input type="text" name="input_00[]" class="form-control-td" value=""></td>`;
                        for (let j = 0; j < max_regrind; j++) {
                            html_body += `<td class="text-center"><input type="text" class="form-control-td" disabled></td>`;
                        }
                        html_body += `</tr>`;
                    }
                    document.getElementById('thead_insp').innerHTML = html_head;
                    document.getElementById('tbody_insp').innerHTML = html_body;

                    // add image img_add_insp
                    let img_add_insp = document.getElementById('img_add_insp');
                    let base_url = '{{url("/")}}';
                    let path = '/image_inspection_record/';
                    img_add_insp.src = base_url + path + data.arr.isp.image;
                    img_add_insp.alt = data.arr.isp.qr_code;

                    // add qr_code
                    document.getElementById('qr_code').innerHTML = data.arr.tool.qr_code;


                    $("#modal_inspection_record").modal('show');

                }else{
                    // Swal.fire({
                    //     position:'center',
                    //     title: 'Failed!',
                    //     text: data.arr.message,
                    //     icon: 'error',
                    //     showConfirmButton: false,
                    //     timer: 2000
                    // });
                }
            })
            .catch(error => {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: error,
                    icon: 'error',
                    showConfirmButton: false,
                    // timer: 1500
                });
            });
        }
    });
</script>

{{-- JS ADD Inspection Record --}}
<script>
    document.getElementById('save_inspection_record').addEventListener('click', function () {
        let id_isp       = document.getElementById('id_regrind_inspection_record').value;
        let qr_code      = document.getElementById('qr_code').innerText;
        let tahap_isp    = 0;
        let input_00     = document.getElementsByName('input_00[]');
        let arr_input_00 = [];
        for (let i = 0; i < input_00.length; i++) {
            arr_input_00.push(input_00[i].value);
        }

        fetch("{{route('updateinspectionrecord')}}",{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id_isp: id_isp,
                qr_code: qr_code,
                isp_data: arr_input_00,
                tahap_isp: tahap_isp
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if(data.status){
                Swal.fire({
                    position:'center',
                    title: 'Success!',
                    text: data.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                $("#modal_inspection_record").modal('hide');
                getInspectionRecord();
            }else{
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
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

{{-- End Inspection Record --}}

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