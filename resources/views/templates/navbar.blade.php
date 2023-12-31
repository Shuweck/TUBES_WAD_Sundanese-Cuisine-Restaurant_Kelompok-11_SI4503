<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<nav>
    <div class="logo">
        <img src="/images/home/warung_joglo.jpg">
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
        @if($meja)
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
