
@include('templates.header')
<!--**********************************
    Header end ti-comment-alt
***********************************-->

<!--**********************************
    Sidebar start
***********************************-->
{{-- import templates/sidebar/admin --}}
@include('templates.sidebar.admin')

{{-- buatkan tampilan detail Item --}}
<div class="content-body">
    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
            <script>
                Swal.fire(
                    'Gagal Ditambahkan',
                    'Silahkan isi semua data dengan benar',
                    'error'
                )
            </script>
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container">
        <h1 class="mb-0 fw-bold">Tambah Karyawan</h1>
    </div>

    <div class="container mt-5">
       <form action="/admin/karyawan?role={{ request()->input('role') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- image  dengan preview--}}
        <div class="form-group">
            <label for="image">Gambar Item</label>
            <br/>
            <input name="image" type="file" class="form-control" id="imageInput" accept="image/*" onchange="previewImage()">
            <div id="imagePreview" style="display: none;">
                <img width="200" src="" alt="Pratinjau Gambar" id="preview">
            </div>
        </div>


        <div class="form-group">
            <label for="name">Nama {{ request()->input('role') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="description">Email {{ request()->input('role') }}</label>
            {{-- pakai text --}}
            <input type="e" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="description">Password {{ request()->input('role') }}</label>
            {{-- pakai text --}}
            <input type="e" class="form-control" id="password" name="password" placeholder="Masukkan password" value="{{ old('name') }}">
        </div>

        <button class="btn btn-primary mb-5" type="submit">Tambah</button>
       </form>
    </div>

    <script>
        function previewImage() {
            var preview = document.getElementById('preview');
            var fileInput = document.getElementById('imageInput');
            var imagePreview = document.getElementById('imagePreview');

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    imagePreview.style.display = 'block'; // Menampilkan pratinjau gambar
                };

                reader.readAsDataURL(fileInput.files[0]);
            } else {
                preview.src = 'placeholder.jpg'; // Menggunakan gambar placeholder jika tidak ada gambar yang dipilih
                imagePreview.style.display = 'block'; // Menampilkan pratinjau gambar placeholder
            }
        }
    </script>


</div>

@include('templates.footer')
