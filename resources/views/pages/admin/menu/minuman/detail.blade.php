
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
@if (session('error'))
<script>
    Swal.fire(
        'Tidak dapat menghapus menu minuman',
        'Menu minuman tidak dapat dihapus karena ada di transaksi tetapi kamu dapat mengubah status nya menjadi tidak tersedia',
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
              <h1>Detail minuman</h1>
            </div>
          </div>
    </div>

    <div class="form-add mt-3">
        <form id="form-unggah" action="/admin/menu/minuman" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="flex">
                <a  href="/admin/menu/minuman/{{ $minuman->slug }}/edit">
                    <button class="btn btn-warning mb-5" type="button">Edit Minuman</button>
                </a>
                <a  href="/admin/menu/minuman/{{ $minuman->slug }}/delete">
                    <button class="btn btn-danger mb-5" type="button">Hapus Minuman</button>
                </a>
            </div>



            <div class="form-group">
                <label for="nama">Gambar minuman</label>
                <br/>
                <img id="preview-gambar" src="{{ asset($minuman->image) }}" width="300px" alt="Preview Gambar">
            </div>

            <div class="form-group">
                <label for="nama">Nama minuman</label>
                <input name="name"  type="text" class="form-control" id="nama" placeholder="Masukkan nama minuman" value="{{ $minuman->name }}" disabled>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi minuman</label>
                <textarea name="description"  class="form-control" id="deskripsi" rows="3" placeholder="Masukkan deskripsi minuman" disabled>{{ $minuman->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga minuman</label>
                <input name="price" type="number" class="form-control" id="harga" placeholder="Masukkan harga minuman" value="{{ $minuman->price }}" disabled>
            </div>

            {{-- stock --}}
            <div class="form-group">
                <label for="stock">Stock minuman</label>
                <input name="stock" type="number" class="form-control" id="stock" placeholder="Masukkan stock minuman" value="{{ $minuman->stock }}" disabled>
            </div>

            {{-- jika status true maka button hijau jika false maka button merah --}}
            <div class="form-group">
                <label for="stock">Status minuman</label>
                <br/>
                @if ($minuman->status == true)
                    <button class="btn btn-success" type="button">Tersedia</button>
                @else
                    <button class="btn btn-danger" type="button">Tidak Tersedia</button>
                @endif
            </div>

        </form>
    </div>

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
