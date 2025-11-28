@extends('main')
@section('content')

<section>
    <div class="grid-flow">
        <div class="card-step">
            <div class="header">
                <p>STEP 3 Verify</p>
                {{-- <p>Verify</p> --}}
            </div>
            <div class="body">
                <div class="wizard-form">
                    <ul class="progressbar">
                        <li id="step_progress_1" class="float-start progressbar-list active">
                            <i></i>
                            <i></i>
                            <p>Step 1</p>
                            <p>Scan Machine</p>
                        </li>
                        <li id="step_progress_3" class="float-start progressbar-list active">
                            <i></i>
                            <i></i>
                            <p>Step 2</p>
                            <p>Scan New Tool</p>
                        </li>
                        <li id="step_progress_4" class="float-start progressbar-list active">
                            <i></i>
                            <i></i>
                            <p>Step 3</p>
                            <p>Verify</p>
                        </li>
                        <li id="step_progress_5" class="float-start progressbar-list">
                            <i></i>
                            <i></i>
                            <p>Step 4</p>
                            <p>Result</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-information">
            <div class="card-content-information">
                <div class="header">
                    Machine & Assy Tool Information
                </div>
                <div class="body">

                    <div class="row w-100">
                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Asset No</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="asset_id" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Machine Name</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="machine_name" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">OP Name</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="op_name" value="10" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Communication</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="ip_address" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Assy ID</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="assy_id_new" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="row">
                                <label for="" class="text-label col-12">Tool Port</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="tool_port" value="" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-table">
                        <table id="table_list_tool">
                            <thead>
                                <tr>
                                    <th>TYPE</th>
                                    <th>SPESIFICATION</th>
                                    <th>QR CODE</th>
                                    <th>LIFETIME</th>
                                    <th>MAX</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @for($i = 1; $i <= 9; $i++)
                                    <tr>
                                        <td rowspan="3">CUTTING TOOL</td>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                    <tr>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                    <tr>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                    <tr>
                                        <td>HOLDER</td>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">ACCESSORIES</td>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                    <tr>
                                        <td>Single Edged Square BT</td>
                                        <td>1.JC547.23.016;12001</td>
                                        <td>2.000</td>
                                        <td>4.000</td>
                                    </tr>
                                @endfor --}}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="card-button">
            <div class="row">
                <div class="col-6">
                    {{-- <a href="{{route('tfirstpokayokestep2')}}" class="btn btn-save w-100">PREVIOUS</a> --}}
                    <button id="step_2" class="btn btn-save w-100">PREVIOUS</button>
                </div>
                <div class="col-6">
                    {{-- <a href="{{route('tfirstpokayokestep4')}}" class="btn btn-save w-100">NEXT</a> --}}
                    <button id="step_4" class="btn btn-save w-100" disabled>NEXT</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('#table_list_tool').floatThead({
        scrollContainer: function ($table) {
            return $table.closest('.card-table');
        }
    });
</script>

{{-- inisiasi data --}}
<script>
    // add event listener onload
    document.addEventListener('DOMContentLoaded', function() {
        getinstallmachine();
        getinstallnewtool();
        document.getElementById('assy_id_new').value = '{!! $id_assy_new !!}';
        document.getElementById('tool_port').value   = '{!! $tool_port !!}';
    });
</script>

<script>
    const getinstallmachine = () => {
        let id_list_machine = '{!! $id_list_machine !!}';

        fetch("{{route('machinelistbyid')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id_list_machine: id_list_machine
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if(data.status) {
                let row = data.arr;
                document.getElementById('asset_id').value = row.asset_id;
                document.getElementById('machine_name').value = row.machine_name;
                document.getElementById('op_name').value = row.op_name;
                document.getElementById('ip_address').value = row.ip_address + ':' + row.port;
                document.getElementById('step_4').removeAttribute('disabled');
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

    }
</script>

<script>
    const getinstallnewtool = () => {
        let id_assy = '{!! $id_assy_new !!}';

        fetch("{{route('trxassybyassyid')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id_assy: id_assy
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
            if(data.status){
                let html        = '';
                let r_tool      = data.tool;
                let r_holder    = data.holder;
                let r_acc       = data.acc;
                
                for (let i = 0; i < r_tool.length; i++) {
                    html += '<tr>';
                    if(i == 0){
                        html += '<td rowspan="'+r_tool.length+'">CUTTING TOOL</td>';
                    }
                    if(r_tool[i].judgement == 'regrind'){
                        var lifetime = r_tool[i].replacement * r_tool[i].max_regrind;
                    }else {
                        var lifetime = r_tool[i].replacement * r_tool[i].max_indexing;
                    }

                    html += '<td>'+r_tool[i].spesification+'</td>';
                    html += '<td>'+r_tool[i].qr_code+'</td>';
                    html += '<td>'+r_tool[i].actual_lifetime+'</td>';
                    html += '<td>'+lifetime+'</td>';
                    html += '</tr>';
                }

                for (let i = 0; i < r_holder.length; i++) {
                    html += '<tr>';
                    if(i == 0){
                        html += '<td rowspan="'+r_holder.length+'">HOLDER</td>';
                    }

                    html += '<td>'+r_holder[i].spesification+'</td>';
                    html += '<td>'+r_holder[i].qr_code+'</td>';
                    html += '<td>'+r_holder[i].actual_lifetime+'</td>';
                    html += '<td>'+r_holder[i].lifetime+'</td>';
                    html += '</tr>';
                }

                for (let i = 0; i < r_acc.length; i++) {
                    html += '<tr>';
                    if(i == 0){
                        html += '<td rowspan="'+r_acc.length+'">ACCESSORIES</td>';
                    }

                    html += '<td>'+r_acc[i].spesification+'</td>';
                    html += '<td>'+r_acc[i].part_no+'</td>';
                    html += '<td>'+r_acc[i].actual_lifetime+'</td>';
                    html += '<td>'+r_acc[i].lifetime+'</td>';
                    html += '</tr>';
                }

                document.getElementById('table_list_tool').getElementsByTagName('tbody')[0].innerHTML = html;
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

{{-- previous click --}}
<script>
    document.getElementById('step_2').addEventListener('click', function() {
        let id_list_machine = btoa('{!! $id_list_machine !!}');
        let id_assy_new     = btoa('{!! $id_assy_new !!}');
        let tool_port       = btoa('{!! $tool_port !!}');

        window.location.href = "{{ route('tfirstpokayokestep2') }}" + '?id_list_machine=' + id_list_machine + '&id_assy_new=' + id_assy_new + '&tool_port=' + tool_port;
    });
</script>

{{-- next click --}}
<script>
    document.getElementById('step_4').addEventListener('click', function() {
        let id_list_machine = btoa('{!! $id_list_machine !!}');
        let id_assy_new     = btoa('{!! $id_assy_new !!}');
        let tool_port       = btoa('{!! $tool_port !!}');
        let status          = btoa(0);

        window.location.href = "{{ route('tfirstpokayokestep4') }}" + '?id_list_machine=' + id_list_machine + '&id_assy_new=' + id_assy_new + '&tool_port=' + tool_port + '&status=' + status;
    });
</script>

@stop