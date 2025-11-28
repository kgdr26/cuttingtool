@extends('main')
@section('content')

<section>
    <div class="card-header">
        @include('Masterdata.card_header')
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Maker Machine</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <div class="input-group style-search mx-4">
                        <input id="searchMakerMachine" type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                    </div>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Maker Machine</button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Maker Machine ID</th>
                        <th>Machine Name</th>
                        <th>Maker Machine Name</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataAllMakerMachine">
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
                <h5 class="modal-title">Add Maker Machine</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Maker Machine ID</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="id_maker_machine">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Machine Name</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="machine_name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Supplyer Name</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="suplier_name">
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
                <h5 class="modal-title">Edit Maker Machine</h5>
                <input type="hidden" id="id_edit">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Maker Machine ID</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="id_maker_machine" id="id_maker_machine">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Machine Name</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="machine_name" id="machine_name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Supplyer Name</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="suplier_name" id="suplier_name">
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
    document.addEventListener("DOMContentLoaded", function() {
        // Fetch API to get all data
        fetch("{{ route('getAllMakerMachine') }}", { // Laravel Blade syntax to generate the route URL
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
            // Append the new data to the table
            var table = document.getElementById('dataAllMakerMachine');
            table.innerHTML = data.arr
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });
    });
</script>

{{-- JS Add --}}
<script>
    $(document).on("click", "[data-name='add']", function (e) {
        $("input[name='id_maker_machine']").val('');
        $("input[name='machine_name']").val('');
        $("input[name='suplier_name']").val('');
        $("#modal_add").modal('show');
    });

    $(document).on("click", "#save_add", function (e) {
        var id_maker_machine = $("input[name='id_maker_machine']").val();
        var machine_name = $("input[name='machine_name']").val();
        var suplier_name = $("input[name='suplier_name']").val();
        var aksi         = 'add'

        // Fetch API to add new data
        fetch("{{ route('crudMakerMachine') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id_maker_machine: id_maker_machine,
                machine_name: machine_name,
                suplier_name: suplier_name,
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

                    var table = document.getElementById('dataAllMakerMachine');
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
        });

        $("#modal_add").modal('hide');
    });
</script>
{{-- End JS Add --}}

{{-- JS Edit --}}
<script>
    $(document).on("click", "[data-name='edit']", function (e) {
        var id = $(this).data('item');
        var modal = new bootstrap.Modal(document.getElementById('modal_edit'));
        modal.show();
        document.getElementById('id_edit').value = id;

        // Fetch API to get data by ID
        fetch("{{ route('getAllMakerMachine') }}", { // Laravel Blade syntax to generate the route URL
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
            document.getElementById('id_maker_machine').value = data.arr.id_maker_machine;
            document.getElementById('machine_name').value = data.arr.machine_name;
            document.getElementById('suplier_name').value = data.arr.suplier_name;
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });

        // save edit
        $(document).on("click", "#save_edit", function (e) {
            var id                  = document.getElementById('id_edit').value;
            var id_maker_machine    = document.getElementById('id_maker_machine').value;
            var machine_name        = document.getElementById('machine_name').value;
            var suplier_name        = document.getElementById('suplier_name').value;
            var aksi                = 'edit'

            // Fetch API to edit data
            fetch("{{ route('crudMakerMachine') }}", { // Laravel Blade syntax to generate the route URL
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: JSON.stringify({
                    id: id,
                    id_maker_machine: id_maker_machine,
                    machine_name: machine_name,
                    suplier_name: suplier_name,
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

                        var table = document.getElementById('dataAllMakerMachine');
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
            });

            $("#modal_edit").modal('hide');
        });

    });
</script>
{{-- End JS Edit --}}

{{-- JS Delete --}}
<script>
    $(document).on("click", "[data-name='delete']", function (e) {
        var id                  = $(this).data('item');
        var id_maker_machine    = $(this).data('arr');

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Delete data Maker Machine dengan ID '+id_maker_machine+'?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var aksi = 'delete'

                // Fetch API to delete data
                fetch("{{ route('crudMakerMachine') }}", { // Laravel Blade syntax to generate the route URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({
                        id: id,
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
                    if(data.status == 'success'){
                        swal.fire({
                            position:'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((resp) => {
                            var table = document.getElementById('dataAllMakerMachine');
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

{{-- JS Search --}}
<script>
$(document).ready(function(){
    $("#searchMakerMachine").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#dataAllMakerMachine tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

{{-- End JS Search --}}
@stop