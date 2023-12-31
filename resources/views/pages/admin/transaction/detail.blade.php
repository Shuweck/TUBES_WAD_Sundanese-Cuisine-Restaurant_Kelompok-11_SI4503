
@include('templates.header')
<!--**********************************
    Header end ti-comment-alt
***********************************-->

<!--**********************************
    Sidebar start
***********************************-->
{{-- import templates/sidebar/admin --}}
@include('templates.sidebar.admin')
<!--**********************************
    Sidebar end
***********************************-->
@if (session('warning'))
<script>
    Swal.fire(
        'Transaksi Gagal',
        'Uang yang dibayarkan kurang',
        'error'
    )
</script>
@endif
<!--**********************************
    Content body start
***********************************-->
<div class="container content-body">

    <div class="mt-3">
        <div class="flex-column d-flex">
            <div class="menu-minuman justify-content-end m-1">
              <h1>Detail Transaksi</h1>
            </div>
          </div>
    </div>

    <h4>Nomor Meja: {{ $transaksi->table_id }}</h4>

    <h3 class="mt-5">Item yang dipesan</h3>
    <table class="table mt-2">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Item</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->order as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->menu->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->getTotalAttribute() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="mt-5">Total Harga: {{ $transaksi->total_harga }}</h3>

    {{-- masukan uang bayar --}}
    <form action="/admin/transaction/{{ $transaksi->transaksi_id }}/pay" method="POST">
        @csrf
        <div class="form-group">
            <label for="uang_bayar">Masukan uang bayar</label>
            <input name="uang_bayar" type="number" class="form-control" id="uang_bayar" placeholder="Masukkan uang bayar">
        </div>

        <button type="submit" class="btn btn-primary">Bayar</button>
    </form>

    <!--**********************************
        Footer start
    ***********************************-->
    <!--**********************************
        Footer end
    ***********************************-->
</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
{{-- footer --}}
@include('templates.footer')

</body>

</html>
