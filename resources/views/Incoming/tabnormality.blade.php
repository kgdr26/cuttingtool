@extends('main')
@section('content')

<section>
    <div class="main-card-grid">
        <div class="input-abnormal">
            <div class="row">
                <div class="col-4">
                    <div class="card-header-input">
                        ABNORMALITY INFORMATION
                    </div>
                    <div class="card-body-input">
                        <div class="card-form-input">
                            <div class="card-action mb-3">
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="flex-shrink-0">
                                        <i class="icon-qr-label"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-start">
                                            <span class="text-lale-qr d-block">PLEASE SCAN QR HOLDER / TOOL</span>
                                        </div>
                                        
                                        <div class="d-flex justify-content-start">
                                            <input type="text" class="form-control qr-code">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="text-label col-4">Reason</label>
                                <div class="col-8">
                                    <select class="form-select select-2" name="" id="">
                                        @for($i = 1; $i < 10; $i++)
                                            <option value="{{$i}}">Reason {{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="text-label col-4">PIC</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" value="Kang Dru" disabled>
                                </div>
                            </div>

                            <button class="btn btn-delete w-100">ABNORMAL</button>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-header-input">
                        TOOL INFORMATION
                    </div>
                    <div class="card-body-input">
                        <div class="row">
                            <div class="col-3">
                                <dl class="row mb-0">
                                    <dt class="col-12">PART NO</dt>
                                    <dd class="col-12">: 08-91-00137</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">ENGINEERING NO</dt>
                                    <dd class="col-12">: C202017</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">HES NO</dt>
                                    <dd class="col-12">: IN-5NC012</dd>
                                </dl>
                                <dl class="row mb-0">
                                    <dt class="col-12">SPECIFICATION</dt>
                                    <dd class="col-12">: SPMR 120304EN P35M25</dd>
                                </dl>
                            </div>

                            <div class="col-3">
                                <dl class="row mb-0">
                                    <dt class="col-12">TYPE</dt>
                                    <dd class="col-12">: CAPTO</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">MAKER</dt>
                                    <dd class="col-12">: CERATIZIT</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">MATERIAL</dt>
                                    <dd class="col-12">: CARBIDE</dd>
                                </dl>
                                <dl class="row mb-0">
                                    <dt class="col-12">MARKING PROGRAM</dt>
                                    <dd class="col-12">: 0008</dd>
                                </dl>
                            </div>

                            <div class="col-3">
                                <dl class="row mb-0">
                                    <dt class="col-12">UNIT</dt>
                                    <dd class="col-12">: SET</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">PRICE</dt>
                                    <dd class="col-12">: Rp. 900.000</dd>
                                </dl>

                                <dl class="row mb-0">
                                    <dt class="col-12">REPLACEMENT</dt>
                                    <dd class="col-12">: 20.000</dd>
                                </dl>
                                <dl class="row mb-0">
                                    <dt class="col-12">JUDGEMENT</dt>
                                    <dd class="col-12">: INDEXING</dd>
                                </dl>
                            </div>

                            <div class="col-3">
                                <dl class="row mb-0">
                                    <dt class="col-12">MAX INDEXING/ REGRIND</dt>
                                    <dd class="col-12">: 5</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-abnormal">
            <div class="row mb-3">
                <div class="col-8">
                    <p class="judul-menu"><i></i>Abnormality List</p>
                </div>
                <div class="col-4">
                    <div class="input-group style-search w-100">
                        <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="gridtable">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>TOOL</th>
                            <th>QR CODE</th>
                            <th>PART NO</th>
                            <th>ENGINEERING NO</th>
                            <th>HES NO</th>
                            <th>SPESIFICATION</th>
                            <th>TYPE</th>
                            <th>MAKER</th>
                            <th>MATERIAL</th>
                            <th>PRICE</th>
                            <th>PIC</th>
                            <th></th>
                            {{-- <th>ACTION</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbodybackto">
                        @for($i = 1; $i <= 10; $i++)
                            <tr>
                                <td>{{$i}}</td>
                                <td>Cutting Tool</td>
                                <td>1.JC547.23.00001</td>
                                <td>08-91-00137</td>
                                <td>C202017</td>
                                <td>IN-5NC012</td>
                                <td>SPMR 120304EN P35M25 (CERATIZIT)</td>
                                <td>CAPTO</td>
                                <td>CERATIZIT</td>
                                <td>CARBIDE</td>
                                <td>Rp. 900.000</td>
                                <td>KANG DRU</td>
                                <td></td>
                                {{-- <td>
                                    <button class="btn btn-icon-edit" type="button" data-item="" data-name="edit"><i class="bi bi-pencil-square"></i></button>
                                </td> --}}
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    $(".select-2").select2({
        allowClear: false,
        width: '100%',
    });
</script>

@stop