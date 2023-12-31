
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

<!--**********************************
    Content body start
***********************************-->
<div class="container content-body">

    <div class="mt-3">
        <div class="flex-column d-flex">
            <div class="menu-minuman justify-content-end m-1">
              <h1>Tambah Minuman</h1>
            </div>
          </div>
    </div>

    <div class="form-add mt-5">
        <form id="form-unggah" action="/admin/menu/minuman/{{ $minuman->slug }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Gambar Minuman</label>
                <input name="image" id="input-gambar" type="file" class="form-control input-default" placeholder="Input Default">
                <img id="preview-gambar" src="{{ asset($minuman->image) }}" width="300px" alt="Preview Gambar" >
            </div>

            <div class="form-group">
                <label for="nama">Nama Minuman</label>
                <input name="name" type="text" value={{ $minuman->name }} class="form-control" id="nama" placeholder="Masukkan nama Minuman" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Minuman</label>
                <textarea name="description" class="form-control" id="deskripsi" rows="3" placeholder="Masukkan deskripsi Minuman" required>{{ $minuman->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga Minuman</label>
                <input name="price" value={{ $minuman->price }} type="number" class="form-control" id="harga" placeholder="Masukkan harga Minuman" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock Minuman</label>
                <input name="stock" value={{ $minuman->stock }} type="number" class="form-control" id="stock" placeholder="Masukkan stock Minuman" required>
            </div>

            <div class="form-group">
                <label for="stock">Status Minuman</label>
                <select name="status" class="form-control" id="status" required>
                    <option value="tersedia" {{ $minuman->status == true ? 'selected' : '' }}>Tersedia</option>
                    <option value="habis" {{ $minuman->status == false ? 'selected' : '' }}>Habis</option>
                </select>
            </div>

            <button class="btn btn-success" type="submit" >Edit Minuman</button>
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


<script>
    const inputGambar = document.getElementById('input-gambar');
    const previewGambar = document.getElementById('preview-gambar');

    inputGambar.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewGambar.src = e.target.result;
                previewGambar.style.display = 'block';
            }

            reader.readAsDataURL(file);
        } else {
            previewGambar.src = '';
            previewGambar.style.display = 'none';
        }
    });
</script>

</body>

</html>
