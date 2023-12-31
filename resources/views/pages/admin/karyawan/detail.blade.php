@include('templates.header')

@include('templates.sidebar')


{{-- buatkan tampilan detail item --}}
<div class="page-wrapper">

    <div class="container">
        <h1 class="mb-0 fw-bold">Detail item</h1>
    </div>

    <div class="container form-add mt-3">

        <div class="form-group">
            <label for="nama">Gambar item</label>
            <br/>
            <img width="200" src="{{ asset($item->image) }}" alt="Pratinjau Gambar" id="preview">
        </div>

        <div class="form-group">
            <label for="nama">Nama item</label>
            <br/>
            <input name="name"  type="text" class="form-control" id="nama" placeholder="Masukkan nama item" value="{{ $item->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi item</label>
            <br/>
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Masukkan deskripsi item" disabled>{{ $item->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Harga item</label>
            <br/>
            <input name="price"  type="text" class="form-control" id="price" placeholder="Masukkan harga item" value="{{ $item->price }}" disabled>
        </div>

        <div class="form-group">
            <label for="stock">Stok item</label>
            <br/>
            <input name="stock"  type="text" class="form-control" id="stock" placeholder="Masukkan stok item" value="{{ $item->stock }}" disabled>
        </div>

        <div class="form-group">
            <label for="warehouse_id">Gudang item</label>
            <br/>
            <input name="warehouse_id"  type="text" class="form-control" id="warehouse_id" placeholder="Masukkan gudang item" value="{{ $item->gudang->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="type">Category item</label>
            <br/>
            <input name="type"  type="text" class="form-control" id="type" placeholder="Masukkan type item" value="{{ $item->category->name }}" disabled>
        </div>


        <div class="flex">
            <a  href="/item/{{ $item->id }}/edit">
                <button class="btn btn-warning mb-5 black" type="button">Edit</button>
            </a>
            <a  href="#">
                <button class="btn btn-danger mb-5" type="button" data-toggle="modal" data-target="#exampleModal">Hapus</button>
            </a>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title font-weight-bold red" id="exampleModalLabel">Peringatan !!!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Apakah anda yakin untuk menghapus data item dengan nama <span class="font-weight-bold">{{ $item->name }}</span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
            <form action="/item/{{ $item->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
            </div>
        </div>
        </div>
        </div>
    </div>



@include('templates.footer')
