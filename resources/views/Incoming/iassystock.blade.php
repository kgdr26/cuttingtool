@extends('main')
@section('content')

<section>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-8">
                <p class="judul-menu"><i></i>Assy Stock</p>
            </div>
            <div class="col-4">
                <div class="input-group style-search w-100">
                    <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                    <button type="button" class="input-group-text" id="basic-addon2" data-name=""><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ASSY TOOL</th>
                        <th>QR HOLDER</th>
                        <th>Z VALUE</th>
                        <th>X VALUE</th>
                        <th>STATUS</th>
                        <th>ACTUAL LIFETIME</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="getassystock">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>1.20.01.23.001</td>
                            <td>1.JC547.23.016;12001</td>
                            <td>170.051 mm</td>
                            <td>10.060 mm</td>
                            <td>
                                <div class="card-status st-{{$i}}"></div>
                            </td>
                            <td>2.000</td>
                        </tr>
                    @endfor --}}
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- inisiasi data --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getAssyStock();
    });

    const getAssyStock = () => {
        fetch("{{route('getassystock')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            }
        })
        .then(response => response.json())
        .then(data => {
            let html = '';
            console.log(data)
            if(data.status){
                data.arr.forEach((item, index) => {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.id_assy}</td>
                            <td>${item.holder_qr_code}</td>
                            <td>${item.zoller_z_value}</td>
                            <td>${item.zoller_x_value}</td>
                            <td>
                                <div class="card-status st-${item.id_location}"></div>
                            </td>
                            <td>${item.actual_lifetime}</td>
                        </tr>
                    `;
                });
                document.getElementById('getassystock').innerHTML = html;
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

@stop