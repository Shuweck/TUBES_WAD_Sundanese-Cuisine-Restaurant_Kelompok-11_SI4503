<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <?php

    // functin convert rupiah

    ?>

    <script>
        let keranjang = JSON.parse(localStorage.getItem('keranjang')) ? JSON.parse(localStorage.getItem('keranjang')) : [];
        let jumlahKeranjang = keranjang ? keranjang.length : 0;
        let totalHarga = 0;
        function convertRupiah(number){
            let rupiah = ''
            let numberrev = number.toString().split('').reverse().join('')
            for(let i = 0; i < numberrev.length; i++) if(i%3 == 0) rupiah += numberrev.substr(i,3)+'.'
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('')+',00'
        }
    </script>

    <section id="Home">
        <nav>
            <div class="logo">
                <img src="/images/home/logo1.jpg">
            </div>

            <ul>
                <li><a href="#Home">Home</a></li>
                <li><a href="#About">About</a></li>
                <li><a href="#Menu">Menu</a></li>
                <li><a href="#Gallary">Gallary</a></li>
                <li><a href="#Review">Review</a></li>
                <li><a href="#Order">Order</a></li>
            </ul>
            <div class="icon">
                @if($table)
                <div> Your Order </div>
                @else
                <div class="icon">
                    <a href="/cart">
                        <i class="fa-solid fa-cart-shopping" data-toggle="modal" data-target="#exampleModal"></i>
                    </a>
                    <span id="jumlahPesanan">
                    <script>
                        // hitung jumlah keranjang dari keranjang yang ada di localstorage
                        document.getElementById('jumlahPesanan').innerHTML = jumlahKeranjang;
                    </script>
                    </span> <!-- Angka pesanan di sini -->
                </div>
                @endif
            </div>
        </nav>


        <div class="main">
            <div class="container mt-5">
                <div class="row align-items-center">
                    <!-- Kolom untuk tulisan -->
                    <div class="col-md-8 col-6">
                      <h2 class="mb-4">Pesanan Meja {{ $table->id }}</h2>
                    </div>
                    <!-- Kolom untuk button -->
                    {{-- tampilkan tombol selesaikan pesanan jika semua order berstatus selesai --}}
                    @if ($orders->where('status', '!=', 'selesai')->count() == 0)
                    <div class="col-md-4 col-6 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Selesaikan Pesanan
                        </button>
                      </div>
                    @endif
                  </div>
                <div class="row">
                @foreach ($orders as $o)
                <div class="col-md-6">
                    <!-- Card Pesanan -->
                    <div class="d-flex justify-content-between align-items-center border p-2 mb-2">
                      <div class="p-2 d-flex align-items-center">
                        <img src="{{ asset($o->menu->image) }}" alt="Gambar Makanan" class="img-fluid" style="width: 120px; height: 80px; background-color: #e9ecef;">
                        <div class="p-2">
                          <h5 class="mb-0">{{ $o->menu->name }}</h5>
                          <small class="text-secondary">{{ $o->menu->type }}</small>
                        </div>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="p-2">
                          <span class="badge badge-secondary">{{ $o->quantity }}</span>
                        </div>
                        <div class="p-2">
                          <button type="button" class="btn btn-outline-secondary">{{ $o->status }}</button>
                        </div>
                      </div>
                    </div>
                    <!-- Ulangi card untuk pesanan berikutnya -->
                  </div>

                @endforeach
              </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Selesaikan Pesanan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Pastikan semua pesanan makanan mu sampai di meja mu ya :)
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="/order/finish" method="post">
                    @csrf
                    <input type="hidden" name="table_id" value="{{ $table->id }}">
                    <input type="hidden" name="reserve_id" value="{{ $reserve->id }}">
                    <button type="submit" class="btn btn-primary">Selesaikan</button>
                </form>
            </div>
          </div>
        </div>
      </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    let jumlahPesanan = document.getElementById('jumlahPesanan');
    let totalHargaDiv = document.getElementById('total-harga')
    let listCheckout = document.getElementById('list-checkout');

function masukanKeranjang(menu) {
    // jika id sudah ada dalam keranjang maka hanya jumlah yang ditambahkan jika tidak tambahkan semua
    let index = keranjang.findIndex(item => item.id == menu.id);
    if (index == -1) {
        keranjang.push({
            id: menu.id,
            name: menu.name,
            price: menu.price,
            image: menu.image,
            quantity: 1,
            type: menu.type
        });
    } else {
        keranjang[index].quantity++;
    }

    jumlahKeranjang++
    jumlahPesanan.innerHTML = jumlahKeranjang;

    // masukan keranjang ke localstorage
    localStorage.setItem('keranjang', JSON.stringify(keranjang));
}

</script>


</body>
</html>
