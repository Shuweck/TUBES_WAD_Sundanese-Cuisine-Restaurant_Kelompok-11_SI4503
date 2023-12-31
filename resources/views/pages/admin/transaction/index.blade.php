
@include('templates.header')
<!--**********************************
    Header end ti-comment-alt
***********************************-->

<!--**********************************
    Sidebar start
***********************************-->
{{-- import templates/sidebar/admin --}}
@include('templates.sidebar.admin')

<div class="content-body">

    @if (session('success'))
        <script>
            Swal.fire(
                'Transaksi Suksess',
                // tampilkan session
                '{{ session('success') }}',
                'success'
            )
        </script>
    @endif

    @if (session('add'))
        <script>
            Swal.fire(
                'Sukses Ditambah',
                'Berhasil menambah data karyawan',
                'success'
            )
        </script>
    @endif

    @if (session('edit'))
    <script>
        Swal.fire(
            'Sukses Diedit',
            'Berhasil mengubah data karyawan',
            'success'
        )
    </script>
    @endif

        <div class="container-fluid mt-3">

            {{-- BUAT TULISAN CHEF DIKIRI SERTA BUTTON TAMBAH DIKANAN --}}
            <div class="flex-column d-flex">
                <div class="menu-minuman justify-content-end m-1">
                  <h1>Belum Dibayar</h1>
                </div>

            <table class="table mt-2">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Transaksi ID</th>
                        <th scope="col">Nomor Meja</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Pesanan Dibuat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                    <tbody>
                        @foreach ($transaction_false as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->transaksi_id}}</td>
                            <td>{{ $item->table_id}}</td>
                            <td>{{ $item->total_harga}}</td>
                            <td>{{ $item->created_at}}</td>
                            <td>
                                <a href="transaction/{{ $item->transaksi_id }}">
                                    <button class="btn btn-primary">Detail</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>

            <div class="flex-column d-flex mt-5">
                <div class="menu-minuman justify-content-end m-1">
                  <h1>Sudah Dibayar</h1>
                </div>
              </div>
            <table class="table mt-2">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Transaksi Id</th>
                        <th scope="col">Meja</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                    <tbody>
                        @foreach ($transaction_true as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->transaksi_id}}</td>
                            <td>{{ $item->table_id}}</td>
                            <td>{{ $item->total_harga}}</td>
                            <td>
                                <a href="karyawan/{{ $item->id }}/edit">
                                    <button class="btn btn-primary">Edit</button>
                                </a>
                                <a  href="#">
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#waiter{{ $item->id }}">Hapus</button>
                                </a>
                            </td>
                        </tr>

                        <div class="modal fade" id="waiter{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="waiter{{ $item->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title font-weight-bold red" id="waiter{{ $item->id }}Label">Peringatan !!!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                Apakah anda yakin untuk menghapus data karyawan dengan nama <span class="font-weight-bold">{{ $item->name }}</span>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                                <form action="/admin/karyawan/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
            </table>

        </div>

        {{-- <h3 class="mb-0 fw-bold">Sudah Dibayar</h3>
        <table class="table mt-2">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Transaksi Id</th>
                    <th scope="col">Costumer</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
              </thead>

                <tbody>
                    @foreach ($waiter as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->transaksi_id }}</td>
                        <td>{{ $item->costumer->name}}</td>
                        <td>{{ $item->getTotakaryawan() }}</td>
                        <td>
                            <a href="karyawan/{{ $item->id }}/detail">
                                <button class="btn btn-primary">Detail</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table> --}}

    </div>

</div>


@include('templates.footer')
