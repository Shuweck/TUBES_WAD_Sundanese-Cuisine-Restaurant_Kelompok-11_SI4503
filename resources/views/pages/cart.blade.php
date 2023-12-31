<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background: #ddd;
            min-height: 100vh;
            vertical-align: middle;
            display: flex;
            font-family: sans-serif;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .title {
            margin-bottom: 5vh;
        }

        .card {
            margin: auto;
            max-width: 950px;
            width: 90%;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 1rem;
            border: transparent;
        }

        @media (max-width: 767px) {
            .card {
                margin: 3vh auto;
            }
        }

        .cart {
            background-color: #fff;
            padding: 4vh 5vh;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem;
        }

        @media (max-width: 767px) {
            .cart {
                padding: 4vh;
                border-bottom-left-radius: unset;
                border-top-right-radius: 1rem;
            }
        }

        .summary {
            background-color: #ddd;
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
            padding: 4vh;
            color: rgb(65, 65, 65);
        }

        @media (max-width: 767px) {
            .summary {
                border-top-right-radius: unset;
                border-bottom-left-radius: 1rem;
            }
        }

        .summary .col-2 {
            padding: 0;
        }

        .summary .col-10 {
            padding: 0;
        }

        .row {
            margin: 0;
        }

        .title b {
            font-size: 1.5rem;
        }

        .main {
            margin: 0;
            padding: 2vh 0;
            width: 100%;
        }

        .col-2,
        .col {
            padding: 0 1vh;
        }

        a {
            padding: 0 1vh;
        }

        .close {
            margin-left: auto;
            font-size: 0.7rem;
        }

        img {
            width: 3.5rem;
        }

        .back-to-shop {
            margin-top: 4.5rem;
        }

        h5 {
            margin-top: 4vh;
        }

        hr {
            margin-top: 1.25rem;
        }

        form {
            padding: 2vh 0;
        }

        select {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1.5vh 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        input {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        input:focus::-webkit-input-placeholder {
            color: transparent;
        }

        .btn {
            background-color: #000;
            border-color: #000;
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0;
        }

        .btn:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            -webkit-user-select: none;
            transition: none;
        }

        .btn:hover {
            color: white;
        }

        a {
            color: black;
        }

        a:hover {
            color: black;
            text-decoration: none;
        }

        #code {
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)),
                url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center;
        }
    </style>
</head>
<body>
    <script>
        // ambil data keranjang dari localstorage
        let keranjang = JSON.parse(localStorage.getItem('keranjang'));
    </script>

    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col"><h4><b>Shopping Cart</b></h4></div>
                        <div class="col align-self-center text-right text-muted">
                           <p id='total-item'></p>
                        </div>
                    </div>
                </div>
                <div id="card-menu"></div>
                <a href="/"><div class="back-to-shop"><a href="/">&leftarrow;</a><span class="text-muted">Back to home</span></div></a>
            </div>
            <div class="col-md-4 summary">
                <div><h5><b>Summary</b></h5></div>
                <hr>
                <form action="/order" method='post'>
                    @csrf
                    <p>Payment</p>
                    <select><option class="text-muted">Cash</option><option class="text-muted">QRIS</option><option class="text-muted">Debit</option><option class="text-muted">E-Wallet (Go-Pay, ShopeePay, OVO, DANA)</option></select>
                    <p>Table Number</p>
                    <select name="table">
                        @foreach ($tables as $t )
                        <option class="text-muted">{{ $t->id }}</option>
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col" style="padding-left:0;">Tax 10%</div>
                        <div id="tax" class="col text-right"></div>
                    </div>
                    <div class="row">
                        <div class="col" style="padding-left:0;">Service 5%</div>
                        <div id="service" class="col text-right"></div>
                    </div>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div id="total-price" class="col text-right"></div>
                    <input id="input-total" type="hidden" name="total_price" />
                </div>
                <input type="hidden" id="list-pesanan" name="list_pesanan"/>
                <button type="submit" class="btn">PAY</button>
                </form>
            </div>
        </div>
    </div>

    <script>

        function convertRupiah(number){
            let rupiah = ''
            let numberrev = number.toString().split('').reverse().join('')
            for(let i = 0; i < numberrev.length; i++) if(i%3 == 0) rupiah += numberrev.substr(i,3)+'.'
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('')+',00'
        }

        function renderKeranjang(){
            let listCardMenu = keranjang.map(item => `
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="${item.image}"></div>
                    <div class="col">
                        <div class="row text-muted">${item.type}</div>
                        <div class="row">${item.name}</div>                    </div>
                    <div class="col">
                        <a href="#" onClick="kurangiKuantitas(${item.id})">-</a><a href="#" class="border">${item.quantity}</a><a href="#" onClick="tambahKuantitas(${item.id})">+</a>
                    </div>
                    <div class="col">${convertRupiah(item.price * item.quantity)}<span class="close" style="hover: 'pointer'" onClick="deleteItem(${item.id})">&#10005;</span></div>
                </div>
            </div>
        `).join('')

        document.getElementById('card-menu').innerHTML = listCardMenu

        let totalItem = keranjang.reduce((total, item) => total + item.quantity, 0)
        document.getElementById('total-item').innerHTML = `Total ${totalItem} item`

        let totalTax = keranjang.reduce((total, item) => total + (item.price * item.quantity * 0.1), 0)

        document.getElementById('tax').innerHTML = convertRupiah(totalTax)

        let totalService = keranjang.reduce((total, item) => total + (item.price * item.quantity * 0.05), 0)
        document.getElementById('service').innerHTML = convertRupiah(totalService)

        let totalPrice = keranjang.reduce((total, item) => total + (item.price * item.quantity), 0)
        document.getElementById('total-price').innerHTML = convertRupiah(totalPrice+totalService+totalTax)
        document.getElementById('input-total').value = totalPrice+totalService+totalTax

        let listPesanan = document.getElementById('list-pesanan');
        listPesanan.value = JSON.stringify(keranjang);
        }

        renderKeranjang()

        function tambahKuantitas(itemId){

            //cari item yang mau ditambah
            let item = keranjang.find(item => item.id == itemId)

            //tambah kuantitasnya
            item.quantity++

            //simpan keranjang ke localstorage
            localStorage.setItem('keranjang', JSON.stringify(keranjang))

            // //render ulang keranjang
            renderKeranjang()

        }

        //buat function kurangiKuantitas
        function kurangiKuantitas(itemId){

            //cari item yang mau dikurangi
            let item = keranjang.find(item => item.id == itemId)

            //kurangi kuantitasnya
            item.quantity--

            //cek kuantitasnya
            if(item.quantity == 0){
                //hapus item dari keranjang
                keranjang = keranjang.filter(item => item.id != itemId)
            }

            //simpan keranjang ke localstorage
            localStorage.setItem('keranjang', JSON.stringify(keranjang))

            // //render ulang keranjang
            renderKeranjang()
        }

        function deleteItem(itemId){
            //hapus item dari keranjang
            keranjang = keranjang.filter(item => item.id != itemId)

            //simpan keranjang ke localstorage
            localStorage.setItem('keranjang', JSON.stringify(keranjang))

            // //render ulang keranjang
            renderKeranjang()
        }
    </script>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
