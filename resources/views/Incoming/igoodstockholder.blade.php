@extends('main')
@section('content')

<section>
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <a href="{{route('igoodstockholder')}}" class="btn tabs-header active">
                    Holder
                </a>
                
                <a href="{{route('igoodstocktool')}}" class="btn tabs-header">
                    Cutting Tool
                </a>

                <a href="{{route('igoodstocaccessories')}}" class="btn tabs-header">
                    Accessories
                </a>
            </div>
            <div class="col-4">
                <div class="input-group style-search mx-4 w-100">
                    <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                    <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Marking Holder</p>
            </div>
            <div class="col-6">

            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>PART NO</th>
                        <th>ENGINEERING NO</th>
                        <th>HES NO</th>
                        <th>SPESIFICATION</th>
                        <th>TYPE</th>
                        <th>MATERIAL</th>
                        <th>MARKING PROGRAM</th>
                        <th>QTY</th>
                        <th>LIFETIME</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="stokmarkingholder">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>08-91-00137</td>
                            <td>-</td>
                            <td>IN-5JC547</td>
                            <td>IN-5JC547 HOLDER C4-PSSNL-27042-12 SANDVIK</td>
                            <td>CAPTO</td>
                            <td>ST</td>
                            <td>0000</td>
                            <td>20</td>
                            <td>2.000.000</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-execute" data-name="detail">View Detail</button>
                                </div>
                            </td>
                        </tr>
                    @endfor --}}
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Modal View Detail --}}
<div class="modal fade" id="modal_detail" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Holder List</h5>
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
                                    <dd class="col-12" id="spesification">: HOLDER C4-PSSNL-27042-12</dd>
                                </dl>
                            </div>
                            <div class="col-6">
                                <dl class="row mb-0">
                                    <dt class="col-12">TYPE</dt>
                                    <dd class="col-12" id="holder_type">: CAPTO</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MATERIAL</dt>
                                    <dd class="col-12" id="material_type">: ST</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MARKING PROGRAM</dt>
                                    <dd class="col-12" id="marking">: 0000</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-auto mb-3">
                    <div class="gridtable-detail-stock">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>WCT ID</th>
                                    <th>QR CODE</th>
                                    <th>ACTUAL LIFETIME</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="detailstokholder">
                                {{-- @for($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>P9CCA0</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>50</td>
                                    </tr>
                                @endfor --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal View Detail --}}

{{-- inisiasi data --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getStokMarkingHolder();
    });

    const getStokMarkingHolder = () => {
        fetch("{{route('getstokmarkingholder')}}", {
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
                document.getElementById('stokmarkingholder').innerHTML = data.arr;
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


{{-- JS Marking --}}
<script>
    $(document).on("click", "[data-name='detail']", function (e) {
        $("#modal_detail").modal('show');
        let id = $(this).data('item');

        fetch("{{route('getdetailmarkingholder')}}", {
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
            console.log(data);
            if (data.status) {
                let par = data.arr.holder;
                document.getElementById('part_no').innerHTML = ':'+ par.part_no;
                document.getElementById('engineering_no').innerHTML = ': ' + par.engineering_no;
                document.getElementById('hes_no').innerHTML = ': ' + par.hes_no;
                document.getElementById('spesification').innerHTML = ': ' + par.spesification;
                document.getElementById('holder_type').innerHTML = ': ' + par.holder_type;
                document.getElementById('material_type').innerHTML = ': ' + par.material_type;
                document.getElementById('marking').innerHTML = ': ' + par.marking;

                // Clear the table body before appending new rows
                let tableBody = document.getElementById('detailstokholder');
                tableBody.innerHTML = '';

                for (let i = 0; i < data.arr.marking.length; i++) {
                    let tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${i + 1}</td>
                        <td>${data.arr.marking[i].id_wct}</td>
                        <td>${data.arr.marking[i].qr_code}</td>
                        <td>${data.arr.marking[i].actual_lifetime}</td>
                    `;
                    tableBody.appendChild(tr);
                }
                
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
{{-- End JS Marking --}}

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