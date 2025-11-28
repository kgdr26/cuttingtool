@extends('main')
@section('content')

<section>
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                <a href="{{route('igoodstockholder')}}" class="btn tabs-header">
                    Holder
                </a>
                
                <a href="{{route('igoodstocktool')}}" class="btn tabs-header">
                    Cutting Tool
                </a>

                <a href="{{route('igoodstocaccessories')}}" class="btn tabs-header active">
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
                <p class="judul-menu"><i></i>Marking Accessories</p>
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
                        <th>MAKER</th>
                        <th>MATERIAL</th>
                        <th>PRICE</th>
                        <th>LIFETIME</th>
                        <th>STOCK</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="getaccstock">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>08-91-00137</td>
                            <td>-</td>
                            <td>IN-5JC547</td>
                            <td>WRENCH 174.1-864</td>
                            <td>WEDGE, WRENCH.KEY, SCREW DRIVER</td>
                            <td>SANDVIK</td>
                            <td>ST</td>
                            <td>Rp. 900.000</td>
                            <td>2.000.000</td>
                            <td>20</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-verify" data-name="add_stock">Add Stock</button>
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
<div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Quantity</h5>
                <input type="hidden" id="id_acc">
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
                                    <dd class="col-12" id="acc_type">: CAPTO</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">MATERIAL</dt>
                                    <dd class="col-12" id="material_type">: ST</dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">Price</dt>
                                    <dd class="col-12" id="price">: Rp. 1.000.0000</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-auto">
                    <div class="row">
                        <div class="col-10">
                            <input type="number" class="form-qty" name="" id="qty" value="0" data-name="qty">
                        </div>

                        <div class="col-2">
                            <button type="button" class="btn btn-plus-minus" data-name="plus_qty"><i class="bi bi-plus-lg"></i></button>
                            <button type="button" class="btn btn-plus-minus" data-name="minus_qty"><i class="bi bi-dash-lg"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_add"><span>Add</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal View Detail --}}

{{-- inisiasi data --}}
<script>
    $(document).ready(function() {
        getaccstock();
    });

    const getaccstock = () =>{

        fetch("{{route('getaccstock')}}",{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            // body: JSON.stringify({id: id})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            document.getElementById('getaccstock').innerHTML = '';
            if(data.status){
                document.getElementById('getaccstock').innerHTML = data.arr;
            }else {
                document.getElementById('getaccstock').innerHTML = `<tr><td colspan="13" class="text-center">No Data Available !</td></tr>`;
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


{{-- JS Add Stok --}}
<script>
    $(document).on("click", "[data-name='add_stock']", function (e) {
        $("#modal_add").modal('show');
        let id = $(this).data('item');
        $('#id_acc').val(id);

        fetch("{{route('getaccstock')}}",{
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
            console.log(data)
            let row = data.arr.acc
            document.getElementById('part_no').innerHTML = `: ${row.part_no}`;
            document.getElementById('engineering_no').innerHTML = `: ${row.engineering_no}`;
            document.getElementById('hes_no').innerHTML = `: ${row.hes_no}`;
            document.getElementById('spesification').innerHTML = `: ${row.spesification}`;
            document.getElementById('acc_type').innerHTML = `: ${data.arr.nmacc}`;
            document.getElementById('material_type').innerHTML = `: ${data.arr.nmmaterial}`;
            document.getElementById('price').innerHTML = `: Rp. ${row.price}`;
            if(row.qty > 0){
                document.getElementById('qty').value =`${row.qty}`;
            }else {
                document.getElementById('qty').value = 0;
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
{{-- End JS Add Stok --}}

{{-- JS Counting --}}
<script>
    $(document).on("click", "[data-name='plus_qty']", function (e) {
        var qty = $("[data-name='qty']").val();
        $("[data-name='qty']").val(parseFloat(qty) + 1); 
    });

    $(document).on("click", "[data-name='minus_qty']", function (e) {
        var qty = $("[data-name='qty']").val();
        if(qty > 0){
            $("[data-name='qty']").val(qty-1);
        }
    });
  </script>
{{-- End JS Counting --}}

<script>
    document.getElementById('save_add').addEventListener('click', function(){
        let id  = $('#id_acc').val();
        let qty = $("[data-name='qty']").val();
        fetch("{{route('addaccstock')}}",{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({id: id, qty: qty})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            if(data.status){
                Swal.fire({
                    position:'center',
                    title: 'Success!',
                    text: data.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                getaccstock();
                $("#modal_add").modal('hide');
            }else {
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