
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

    @if (session('delete'))
        <script>
            Swal.fire(
                'Sukses Dihapus',
                'Berhasil menghapus data karyawan',
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
                  <h1>Chef</h1>
                </div>

                <div class="button justify-content-start m-1">
                    <a href="karyawan/add?role=chef">
                        <button class="btn btn-primary">+ Tambah Chef</button>
                    </a>
                </div>
              </div>

            <table class="table mt-2">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Profile</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                    <tbody>
                        @foreach ($chef as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{ $item->profile }}" alt="Profile" style="width: 50px; height: 50px; border-radius: 50%;">
                            </td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->email}}</td>
                            <td>
                                <a href="karyawan/{{ $item->id }}/edit">
                                    <button class="btn btn-primary">Edit</button>
                                </a>
                                <a  href="#">
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#chef{{ $item->id }}">Hapus</button>
                                </a>
                            </td>
                        </tr>
                        <div class="modal fade" id="chef{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="chef{{ $item->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title font-weight-bold red" id="chef{{ $item->id }}Label">Peringatan !!!</h5>
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

            <div class="flex-column d-flex mt-5">
                <div class="menu-minuman justify-content-end m-1">
                  <h1>Waiter</h1>
                </div>

                <div class="button justify-content-start m-1">
                    <a href="karyawan/add?role=waiter">
                        <button class="btn btn-primary">+ Tambah Waiter</button>
                    </a>
                </div>
              </div>
            <table class="table mt-2">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Profile</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                    <tbody>
                        @foreach ($waiter as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{ $item->profile }}" alt="Profile" style="width: 50px; height: 50px; border-radius: 50%;">
                            </td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->email}}</td>
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
