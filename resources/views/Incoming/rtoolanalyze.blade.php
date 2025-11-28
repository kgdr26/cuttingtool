@extends('main')
@section('content')

<section>
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-8">
                <p class="judul-menu"><i></i>Assy List</p>
            </div>
            <div class="col-4">
                <div class="input-group style-search w-100">
                    <input type="text" id="qr_holder" class="form-control" placeholder="Scan Holder" aria-describedby="basic-addon2">
                    {{-- button --}}
                    <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-qr-code"></i></button>
                    {{-- <a href="{{route('rdetailtoolanalyze')}}" class="input-group-text" id="basic-addon2"><i class="bi bi-qr-code"></i></a> --}}
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
                        <th>ACTUAL LIFETIME</th>
                    </tr>
                </thead>
                <tbody id="datatoolanalyze">
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- initiate data --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getToolAnalyze();
    });

    const getToolAnalyze = () => {
        fetch("{{route('gettoolanalyze')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            let html = '';
            for (let i = 0; i < data.arr.length; i++) {
                html += `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${data.arr[i].id_assy}</td>
                        <td>${data.arr[i].holder_qr_code}</td>
                        <td>${data.arr[i].zoller_z_value}</td>
                        <td>${data.arr[i].zoller_x_value}</td>
                        <td>${data.arr[i].actual_lifetime}</td>
                    </tr>
                `;
                
            }

            document.getElementById('datatoolanalyze').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
    }
</script>

{{-- enter on search --}}
<script>
    document.getElementById('qr_holder').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            let qr_holder = document.getElementById('qr_holder').value;
            if (qr_holder === '') {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: 'Please Scan QR Holder',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                let qr_holder = btoa(document.getElementById('qr_holder').value);
                window.location.href = "{{route('rdetailtoolanalyze')}}?qr_holder=" + qr_holder;
            }
        }
    });
</script>

@stop