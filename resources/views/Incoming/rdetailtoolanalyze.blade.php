@extends('main')
@section('content')

<section>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card-auto p-0">
                    <div class="card-header-information">
                        ASSY INFORMATION
                    </div>
                    <div class="card-body-information">
                        <div class="row">
                            <div class="col-2">
                                <dl class="row mb-0">
                                    <dt class="col-12">PLANT ID</dt>
                                    <dd class="col-12" id="id_plant"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">WCT ID</dt>
                                    <dd class="col-12" id="id_wct"></dd>
                                </dl>
                            </div>
                            <div class="col-2">
                                <dl class="row mb-0">
                                    <dt class="col-12">OP NAME</dt>
                                    <dd class="col-12" id="op_name"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">ASSET NO</dt>
                                    <dd class="col-12" id="asset_id"></dd>
                                </dl>
                            </div>
                            <div class="col-2">
                                <dl class="row mb-0">
                                    <dt class="col-12">MACHINE NAME</dt>
                                    <dd class="col-12" id="machine_name"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">ASSY TOOL</dt>
                                    <dd class="col-12" id="id_assy"></dd>
                                </dl>
                            </div>
                            <div class="col-2">
                                <dl class="row mb-0">
                                    <dt class="col-12">TOOL PORT</dt>
                                    <dd class="col-12" id="tool_port"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">ACTUAL LIFETIME</dt>
                                    <dd class="col-12" id="total_inject"></dd>
                                </dl>
                            </div>
                            <div class="col-2">
                                <dl class="row mb-0">
                                    <dt class="col-12">INSTALLED</dt>
                                    <dd class="col-12" id="start_install"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">PIC INSTALLED</dt>
                                    <dd class="col-12" id="id_user_install"></dd>
                                </dl>
                            </div>
                            <div class="col-2">
                                <dl class="row mb-0">
                                    <dt class="col-12">UNINSTALLED</dt>
                                    <dd class="col-12" id="end_install"></dd>
                                </dl>
        
                                <dl class="row mb-0">
                                    <dt class="col-12">PIC UNINSTALLED</dt>
                                    <dd class="col-12" id="id_user_uninstall"></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- cutting tool row --}}
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-start">
                    <p class="text-judul"><i class="bi bi-dot"></i> Cutting Tool</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-10">
                <div class="gridtable-tool">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>SPESIFICATION</th>
                                <th>TYPE</th>
                                <th>QR CODE</th>
                                <th>JUDGEMENT</th>
                                <th>ACTUAL LIFETIME</th>
                                <th>MAX REGRIND / INDEXING</th>
                                <th>ACTION</th>
                                <th>RESULT</th>
                                <th>REASON</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody id="tool">
                            {{-- @for($i = 1; $i <= 10; $i++)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>Single Edged Square BT</td>
                                    <td>CAPTO</td>
                                    <td>HN547.23.00001</td>
                                    <td>INDEXING</td>
                                    <td>2.000 of 4000</td>
                                    <td>3 of 4</td>
                                    <td>
                                        <fieldset>
                                            <input type="radio" class="ok_radio" id="ok_tool_{{$i}}" name="action_tool_{{$i}}"/>
                                            <label class="label-radio" for="ok_tool_{{$i}}">OK</label>
                                          
                                            <input type="radio" class="ng_radio" id="ng_tool_{{$i}}" name="action_tool_{{$i}}"/>
                                            <label class="label-radio" for="ng_tool_{{$i}}">NG</label>
                                        </fieldset>
                                    </td>
                                    <td>OK</td>
                                    <td>
                                        <select class="form-select select-2" name="" id="">
                                            @for($k = 1; $k < 10; $k++)
                                                <option value="{{$k}}">Reason {{$k}}</option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                            @endfor --}}
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-2">
                <div class="card-count">
                    <div class="card-count-header-ok">
                        OK
                    </div>
                    <div class="card-count-body-ok">
                        <span class="text-val-count" id="box_tool_ok">0</span>
                    </div>
                    <div class="card-count-header-ng">
                        NG
                    </div>
                    <div class="card-count-body-ng">
                        <span class="text-val-count" id="box_tool_ng">0</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- holder row --}}
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-start">
                    <p class="text-judul"><i class="bi bi-dot"></i> Holder</p>
                </div>
            </div>
        </div>
 
        <div class="row">
            <div class="col-10">
                <div class="gridtable-holder">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>SPESIFICATION</th>
                                <th>TYPE</th>
                                <th>QR CODE</th>
                                <th>ACTUAL LIFETIME</th>
                                <th>MAX LIFETIME</th>
                                <th>ACTION</th>
                                <th>RESULT</th>
                                <th>REASON</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="holder">
                            {{-- <tr>
                                <td>1</td>
                                <td>Single Edged Square BT</td>
                                <td>CAPTO</td>
                                <td>HN547.23.00001</td>
                                <td>2.000</td>
                                <td>4.000</td>
                                <td>
                                    <fieldset>
                                        <input type="radio" class="ok_radio" id="ok" name="action_holder"/>
                                        <label class="label-radio" for="ok">OK</label>
                                      
                                        <input type="radio" class="ng_radio" id="ng" name="action_holder"/>
                                        <label class="label-radio" for="ng">NG</label>
                                    </fieldset>
                                </td>
                                <td>OK</td>
                                <td>
                                    <select class="form-select select-2" name="" id="">
                                        @for($k = 1; $k < 10; $k++)
                                            <option value="{{$k}}">Reason {{$k}}</option>
                                        @endfor
                                    </select>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-2">
                <div class="card-count">
                    <div class="card-count-header-ok">
                        OK
                    </div>
                    <div class="card-count-body-ok">
                        <span class="text-val-count" id="box_holder_ok">0</span>
                    </div>
                    <div class="card-count-header-ng">
                        NG
                    </div>
                    <div class="card-count-body-ng">
                        <span class="text-val-count" id="box_holder_ng">0</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- acc row --}}
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-start">
                    <p class="text-judul"><i class="bi bi-dot"></i> Accessories</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-10">
                <div class="gridtable-accesories">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>SPESIFICATION</th>
                                <th>TYPE</th>
                                <th>QR CODE</th>
                                <th>ACTUAL LIFETIME</th>
                                <th>MAX LIFETIME</th>
                                <th>ACTION</th>
                                <th>REASON</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody id="accesories">
                            {{-- @for($i = 1; $i <= 10; $i++)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>Single Edged Square BT</td>
                                    <td>CAPTO</td>
                                    <td>HN547.23.00001</td>
                                    <td>2.000</td>
                                    <td>4.000</td>
                                    <td>
                                        <fieldset>
                                            <input type="radio" class="ok_radio" id="ok_acces_{{$i}}" name="action_accesories_{{$i}}"/>
                                            <label class="label-radio" for="ok_acces_{{$i}}">OK</label>
                                          
                                            <input type="radio" class="ng_radio" id="ng_acces_{{$i}}" name="action_accesories_{{$i}}"/>
                                            <label class="label-radio" for="ng_acces_{{$i}}">NG</label>
                                        </fieldset>
                                    </td>
                                    <td>
                                        <select class="form-select select-2" name="" id="">
                                            @for($k = 1; $k < 10; $k++)
                                                <option value="{{$k}}">Reason {{$k}}</option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                            @endfor --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-2">
                <div class="card-count">
                    <div class="card-count-header-ok">
                        OK
                    </div>
                    <div class="card-count-body-ok">
                        <span class="text-val-count" id="box_acc_ok">0</span>
                    </div>
                    <div class="card-count-header-ng">
                        NG
                    </div>
                    <div class="card-count-body-ng">
                        <span class="text-val-count" id="box_acc_ng">0</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="" class="btn btn-cancel me-3" id="cancel"><span>Cancel</span></a>
            <button type="button" class="btn btn-save" id="dismantle" disabled><span>Dismantle</span></button>
        </div>
    </div>
</section>

{{-- get data assy information onload --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let qr_holder = '{!! $qr_holder !!}'
        getAssyInformation(qr_holder);
        getDetailTool(qr_holder);
    });

    const getAssyInformation = (qr_holder) => {
        fetch("{{route('getassyinformation')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                qr_holder: qr_holder
            })
        })
        .then(response => response.json())
        .then(data => {
            let row = data.arr
            document.getElementById('id_plant').innerHTML = `: ${row.plant_id}`;
            document.getElementById('id_wct').innerHTML = `: ${row.wct_id}`;
            document.getElementById('op_name').innerHTML = `: ${row.op_name}`;
            document.getElementById('asset_id').innerHTML = `: ${row.asset_id}`;
            document.getElementById('machine_name').innerHTML = `: ${row.machine_name}`;
            document.getElementById('id_assy').innerHTML = `: ${row.id_assy}`;
            // set value for id_assy
            document.getElementById('id_assy').value = row.id_assy;
            document.getElementById('tool_port').innerHTML = `: ${row.tool_port}`;
            document.getElementById('total_inject').innerHTML = `: ${row.total_inject}`;
            document.getElementById('start_install').innerHTML = `: ${row.start_install}`;
            document.getElementById('id_user_install').innerHTML = `: ${row.user_name_install}`;
            document.getElementById('end_install').innerHTML = `: ${row.end_install}`;
            document.getElementById('id_user_uninstall').innerHTML = `: ${row.user_name_uninstall}`;

        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

<script>
    const getDetailTool = (qr_holder) => {
        fetch("{{route('detailtoolanalyze')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                qr_code: qr_holder
            })
        })
        .then(response => response.json())
        .then(data => {
            let html        = '';
            let html_holder = '';
            let html_acc    = '';

            if(data.tool.length > 0){
                for (let i = 0; i < data.tool.length; i++) {
                    let row = data.tool[i]
                    if(row.judgement == 'regrind'){
                        var max_lifetime                = row.replacement * row.max_regrind;
                        var max_total_regrind_indexing  = row.max_regrind;
                    }else {
                        var max_lifetime                = row.replacement * row.max_indexing;
                        var max_total_regrind_indexing  = row.max_indexing;
                    }

                    html += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${row.spesification}</td>
                            <td>${row.qr_code}</td>
                            <td>${row.tool_type}</td>
                            <td>${row.judgement}</td>
                            <td>${row.actual_lifetime} of ${max_lifetime}</td>
                            <td>${row.total_regrind_indexing} of ${max_total_regrind_indexing}</td>
                            <td>
                                <fieldset>
                                    <input type="radio" class="ok_radio action_tool" data-item="${row.qr_code}" data-type="tool" value="ok" id="ok_tool_${i}" name="action_tool_${i}"/>
                                    <label class="label-radio" for="ok_tool_${i}">OK</label>
                                  
                                    <input type="radio" class="ng_radio action_tool" data-item="${row.qr_code}" data-type="tool" value="ng" id="ng_tool_${i}" name="action_tool_${i}"/>
                                    <label class="label-radio" for="ng_tool_${i}">NG</label>
                                </fieldset>
                            </td>
                            <td>OK</td>
                            <td>
                                <select class="form-select select-2 select_bat" disabled name="id_bat_${row.qr_code}">
                                    `
                                    html += `
                                        <option value="0">No Reason</option>
                                    `
                                    for (let i = 0; i < data.bat.length; i++) {
                                        html += `
                                            <option value="${data.bat[i].id}">${data.bat[i].bat_desc}</option>
                                        `                                        
                                    }
                                    `
                                </select>
                            </td>

                        </tr>
                    `;
                }
                document.getElementById('tool').innerHTML = html;
            }

            if(data.holder.length > 0){
                for (let i = 0; i < data.holder.length; i++) {
                    let row = data.holder[i]
                    html_holder += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${row.spesification}</td>
                            <td>${row.holder_type}</td>
                            <td>${row.qr_code}</td>
                            <td>${row.actual_lifetime}</td>
                            <td>${row.lifetime}</td>
                            <td>
                                <fieldset>
                                    <input type="radio" class="ok_radio action_holder" data-item="${row.qr_code}" data-type="holder" value="ok" id="ok_holder_${i}" name="action_holder_${i}"/>
                                    <label class="label-radio" for="ok_holder_${i}">OK</label>
                                  
                                    <input type="radio" class="ng_radio action_holder" data-item="${row.qr_code}" data-type="holder" value="ng" id="ng_holder_${i}" name="action_holder_${i}"/>
                                    <label class="label-radio" for="ng_holder_${i}">NG</label>
                                </fieldset>
                            </td>
                            <td>OK</td>
                            <td>
                                <select class="form-select select-2 select_bat" disabled name="id_bat_${row.qr_code}">
                                    `
                                    html_holder += `
                                        <option value="0">No Reason</option>
                                    `
                                    for (let i = 0; i < data.bat.length; i++) {
                                        html_holder += `
                                            <option value="${data.bat[i].id}">${data.bat[i].bat_desc}</option>
                                        `                                        
                                    }
                                    `
                                </select>
                            </td>
                        </tr>
                    `;                    
                }

                document.getElementById('holder').innerHTML = html_holder;
            }

            if(data.acc.length > 0){
                for (let i = 0; i < data.acc.length; i++) {
                    let row = data.acc[i]
                    html_acc += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${row.spesification}</td>
                            <td>${row.acc_type}</td>
                            <td>${row.part_no}</td>
                            <td>${row.actual_lifetime}</td>
                            <td>${row.lifetime}</td>
                            <td>
                                <fieldset>
                                    <input type="radio" class="ok_radio action_acc" data-item="${row.part_no}" data-type="acc" value="ok" id="ok_acc_${i}" name="action_acc_${i}" value="ok"/>
                                    <label class="label-radio" for="ok_acc_${i}">OK</label>
                                  
                                    <input type="radio" data-item="${row.part_no}" data-type="acc" value="ng" class="ng_radio action_acc" id="ng_acc_${i}" name="action_acc_${i}" value="ng"/>
                                    <label class="label-radio" for="ng_acc_${i}">NG</label>
                                </fieldset>
                            </td>
                            <td>
                                <select class="form-select select-2 select_bat" disabled name="id_bat_${row.part_no}">
                                    `
                                    html_acc += `
                                        <option value="0">No Reason</option>
                                    `
                                    for (let i = 0; i < data.bat.length; i++) {
                                        html_acc += `
                                            <option value="${data.bat[i].id}">${data.bat[i].bat_desc}</option>
                                        `                                        
                                    }
                                    `
                                </select>
                            </td>
                        </tr>
                    `;
                                        
                }

                document.getElementById('accesories').innerHTML = html_acc;
            }

        })
        .catch(error => console.error('Error:', error));

    }
</script>

{{-- action button --}}
<script>
    // ok radio tool class action_tool
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('action_tool')){
            let qr_code     = e.target.getAttribute('data-item');
            let type        = e.target.getAttribute('data-type');
            let value       = e.target.getAttribute('value');
            let arr_tool    = [];

            if(type == 'tool'){
                let arr = document.querySelectorAll('.action_tool');
                arr.forEach((item) => {
                    if(item.checked){
                        arr_tool.push(
                            {
                                qr_code: item.getAttribute('data-item'),
                                value: item.getAttribute('value')
                            }
                        );
                    }
                });
            }
        }

        if(e.target.classList.contains('action_holder')){
            let qr_code     = e.target.getAttribute('data-item');
            let type        = e.target.getAttribute('data-type');
            let value       = e.target.getAttribute('value');
            let arr_holder  = [];

            let arr = document.querySelectorAll('.action_holder');
            arr.forEach((item) => {
                if(item.checked){
                    arr_holder.push(
                        {
                            qr_code: item.getAttribute('data-item'),
                            value: item.getAttribute('value')
                        }
                    );
                }
            });
        }

        if(e.target.classList.contains('action_acc')){
            let qr_code     = e.target.getAttribute('data-item');
            let type        = e.target.getAttribute('data-type');
            let value       = e.target.getAttribute('value');
            let arr_acc     = [];

            let arr = document.querySelectorAll('.action_acc');
            arr.forEach((item) => {
                if(item.checked){
                    arr_acc.push(
                        {
                            qr_code: item.getAttribute('data-item'),
                            value: item.getAttribute('value')
                        }
                    );
                }
            });
        }

        // fill box box_tool_ok, box_tool_ng, box_holder_ok, box_holder_ng, box_acc_ok, box_acc_ng
        let arr_tool_ok = [];
        let arr_tool_ng = [];
        let arr_holder_ok = [];
        let arr_holder_ng = [];
        let arr_acc_ok = [];
        let arr_acc_ng = [];

        let arr = document.querySelectorAll('.action_tool');
        arr.forEach((item) => {
            if(item.checked){
                if(item.getAttribute('value') == 'ok'){
                    arr_tool_ok.push(item.getAttribute('value'));
                    // selected value to no reason with text No Reason
                    let select = document.querySelector(`select[name="id_bat_${item.getAttribute('data-item')}"]`);
                    select.value = '0'; // Set the value directly to '0'
                    select.disabled = true; // Disable the select element
                }else {
                    arr_tool_ng.push(item.getAttribute('value'));
                    
                    // enable select reason
                    let select = document.querySelector(`select[name="id_bat_${item.getAttribute('data-item')}"]`);
                    select.removeAttribute('disabled');    
                }
            }
        });

        let arr_holder = document.querySelectorAll('.action_holder');
        arr_holder.forEach((item) => {
            if(item.checked){
                if(item.getAttribute('value') == 'ok'){
                    arr_holder_ok.push(item.getAttribute('value'));
                    let select = document.querySelector(`select[name="id_bat_${item.getAttribute('data-item')}"]`);
                    select.value = '0'; // Set the value directly to '0'
                    select.disabled = true; // Disable the select element
                }else {
                    arr_holder_ng.push(item.getAttribute('value'));
                    // enable select reason
                    let select = document.querySelector(`select[name="id_bat_${item.getAttribute('data-item')}"]`);
                    select.removeAttribute('disabled');
                }
            }
        });

        let arr_acc = document.querySelectorAll('.action_acc');
        arr_acc.forEach((item) => {
            if(item.checked){
                if(item.getAttribute('value') == 'ok'){
                    arr_acc_ok.push(item.getAttribute('value'));
                    let select = document.querySelector(`select[name="id_bat_${item.getAttribute('data-item')}"]`);
                    select.value = '0'; // Set the value directly to '0'
                    select.disabled = true; // Disable the select element
                }else {
                    arr_acc_ng.push(item.getAttribute('value'));
                    
                    // enable select reason
                    let select = document.querySelector(`select[name="id_bat_${item.getAttribute('data-item')}"]`);
                    select.removeAttribute('disabled');
                }
            }
        });

        document.getElementById('box_tool_ok').innerHTML = arr_tool_ok.length;
        document.getElementById('box_tool_ng').innerHTML = arr_tool_ng.length;
        document.getElementById('box_holder_ok').innerHTML = arr_holder_ok.length;
        document.getElementById('box_holder_ng').innerHTML = arr_holder_ng.length;
        document.getElementById('box_acc_ok').innerHTML = arr_acc_ok.length;
        document.getElementById('box_acc_ng').innerHTML = arr_acc_ng.length;

        // save selected reason to each array
        let arr_bat = [];
        let select_bat = document.querySelectorAll('.select_bat');
        select_bat.forEach((item) => {
            if(item.value != ''){
                arr_bat.push(
                    {
                        qr_code: item.name,
                        id_bat: item.value
                    }
                );
            }
        });

        // check total radio button in tool
        let count_acc    = document.querySelectorAll('.action_acc').length / 2;
        let count_holder = document.querySelectorAll('.action_holder').length / 2;
        let count_tool   = document.querySelectorAll('.action_tool').length / 2;

        if(count_acc == arr_acc_ok.length + arr_acc_ng.length && count_holder == arr_holder_ok.length + arr_holder_ng.length && count_tool == arr_tool_ok.length + arr_tool_ng.length){
            document.getElementById('dismantle').removeAttribute('disabled');
        }else {
            document.getElementById('dismantle').setAttribute('disabled', 'disabled');
        }
    });   
</script>

{{-- onclick dismantle, get qr_code,action_button_value,reason --}}
<script>
    document.getElementById('dismantle').addEventListener('click', function() {
        let qr_holder = '{!! $qr_holder !!}';
        let arr_tool = [];
        let arr_holder = [];
        let arr_acc = [];
        let arr_bat = [];

        let click_tool = document.querySelectorAll('.action_tool');
        click_tool.forEach((item) => {
            if(item.checked){
                arr_tool.push(
                    {
                        qr_code: item.getAttribute('data-item'),
                        value: item.getAttribute('value')
                    }
                );
            }
        });

        let click_holder = document.querySelectorAll('.action_holder');
        click_holder.forEach((item) => {
            if(item.checked){
                arr_holder.push(
                    {
                        qr_code: item.getAttribute('data-item'),
                        value: item.getAttribute('value')
                    }
                );
            }
        });

        let click_acc = document.querySelectorAll('.action_acc');
        click_acc.forEach((item) => {
            if(item.checked){
                arr_acc.push(
                    {
                        qr_code: item.getAttribute('data-item'),
                        value: item.getAttribute('value')
                    }
                );
            }
        });

        let select_bat = document.querySelectorAll('.select_bat');
        select_bat.forEach((item) => {
            if(item.value != ''){
                arr_bat.push(
                    {
                        qr_code: item.name,
                        id_bat: item.value,
                    }
                );
            }
        });

        console.log(arr_tool);
        console.log(arr_holder);
        console.log(arr_acc);
        console.log(arr_bat);

        let id_assy = document.getElementById('id_assy').value;

        fetch("{{route('dismantle')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id_assy: id_assy,
                qr_holder: qr_holder,
                arr_tool: arr_tool,
                arr_holder: arr_holder,
                arr_acc: arr_acc,
                arr_bat: arr_bat
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data.status){
                swal.fire({
                    title: 'Success',
                    text: 'Dismantle Success',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if(result.isConfirmed){
                        window.location.href = "{{route('rtoolanalyze')}}";
                    }
                });
            }
        })
        .catch(error => console.error('Error:', error)
        );
        
    });
</script>



<script>
    $(".select-2").select2({
        allowClear: false,
        width: '100%',
    });
</script>

@stop