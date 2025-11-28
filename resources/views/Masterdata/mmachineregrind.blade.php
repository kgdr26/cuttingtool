@extends('main')
@section('content')

<section>
    <div class="card-header">
        @include('Masterdata.card_header')
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Machine Regrind</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <div class="input-group style-search mx-4">
                        <input id="searchMachineRegrind" type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                    </div>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Machine Regrind</button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Plant</th>
                        <th>Assets No</th>
                        <th>Machine Regrind Name</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataAllMachineRegrind">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>Plant 6</td>
                            <td>1000002442</td>
                            <td>MC REGRIND #1</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-icon-edit" type="button" data-item="" data-name="edit"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-icon-delete" type="button" data-item="" data-name="delete"><i class="bi bi-trash-fill"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endfor --}}
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Modal Add --}}
<div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Machine Regrind</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Plant</label>
                        <div class="col-7">
                            <select class="form-select select-2-add" name="id_plant">
                                <option value="0">-- select Plant --</option>
                                @forelse ($plant as $key => $row)
                                    <option value="{{$row->id}}">{{$row->plant_name}}</option>
                                @empty
                                    <option value="0">-- Data Plant Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Asset No</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="no_asset">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Machine Regrind Name</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="machine_name" >
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_add"><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Add --}}

{{-- Modal Edit --}}
<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Machine Regrind</h5>
                <input type="hidden" id="id_edit">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Plant</label>
                        <div class="col-7">
                            <select class="form-select select-2-edit" id="id_plant">
                                <option value="0">-- select Plant --</option>
                                @forelse ($plant as $key => $row)
                                    <option value="{{$row->id}}">{{$row->plant_name}}</option>
                                @empty
                                    <option value="0">-- Data Plant Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Asset No</label>
                        <div class="col-7">
                            <input type="text" class="form-control" id="no_asset">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Machine Regrind Name</label>
                        <div class="col-7">
                            <input type="text" class="form-control" id="machine_name">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_edit"><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Edit --}}

{{-- inisiasi data --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getDataAllMachineRegrind();
    });

    const getDataAllMachineRegrind = async () => {
        // fetch api to get all data
        fetch("{{ route('getAllMachineRegrind') }}", { // Laravel Blade syntax to generate the route URL
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
            console.log(data)
            // Append the new data to the table
            var table = document.getElementById('dataAllMachineRegrind');
            table.innerHTML = data.arr
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });
    }
</script>

{{-- JS Add --}}
<script>
    $(document).on("click", "[data-name='add']", function (e) {
        $("select[name='id_plant']").val('').trigger("change");
        $("input[name='no_asset']").val('');
        $("input[name='machine_name']").val('');
        $("#modal_add").modal('show');
    });

    $(document).on("click", "#save_add", function (e) {
        var id_plant        = $("select[name='id_plant']").val();
        var no_asset        = $("input[name='no_asset']").val();
        var machine_name    = $("input[name='machine_name']").val();
        var aksi            = 'add';

        // alert(id_plant + ' - ' + no_asset + ' - ' + machine_name + ' - ' + aksi)

        // Fetch API to save the data
        fetch("{{ route('crudMachineRegrind') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id_plant: id_plant,
                no_asset: no_asset,
                machine_name: machine_name,
                aksi: aksi
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            // Append the new data to the table
            if(data.status == 'success'){
                swal.fire({
                    position:'center',
                    title: 'Success!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((resp) => {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal_add'));
                    modal.hide();

                    var table = document.getElementById('dataAllMachineRegrind');
                    table.innerHTML = data.arr
                });
            }else {
                swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
            swal.fire({
                position:'center',
                title: 'Failed!',
                text: data.message,
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
</script>
{{-- End JS Add --}}

{{-- JS Edit --}}
<script>
    $(document).on("click", "[data-name='edit']", function (e) {
        let id = $(this).data('item');
        $("#modal_edit").modal('show');
        document.getElementById('id_edit').value = id;

        // Fetch API to get the data
        fetch("{{ route('getAllMachineRegrind') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id: id
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            // Append the new data to the table
            if(data.status == 'success'){
                // setting select2 edit
        
                $('#id_plant').val(data.arr.id_plant).trigger('change');
                document.getElementById('no_asset').value = data.arr.no_asset;
                document.getElementById('machine_name').value = data.arr.machine_regrind;
            }else {
                swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
            swal.fire({
                position:'center',
                title: 'Failed!',
                text: data.message,
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });

    // Save Edit
    $(document).on("click", "#save_edit", function (e) {
        var id              = document.getElementById('id_edit').value;
        var id_plant        = $("select[id='id_plant']").val();
        var no_asset        = $("input[id='no_asset']").val();
        var machine_name    = $("input[id='machine_name']").val();
        var aksi            = 'edit';

        // Fetch API to save the data
        fetch("{{ route('crudMachineRegrind') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id: id,
                id_plant: id_plant,
                no_asset: no_asset,
                machine_name: machine_name,
                aksi: aksi
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            // Append the new data to the table
            if(data.status == 'success'){
                swal.fire({
                    position:'center',
                    title: 'Success!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((resp) => {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal_edit'));
                    modal.hide();

                    var table = document.getElementById('dataAllMachineRegrind');
                    table.innerHTML = data.arr
                });
            }else {
                swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
            swal.fire({
                position:'center',
                title: 'Failed!',
                text: data.message,
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
</script>
{{-- End JS Edit --}}

{{-- JS Delete --}}
<script>
    $(document).on("click", "[data-name='delete']", function (e) {
        let id              = $(this).data('item');
        let machine_regrind = $(this).data('arr');
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Data Machine Regrind ' + machine_regrind + ' akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Fetch API to delete the data
                fetch("{{ route('crudMachineRegrind') }}", { // Laravel Blade syntax to generate the route URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({
                        id: id,
                        aksi: 'delete'
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data)
                    // Append the new data to the table
                    if(data.status == 'success'){
                        swal.fire({
                            position:'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((resp) => {
                            var table = document.getElementById('dataAllMachineRegrind');
                            table.innerHTML = data.arr
                        });
                    }else {
                        swal.fire({
                            position:'center',
                            title: 'Failed!',
                            text: data.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch((error) => {
                    // Handle errors here
                    console.error('Error:', error);
                    swal.fire({
                        position:'center',
                        title: 'Failed!',
                        text: data.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            }
        });
    });
</script>
{{-- End JS Delete --}}

{{-- JS Select2 --}}
<script>
    $(".select-2-add").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_add')
    });

    $(".select-2-edit").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_edit')
    });
</script>
{{-- End JS Select2 --}}
{{-- JS search --}}
<script>
    $(document).ready(function(){
        $("#searchMachineRegrind").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#dataAllMachineRegrind tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>


@stop