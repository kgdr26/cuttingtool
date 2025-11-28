@extends('main')
@section('content')

<section>
    <div class="card-header">
        @include('Masterdata.card_header')
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Line Type</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <div class="input-group style-search mx-4">
                        <input type="text" id="searchLine" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                    </div>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Line</button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>WCT ID</th>
                        <th>PLANT</th>
                        <th>Line Name</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataAllLine" >
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
                <h5 class="modal-title">Add Line</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-3">Plant</label>
                        <div class="col-9">
                            <select class="form-select select-2-add" name="id_plant">
                                <option value="">-- select Plant --</option>
                                @foreach ($plant as $key =>$row)
                                    <option value="{{$row->id}}">{{$row->plant_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-3">WCT ID</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="id_wct">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="text-label col-3">Line</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="line_name">
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
                <h5 class="modal-title">Edit Line</h5>
                <input type="hidden" id="id_edit">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-3">Plant</label>
                        <div class="col-9">
                            <select class="form-select select-2-edit" name="" id="id_plant">
                                <option value="">-- select Plant --</option>
                                @foreach ($plant as $key =>$row)
                                    <option value="{{$row->id}}">{{$row->id_plant}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-3">WCT ID</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="" id="id_wct">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="text-label col-3">Line</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="" id="line_name">
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
        fetch("{{ route('get_all_line') }}", { // Laravel Blade syntax to generate the route URL
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
            var table = document.getElementById('dataAllLine');
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
        // var idPlant     = document.querySelector('option[name="id_plant"]').value;
        var selectElement = document.querySelector('select[name="id_plant"]');
        var idPlant = selectElement.options[selectElement.selectedIndex].value;

        var idWct       = document.querySelector('input[name="id_wct"]').value;
        var lineName    = document.querySelector('input[name="line_name"]').value;
        var data = {
            id_plant: idPlant,
            id_wct: idWct,
            line_name: lineName
        };
        // Fetch API to send the data
        fetch("{{ route('add_line') }}", { // Laravel Blade syntax to generate the route URL
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
                    location.reload();
                    // console.log(data)
                    // Hide the modal
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal_add'));
                    modal.hide();
                    // Clear the form
                    document.querySelector('input[name="id_plant"]').value = '';
                    document.querySelector('input[name="id_wct"]').value = '';
                    document.querySelector('textarea[name="line_name"]').value = '';
                    // Append the new data to the table
                    var table = document.getElementById('dataAllLine');
                    table.innerHTML = data.arr
                    location.reload();
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
    $(document).on("click", "[data-name='edit']", function (e) {
        var modal    = new bootstrap.Modal(document.getElementById('modal_edit'));
        modal.show();
        var id  = $(this).attr('data-item');
        document.getElementById('id_edit').value = id;

        // Fetch API to get the data
        fetch("{{ route('get_all_line') }}", { // Laravel Blade syntax to generate the route URL
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
            var id_plant    = data.arr[0].id_plant;
            var id_wct      = data.arr[0].id_wct;
            var line_name   = data.arr[0].line_name;
            // select2 option set id plant
            $('#id_plant').val(id_plant).trigger('change');
            document.getElementById('id_wct').value = id_wct;
            document.getElementById('line_name').value = line_name;

        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });
    });

    // save data
    document.getElementById('save_edit').addEventListener('click', function() {
        // Prepare data to send
        var idPlant     = document.querySelector('select[id="id_plant"]').value;
        var idWct       = document.querySelector('input[id="id_wct"]').value;
        var lineName    = document.querySelector('input[id="line_name"]').value;
        var idEdit      = document.getElementById('id_edit').value;
        var data = {
            id       : idEdit,
            id_plant : idPlant,
            id_wct   : idWct,
            line_name: lineName
        };
        // Fetch API to send the data
        fetch("{{ route('edit_line') }}", { // Laravel Blade syntax to generate the route URL
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
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal_edit'));
                    modal.hide();
                    // Append the new data to the table
                    var table = document.getElementById('dataAllLine');
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
        var id_wct      = this.getAttribute('data-arr');
        swal.fire({
            title: 'Anda yakin?',
            text: 'Delete WCT ID : ' + id_wct + ' ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                // Fetch API to send the data
                fetch("{{ route('delete_line') }}", { // Laravel Blade syntax to generate the route URL
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
                            var table = document.getElementById('dataAllLine');
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
        $("#searchLine").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#dataAllLine tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>



@stop