@extends('main')
@section('content')

<section>
    <div class="card-header">
        @include('Masterdata.card_header')
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Plant Type</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <div class="input-group style-search mx-4">
                        <input type="text" class="form-control" placeholder="Search" id="searchPlant" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                    </div>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Plant</button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>PLANT ID</th>
                        <th>PLANT</th>
                        <th>DESCRIPTION</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataAllPlant">
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
                <h5 class="modal-title">Add Plant</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-3">Plant ID</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="id_plant">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-3">Plant</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="plant_name">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="textarea-label col-3">Description</label>
                        <div class="col-9">
                            <textarea cols="30" rows="10" name="plant_description" class="form-control"></textarea>
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
                <h5 class="modal-title">Edit Plant</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-3">Plant ID</label>
                        <input type="hidden" id="id_edit">
                        <div class="col-9">
                            <input type="text" class="form-control" name="id_plant" id="id_plant">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-3">Plant</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="plant_name" id="plant_name">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="textarea-label col-3">Description</label>
                        <div class="col-9">
                            <textarea id="plant_description" name="plant_description" cols="30" rows="10" class="form-control"></textarea>
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
        fetch("{{ route('get_all_plant') }}", { // Laravel Blade syntax to generate the route URL
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
            var table = document.getElementById('dataAllPlant');
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
    // show modal
    document.addEventListener("click", function(e) {
        if (e.target && e.target.getAttribute('data-name') === 'add') {
            var modal = new bootstrap.Modal(document.getElementById('modal_add'));
            modal.show();
        }
    });

    // save data
    document.getElementById('save_add').addEventListener('click', function() {
        // Prepare data to send
        var idPlant = document.querySelector('input[name="id_plant"]').value;
        var plantName = document.querySelector('input[name="plant_name"]').value;
        var plantDescription = document.querySelector('textarea[name="plant_description"]').value;

        var data = {
            id_plant: idPlant,
            plant_name: plantName,
            plant_description: plantDescription
        };

        // Fetch API to send the data
        fetch("{{ route('add_plant') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify(data)
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
                    console.log(data)
                    // Hide the modal
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal_add'));
                    modal.hide();
                    // Clear the form
                    document.querySelector('input[name="id_plant"]').value = '';
                    document.querySelector('input[name="plant_name"]').value = '';
                    document.querySelector('textarea[name="plant_description"]').value = '';
                    // Append the new data to the table
                    var table = document.getElementById('dataAllPlant');
                    table.innerHTML = data.arr
                });            
            }else{
                swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: true,
                })
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
                showConfirmButton: true,
            })
        });
    });
</script>
{{-- End JS Add --}}

{{-- JS Edit --}}
<script>
    // ONCLICK EDIT
    $(document).on("click", "[data-name='edit']", function (e) {
        var modal    = new bootstrap.Modal(document.getElementById('modal_edit'));
        modal.show();
        // get data-item
        var id_plant = this.getAttribute('data-item');

        // Fetch API to get the data
        fetch("{{ route('get_all_plant') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({id: id_plant})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            // Append the new data to the table
            document.getElementById('id_edit').value            = data.arr[0].id;
            document.getElementById('id_plant').value           = data.arr[0].id_plant;
            document.getElementById('plant_name').value         = data.arr[0].plant_name;
            document.getElementById('plant_description').value  = data.arr[0].plant_description;
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });

    });
</script>
<script>
    // save data
    document.getElementById('save_edit').addEventListener('click', function() {
        // Prepare data to send
        var idEdit              = document.querySelector('input[id="id_edit"]').value;
        var idPlant             = document.querySelector('input[id="id_plant"]').value;
        var plantName           = document.querySelector('input[id="plant_name"]').value;
        var plantDescription    = document.querySelector('textarea[id="plant_description"]').value;

        var data = {
            id: idEdit,
            id_plant: idPlant,
            plant_name: plantName,
            plant_description: plantDescription
        };

        // Fetch API to send the data
        fetch("{{ route('edit_plant') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            if(data.status == 'success'){
                swal.fire({
                    position:'center',
                    title: 'Success!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((resp) => {
                    console.log(data)
                    // Hide the modal
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal_edit'));
                    modal.hide();
                    // Clear the form
                    document.querySelector('input[id="id_edit"]').value = '';
                    document.querySelector('input[id="id_plant"]').value = '';
                    document.querySelector('input[id="plant_name"]').value = '';
                    document.querySelector('textarea[id="plant_description"]').value = '';
                    // Append the new data to the table
                    var table = document.getElementById('dataAllPlant');
                    table.innerHTML = data.arr
                });            
            }else{
                swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: true,
                })
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
                showConfirmButton: true,
            })
        });
    });
</script>
{{-- End JS Edit --}}

{{-- JS Delete --}}
<script>
    $(document).on("click", "[data-name='delete']", function (e) {
        var id          = this.getAttribute('data-item');
        var id_plant    = this.getAttribute('data-arr');
        swal.fire({
            title: 'Anda yakin?',
            text: 'Delete Plant ID : ' + id_plant + ' ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                // Fetch API to send the data
                fetch("{{ route('delete_plant') }}", { // Laravel Blade syntax to generate the route URL
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
                    if(data.status == 'success'){
                        swal.fire({
                            position:'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((resp) => {
                            console.log(data)
                            // Append the new data to the table
                            var table = document.getElementById('dataAllPlant');
                            table.innerHTML = data.arr
                        });            
                    }else{
                        swal.fire({
                            position:'center',
                            title: 'Failed!',
                            text: data.message,
                            icon: 'error',
                            showConfirmButton: true,
                        })
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
                        showConfirmButton: true,
                    })
                });
            }
        })
    });
</script>
{{-- End JS Delete --}}

{{-- JS search --}}
<script>
    $(document).ready(function(){
        $("#searchPlant").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#dataAllPlant tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>


@stop