@extends('main')
@section('content')

<section>
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                @include('Registrasi.card_header')
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
                <p class="judul-menu"><i></i>Registration Tool</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <button type="button" class="btn btn-border me-1" data-name="upload"><i class="icon-excel"></i> Upload</button>
                    <button type="button" class="btn btn-border me-1" data-name="download"><i class="bi bi-download"></i> Download</button>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Tool</button>
                </div>
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
                        <th>MARKING PROGRAM</th>
                        <th>PRICE</th>
                        <th>REPLACEMENT</th>
                        <th>JUDGEMENT</th>
                        <th>REGRIND INDEXING</th>
                        <th>DRAWING</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataAllToolRegis">
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
                            <td>Rp. 1.963.200</td>
                            <td>2.000.000</td>
                            <td>INDEXING</td>
                            <td>10</td>
                            <td>
                                <i class="icon-pdf"></i>
                            </td>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Registration Tool</h5>
                <input type="hidden" id="regrind_add">
                <input type="hidden" id="image_add_insp">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Part No</label>
                        <div class="col-8">
                            <input type="text" name="part_no" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Engineering No</label>
                        <div class="col-8">
                            <input type="text" name="engineering_no" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">HES No</label>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text" id="">IN-5</span>
                                <input type="text" name="hes_no" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="textarea-label col-4">Spesification</label>
                        <div class="col-8">
                            <textarea name="spesification"  cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Tool Type</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_tool">
                                <option value="" disabled selected>Select Type</option>
                                @forelse ($tool as $key => $row)
                                    <option value="{{$row->id}}">{{$row->tool_type}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Maker</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_maker">
                                <option value="" disabled selected>Select Maker</option>
                                @forelse ($maker as $key => $row)
                                    <option value="{{$row->id}}">{{$row->maker_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Material</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_material">
                                <option value="" disabled selected>Select Material</option>
                                @forelse ($material as $key => $row)
                                    <option value="{{$row->id}}">{{$row->material_type}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Marking Program</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_marking" >
                                <option value="" disabled selected>Select Marking</option>
                                @forelse ($marking as $key => $row)
                                    <option value="{{$row->id}}">{{$row->program_no}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Unit</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_unit">
                                <option value="" disabled selected>Select Unit</option>
                                @forelse ($unit as $key => $row)
                                    <option value="{{$row->id}}">{{$row->description}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Price</label>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text" id="">Rp.</span>
                                <input type="text" name="price" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Replacement</label>
                        <div class="col-8">
                            <input type="text" name="replacement" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Judgement</label>
                        <input type="hidden" id="judgement_value_add">
                        <div class="col-8">
                            <div class="d-flex justify-content-start">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="judgement_add" value="regrind" id="">
                                    <label class="form-check-label" for="">
                                        Regrind
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="judgement_add" value="indexing" id="">
                                    <label class="form-check-label" for="">
                                        Indexing
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4" id="text_max_add">Max -</label>
                        <div class="col-8">
                            <div class="input-group">
                                <input type="text" name="max_regrind_indexing" class="form-control" data-name="max_regrind_indexing_add">
                                <button type="button" class="btn input-group-text blinking-background" id="sett_inspection_record_add" style="display: none">Setting Format Inspection Record</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="textarea-label col-4">Drawing</label>
                        <div class="col-8">
                            <label for="formFile" class="form-label">Upload File Drawing: JPG, JPEG, PNG, PDF</label>
                            <input class="form-control" name="drawing" type="file" id="formFile">
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Registration Tool</h5>
                <input type="hidden" id="id_edit">
                <input type="hidden" id="regrind_edit">
                <input type="hidden" id="image_edit_insp">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Part No</label>
                        <div class="col-8">
                            <input type="text" id="part_no" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Engineering No</label>
                        <div class="col-8">
                            <input type="text" id="engineering_no" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">HES No</label>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text" id="">IN-5</span>
                                <input type="text" id="hes_no" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="textarea-label col-4">Spesification</label>
                        <div class="col-8">
                            <textarea name="model_name" id="spesification"  cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Tool Type</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_tool">
                                <option value="" disabled selected>Select Type</option>
                                @forelse ($tool as $key => $row)
                                    <option value="{{$row->id}}">{{$row->tool_type}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Maker</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_maker">
                                <option value="" disabled selected>Select Maker</option>
                                @forelse ($maker as $key => $row)
                                    <option value="{{$row->id}}">{{$row->maker_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Material</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_material">
                                <option value="" disabled selected>Select Material</option>
                                @forelse ($material as $key => $row)
                                    <option value="{{$row->id}}">{{$row->material_type}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Marking Program</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_marking">
                                <option value="" disabled selected>Select Marking</option>
                                @forelse ($marking as $key => $row)
                                    <option value="{{$row->id}}">{{$row->program_no}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Unit</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_unit">
                                <option value="" disabled selected>Select Unit</option>
                                @forelse ($unit as $key => $row)
                                    <option value="{{$row->id}}">{{$row->description}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Price</label>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text" id="">Rp.</span>
                                <input type="text" id="price" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Replacement</label>
                        <div class="col-8">
                            <input type="text" id="replacement" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Judgement</label>
                        <div class="col-8">
                            <div class="d-flex justify-content-start">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="judgement_edit" value="regrind" id="">
                                    <label class="form-check-label" for="">
                                        Regrind
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="judgement_edit" value="indexing" id="">
                                    <label class="form-check-label" for="">
                                        Indexing
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4" id="text_max_edit">Max -</label>
                        <div class="col-8">
                            <div class="input-group">
                                <input type="text" class="form-control" data-name="max_regrind_indexing_edit">
                                <button type="button" class="btn input-group-text blinking-background" id="sett_inspection_record_edit" style="display: none">Setting Format Inspection Record</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="textarea-label col-4">Drawing</label>
                        <div class="col-8">
                            <label for="formFile" class="form-label">Upload File Drawing: JPG, JPEG, PNG, PDF</label>
                            <input class="form-control fileName" name="drawing" type="file" id="formFile">
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

{{-- Modal Upload --}}
<div class="modal fade" id="modal_upload" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload File</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="textarea-label col-4">Upload File (Excel)</label>
                        <div class="col-8">
                            <label for="formFile" class="form-label">Extension: Excel</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="textarea-label col-4">Upload File Drawing</label>
                        <div class="col-8">
                            <label for="fileInput" class="form-label">Extension: JPG, JPEG, PNG, PDF</label>
                            <input class="form-control" type="file" id="fileInput" multiple>
                            <div class="row mt-3" id="fileInfo">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id=""><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Upload --}}

{{-- Modal Inspection Record Add --}}
<div class="modal fade" id="modal_inspection_record_add" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Setting Format Inspection Record</h5>
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
                                        <td class="fw-bold">CODE</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-auto position-relative">
                            <div class="card-foto">
                                <img src="{{asset('assets/images/default.svg')}}" alt="user avatar" id="img_add_insp">
                            </div>
                            <div class="input-type-file">
                                <input class="style_input_image" type="file" id="add_img_insp" name="add_img_insp" accept="image/*" />
                                <label for="add_img_insp"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-auto" id="table_inspection_record_add">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-6">
                        <button type="button" class="btn btn-save" id="add_column_add"><span>Add Column</span></button>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-cancel me-1" data-bs-dismiss="modal"><span>Close</span></button>
                            <button type="button" class="btn btn-save" id="save_regrind_add"><span>Save</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Inspection Record Add --}}

{{-- Modal Inspection Record Edit --}}
<div class="modal fade" id="modal_inspection_record_edit" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Setting Format Inspection Record</h5>
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
                                        <td class="fw-bold">CODE</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-auto position-relative">
                            <div class="card-foto">
                                <img src="{{asset('assets/images/default.svg')}}" alt="user avatar" id="img_edit_insp">
                            </div>
                            <div class="input-type-file">
                                <input class="style_input_image" type="file" id="edit_img_insp" name="edit_img_insp" accept="image/*" />
                                <label for="edit_img_insp"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-auto" id="table_inspection_record_edit">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-6">
                        <button type="button" class="btn btn-save" id="edit_column_edit"><span>Add Column</span></button>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-cancel me-1" data-bs-dismiss="modal"><span>Close</span></button>
                            <button type="button" class="btn btn-save" id="save_regrind_edit"><span>Save</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Inspection Record Edit --}}

{{-- inisiasi data --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        getToolRegis();
    });

    const getToolRegis = async () => {
        fetch("{{ route('getalltoolregis') }}", { // Laravel Blade syntax to generate the route URL
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
            var table = document.getElementById('dataAllToolRegis');
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
        $("#modal_add").modal('show');
        let part_no         = document.querySelector('input[name="part_no"]');
        let engineering_no  = document.querySelector('input[name="engineering_no"]');
        let hes_no          = document.querySelector('input[name="hes_no"]');
        let spesification   = document.querySelector('textarea[name="spesification"]');
        let id_tool         = document.querySelector('select[name="id_tool"]');
        let id_maker        = document.querySelector('select[name="id_maker"]');
        let id_material     = document.querySelector('select[name="id_material"]');
        let id_marking      = document.querySelector('select[name="id_marking"]');
        let id_unit         = document.querySelector('select[name="id_unit"]');
        let price           = document.querySelector('input[name="price"]');
        let replacement     = document.querySelector('input[name="replacement"]');
        let judgement       = document.querySelector('#judgement_value_add');
        let max_regrind_indexing = document.querySelector('input[data-name="max_regrind_indexing_add"]');
        let drawing         = document.querySelector('input[name="drawing"]');

        // save data
        document.getElementById('save_add').addEventListener('click', function() {
            var json_regrind    = $('#regrind_add').val();
            let image_add_insp  = $('#image_add_insp').val();
            let formData        = new FormData();
            formData.append('part_no', part_no.value);
            formData.append('engineering_no', engineering_no.value);
            formData.append('hes_no', hes_no.value);
            formData.append('spesification', spesification.value);
            formData.append('id_tool', id_tool.value);
            formData.append('id_maker', id_maker.value);
            formData.append('id_material', id_material.value);
            formData.append('id_marking', id_marking.value);
            formData.append('id_unit', id_unit.value);
            formData.append('price', price.value);
            formData.append('replacement', replacement.value);
            formData.append('judgement', judgement.value);
            formData.append('max_regrind_indexing', max_regrind_indexing.value);
            formData.append('drawing', drawing.files[0]);
            formData.append('json_regrind', json_regrind);
            formData.append('image_add_insp', image_add_insp);
            formData.append('aksi', 'add');

            fetch("{{ route('crudtoolregis') }}", { // Laravel Blade syntax to generate the route URL
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // Append the new data to the table
                if(data.status == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        text: data.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#modal_add").modal('hide');
                            getToolRegis();
                        }
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    })
                }
            })
            .catch((error) => {
                console.log(error);
                // Handle errors here
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error
                })
            });
        });

    });

    $(document).on("change", "input[type=radio][name=judgement_add]", function (e) {
        if (this.value === 'regrind') {
            $('#text_max_add').text('MAX Regrind');
            $('#sett_inspection_record_add').show();
            $('#judgement_value_add').val('regrind');
        } else {
            $('#text_max_add').text('MAX Indexing');
            $('#sett_inspection_record_add').hide();
            $('#judgement_value_add').val('indexing');
        }
    });

    $(document).on("click", "#sett_inspection_record_add", function (e) {
        var jml_regrind = $('[data-name="max_regrind_indexing_add"]').val();
        var html = '';
        html += '<table class="table table-bordered mb-0">';
        html += '<thead class="thead-insp">';
        html += '<tr>';
        html += '<th scope="col" colspan="3" class="text-center">Dimension</th>';
        html += '<th scope="col" class="text-center">00</th>';
        for(var i = 1; i <= jml_regrind; i++){
            html += '<th scope="col" class="text-center">' + i.toString().padStart(2, '0') + '</th>';
        }
        html += '<th scope="col" class="text-center"><i class="bi bi-x-circle-fill"></i></th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody class="tbody-insp" id="tbody_insp_add">';

        var tableData = [];
        // get array from regrind_add
        var json_regrind = $('#regrind_add').val();
        if(json_regrind == ''){
            json_regrind = null;
        }
        var json_regrind = JSON.parse(json_regrind);
        if(json_regrind != null){
            tableData = json_regrind;
            // Populate table with existing data
            tableData.forEach(function(rowData) {
                html += '<tr>';
                html += '<td><input type="text" class="form-control-td" value="' + rowData[0] + '"></td>';
                html += '<td><div class="input-group"><span class="input-group-text" id="">⌀</span><input type="number" class="form-control" value="' + rowData[1] + '"></div></td>';
                html += '<td><div class="input-group"><span class="input-group-text" id="">±</span><input type="number" class="form-control" value="' + rowData[2] + '"></div></td>';
                html += '<td></td>';
                for(var i = 1; i <= jml_regrind; i++){
                    html += '<td></td>';
                }
                html += '<td>';
                html += '<button class="btn btn-icon-delete" type="button" id="remove_list_add"><i class="bi bi-x-circle-fill"></i></button>';
                html += '</td>';
                html += '</tr>';
            });
        }else {
            html += '<tr>';
            html += '<td><input type="text" class="form-control-td"></td>';
            html += '<td><div class="input-group"><span class="input-group-text" id="">⌀</span><input type="number" class="form-control"></div></td>';
            html += '<td><div class="input-group"><span class="input-group-text" id="">±</span><input type="number" class="form-control"></div></td>';
            html += '<td></td>';
            for(var i = 1; i <= jml_regrind; i++){
                html += '<td></td>';
            }
            html += '<td>';
            html += '<button class="btn btn-icon-delete" type="button" id="remove_list_add"><i class="bi bi-x-circle-fill"></i></button>';
            html += '</td>';
            html += '</tr>';
        }

        html += '</tbody>';
        html += '</table>';

        $('#table_inspection_record_add').html(html);
        $("#modal_inspection_record_add").modal('show');
    });

    $(document).on("click", "#add_column_add", function (e) {
        var jml_regrind = $('[data-name="max_regrind_indexing_add"]').val();
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" class="form-control-td"></td>';
        html += '<td><div class="input-group"><span class="input-group-text" id="">⌀</span><input type="number" class="form-control"></div></td>';
        html += '<td><div class="input-group"><span class="input-group-text" id="">±</span><input type="number" class="form-control"></div></td>';
        html += '<td></td>';
        for(var i = 1; i <= jml_regrind; i++){
            html += '<td></td>';
        }
        html += '<td>';
        html += '<button class="btn btn-icon-delete" type="button" id="remove_list_add"><i class="bi bi-x-circle-fill"></i></button>';
        html += '</td>';
        html += '</tr>';

        $('#tbody_insp_add').append(html)
    });

    $(document).on("click", "#remove_list_add", function (e) {
        $(this).closest('tr').remove();
    });

    $("#add_img_insp").on("change", function(e){
        var ext = $("#add_img_insp").val().split('.').pop().toLowerCase();
        var file = e.target.files[0];
        // console.log(ext)
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Format image failed!'
            })
        } else {
            var uploadedFile    = URL.createObjectURL(e.target.files[0]);
            var imageName       = e.target.files[0].name;
            $('#img_add_insp').attr('src', uploadedFile);
            // upload file
            var formData = new FormData();
            var file_lok = 'image_inspection_record';
            formData.append('drawing', file);
            formData.append('lokasi', file_lok);
            formData.append('imgstr', imageName);
            document.getElementById('image_add_insp').value = imageName;

            fetch("{{ route('uploadImage') }}", { // Laravel Blade syntax to generate the route URL
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data)
            })
            .catch((error) => {
                // Handle errors here
                console.error('Error:', error);
            });
        }
    });
</script>
{{-- End JS Add --}}

{{-- JS Edit --}}
<script>
    $(document).on("click", "[data-name='edit']", function (e) {
        var id = $(this).data('item');
        $("#modal_edit").modal('show');
        $('#regrind_edit').val('');
        // fetch data
        fetch("{{ route('getalltoolregis') }}", { // Laravel Blade syntax to generate the route URL
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
            document.getElementById('id_edit').value = id;
            document.getElementById('part_no').value = data.arr.tool.part_no;
            document.getElementById('engineering_no').value = data.arr.tool.engineering_no;
            document.getElementById('hes_no').value = data.arr.tool.hes_no;
            document.getElementById('spesification').value = data.arr.tool.spesification;
            $('#id_tool').val(data.arr.tool.id_tool).trigger('change');
            $('#id_maker').val(data.arr.tool.id_maker).trigger('change');
            $('#id_material').val(data.arr.tool.id_material).trigger('change');
            $('#id_marking').val(data.arr.tool.id_marking).trigger('change');
            $('#id_unit').val(data.arr.tool.id_unit).trigger('change');
            document.getElementById('price').value = data.arr.tool.price;
            document.getElementById('replacement').value = data.arr.tool.replacement;
            document.querySelector('input[name="judgement_edit"][value="'+data.arr.tool.judgement+'"]').checked = true;
            if(data.arr.tool.judgement == 'regrind'){
                if(data.arr.regrind == null){
                    var jml_regrind = null;
                }else {
                    var jml_regrind = data.arr.regrind.dimension;
                }
                // parse json array
                $('#regrind_edit').val(jml_regrind);

                // display setting inspection record
                $('#text_max_edit').text('MAX Regrind');
                $('#sett_inspection_record_edit').show();

                document.querySelector('input[data-name="max_regrind_indexing_edit"]').value = data.arr.tool.max_regrind;
            }else {
                // display setting inspection record
                $('#text_max_edit').text('MAX Indexing');
                $('#sett_inspection_record_edit').hide();
                document.querySelector('input[data-name="max_regrind_indexing_edit"]').value = data.arr.tool.max_indexing;
            }

            document.getElementByClass('fileName').value = data.arr.tool.drawing;
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });
    });

    // save edit
    document.getElementById('save_edit').addEventListener('click', function() {
        var id              = $('#id_edit').val();
        var image_edit_insp = $('#image_edit_insp').val();
        let formData = new FormData();
        formData.append('id', id);
        formData.append('part_no', document.getElementById('part_no').value);
        formData.append('engineering_no', document.getElementById('engineering_no').value);
        formData.append('hes_no', document.getElementById('hes_no').value);
        formData.append('spesification', document.getElementById('spesification').value);
        formData.append('id_tool', document.getElementById('id_tool').value);
        formData.append('id_maker', document.getElementById('id_maker').value);
        formData.append('id_material', document.getElementById('id_material').value);
        formData.append('id_marking', document.getElementById('id_marking').value);
        formData.append('id_unit', document.getElementById('id_unit').value);
        formData.append('price', document.getElementById('price').value);
        formData.append('replacement', document.getElementById('replacement').value);
        formData.append('judgement', document.querySelector('input[name="judgement_edit"]:checked').value);
        formData.append('max_regrind_indexing', document.querySelector('input[data-name="max_regrind_indexing_edit"]').value);
        formData.append('drawing', document.querySelector('input[name="drawing"]').files[0]);
        formData.append('json_regrind', $('#regrind_edit').val());
        formData.append('image_edit_insp', image_edit_insp);
        formData.append('aksi', 'edit');
        // console.log(formData)

        fetch("{{ route('crudtoolregis') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: formData
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
                Swal.fire({
                    icon: 'success',
                    title: 'Success...',
                    text: data.message
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#modal_edit").modal('hide');
                        getToolRegis();
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message
                })
            }
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });
    });
</script>

<script>
        $(document).on("change", "input[type=radio][name=judgement_edit]", function (e) {
        if (this.value === 'regrind') {
            $('#text_max_edit').text('MAX Regrind');
            $('#sett_inspection_record_edit').show();
        } else {
            $('#text_max_edit').text('MAX Indexing');
            $('#sett_inspection_record_edit').hide();
        }
    });

    $(document).on("click", "#sett_inspection_record_edit", function (e) {
        // fetch data from mst_regrind_inspection_record
        var id = $('#id_edit').val();
        // fetch data mst_regrind_inspection_record

        fetch("{{ route('getallregrindinspectionrecord') }}", { // Laravel Blade syntax to generate the route URL
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
            var jml_regrind = $('[data-name="max_regrind_indexing_edit"]').val();
            var html = '';
            html += '<table class="table table-bordered mb-0">';
            html += '<thead class="thead-insp">';
            html += '<tr>';
            html += '<th scope="col" colspan="3" class="text-center">Dimension</th>';
            html += '<th scope="col" class="text-center">00</th>';
            for(var i = 1; i <= jml_regrind; i++){
                html += '<th scope="col" class="text-center">'+i.toString().padStart(2, '0');+'</th>';
            }
            html += '<th scope="col" class="text-center"><i class="bi bi-x-circle-fill"></i></th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody class="tbody-insp" id="tbody_insp_edit">';

            // append image
            if(data.arr != null){
                // append image to edit_img_insp
                if(data.arr.image != null){
                    var imgstr = data.arr.image;
                    var lokasi  = 'image_inspection_record';
                    imgstr      = '{{asset('image_inspection_record')}}/'+imgstr;
                    $('#img_edit_insp').attr('src', imgstr);
                }
            }else {
                $('#img_edit_insp').attr('src', '{{asset('assets/images/default.svg')}}');
            }

            var tableData = [];
            // get array from regrind_add
            var json_regrind = data.arr;
            if(json_regrind != null){
                tableData = data.arr.dimension;
                // parse json
                tableData = JSON.parse(tableData);
                console.log(tableData)
                // Populate table with existing data
                tableData.forEach(function(rowData) {
                    html += '<tr>';
                    html += '<td><input type="text" class="form-control-td" value="' + rowData[0] + '"></td>';
                    html += '<td><div class="input-group"><span class="input-group-text" id="">⌀</span><input type="number" class="form-control" value="' + rowData[1] + '"></div></td>';
                    html += '<td><div class="input-group"><span class="input-group-text" id="">±</span><input type="number" class="form-control" value="' + rowData[2] + '"></div></td>';
                    html += '<td></td>';
                    for(var i = 1; i <= jml_regrind; i++){
                        html += '<td></td>';
                    }
                    html += '<td>';
                    html += '<button class="btn btn-icon-delete" type="button" id="remove_list_edit"><i class="bi bi-x-circle-fill"></i></button>';
                    html += '</td>';
                    html += '</tr>';


                });
            }else {
                html += '<tr>';
                html += '<td><input type="text" class="form-control-td"></td>';
                html += '<td><div class="input-group"><span class="input-group-text" id="">⌀</span><input type="number" class="form-control"></div></td>';
                html += '<td><div class="input-group"><span class="input-group-text" id="">±</span><input type="number" class="form-control"></div></td>';
                html += '<td></td>';
                for(var i = 1; i <= jml_regrind; i++){
                    html += '<td></td>';
                }
                html += '<td>';
                html += '<button class="btn btn-icon-delete" type="button" id="remove_list_edit"><i class="bi bi-x-circle-fill"></i></button>';
                html += '</td>';
                html += '</tr>';

                // re
            }

            html += '</tbody>';
            html += '</table>';

            // write to html
            $('#table_inspection_record_edit').html(html);
            $("#modal_inspection_record_edit").modal('show');

        })

    });

    $(document).on("click", "#edit_column_edit", function (e) {
        var jml_regrind = $('[data-name="max_regrind_indexing_edit"]').val();
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" class="form-control-td"></td>';
        html += '<td><div class="input-group"><span class="input-group-text" id="">⌀</span><input type="number" class="form-control"></div></td>';
        html += '<td><div class="input-group"><span class="input-group-text" id="">±</span><input type="number" class="form-control"></div></td>';
        html += '<td></td>';
        for(var i = 1; i <= jml_regrind; i++){
            html += '<td></td>';
        }
        html += '<td>';
        html += '<button class="btn btn-icon-delete" type="button" id="remove_list_edit"><i class="bi bi-x-circle-fill"></i></button>';
        html += '</td>';
        html += '</tr>';

        $('#tbody_insp_edit').append(html)
    });

    $(document).on("click", "#remove_list_edit", function (e) {
        $(this).closest('tr').remove();
    });

    $("#edit_img_insp").on("change", function(e){
        var ext     = $("#edit_img_insp").val().split('.').pop().toLowerCase();
        var file    = e.target.files[0];

        // console.log(ext)
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Format image failed!'
            })
        } else {
            var uploadedFile    = URL.createObjectURL(e.target.files[0]);
            var imageName       = e.target.files[0].name;
            $('#img_edit_insp').attr('src', uploadedFile);
            // upload file
            var formData = new FormData();
            var file_lok = 'image_inspection_record';
            formData.append('drawing', file);
            formData.append('lokasi', file_lok);
            formData.append('imgstr', imageName);
            document.getElementById('image_edit_insp').value = imageName;

            fetch("{{ route('uploadImage') }}", { // Laravel Blade syntax to generate the route URL
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data)
            })
            .catch((error) => {
                // Handle errors here
                console.error('Error:', error);
            });
        }
    });
</script>
{{-- End JS Edit --}}

{{-- JS Upload File --}}
<script>
    $(document).on("click", "[data-name='upload']", function (e) {
        $("#modal_upload").modal('show');
    });

    $(document).ready(function() {
        // Handle change event of file input
        $('#fileInput').change(function() {
            // Get the files
            var files = $(this)[0].files;

            // Clear previous file information
            $('#fileInfo').html('');

            // Loop through the files and display information
            var html = '';
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;
                var fileSize = files[i].size;
                var fileSizeKB = fileSize / 1024;

                html += '<div class="col-12 mb-3">';
                html += '<div class="card-preview-file">';
                html += '<button class="btn btn-remove" type="button" data-item="file_'+(i + 1)+'">';
                html += '<i class="bi bi-x-lg"></i>';
                html += '</button>';
                html += '<div class="card-info-file">';
                html += '<p>'+fileName+'</p>';
                html += '<p>'+fileSizeKB.toFixed(2)+' KB</p>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                // Display file information
            }

            $('#fileInfo').append(html);
        });
    });
</script>
{{-- End Upload File --}}

{{-- JS Delete --}}
<script>
    $(document).on("click", "[data-name='delete']", function (e) {
        var id      = $(this).data('item');
        var detail  = $(this).data('arr');

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Hapus data '+detail+'?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // fetch data
                fetch("{{ route('crudtoolregis') }}", { // Laravel Blade syntax to generate the route URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({id: id, aksi: 'delete'})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    // Append the new data to the table
                    if(data.status == 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            text: data.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                getToolRegis();
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        })
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

{{-- modal regrind save add --}}
<script>
    document.getElementById('save_regrind_add').addEventListener('click',function () {
        var tableData = [];
        var table = document.getElementById('tbody_insp_add');

        for (var i = 0, row; row = table.rows[i]; i++) {
            var rowData = []; // Create a new array for each row
            for (var j = 0, col; col = row.cells[j]; j++) {
                var input = col.querySelector('input');
                if (input) { // Check if the input element exists
                    rowData.push(input.value); // Add the input value to the rowData array
                }
            }
            tableData.push(rowData); // Add the rowData array to the tableData array
        }

        $('#regrind_add').val(JSON.stringify(tableData))
        // close modal
        $("#modal_inspection_record_add").modal('hide');
    });
</script>

{{-- modal regrind save edit --}}
<script>
    document.getElementById('save_regrind_edit').addEventListener('click', function(){
        var tableData = [];
        var table = document.getElementById('tbody_insp_edit');

        for (var i = 0, row; row = table.rows[i]; i++) {
            var rowData = []; // Create a new array for each row
            for (var j = 0, col; col = row.cells[j]; j++) {
                var input = col.querySelector('input');
                if (input) { // Check if the input element exists
                    rowData.push(input.value); // Add the input value to the rowData array
                }
            }
            tableData.push(rowData); // Add the rowData array to the tableData array
        }

        $('#regrind_edit').val(JSON.stringify(tableData))
        // close modal
        $("#modal_inspection_record_edit").modal('hide');
    });
</script>

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



@stop
