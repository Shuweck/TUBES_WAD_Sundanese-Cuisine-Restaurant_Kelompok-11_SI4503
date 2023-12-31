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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


    @if (session('finish'))
        <script>

            // hapus semua local storage
            localStorage.removeItem('keranjang');
            Swal.fire(
                'Silahkan ke kasir',
                '{{ session('finish') }}',
                'success'
            )
        </script>
    @endif

    <?php

    // functin convert rupiah
    function convertRupiah($number){
        $rupiah = '';
        $numberrev = strrev($number);
        for($i = 0; $i < strlen($numberrev); $i++) if($i%3 == 0) $rupiah .= substr($numberrev,$i,3).'.';
        return 'Rp. '.strrev(substr($rupiah,0,strlen($rupiah)-1)).',00';
    }

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
                <img src="/images/home/warung_joglo.jpg">
            </div>

            <ul>
                <li><a href="#Home">Home</a></li>
                <li><a href="#About">About</a></li>
                <li><a href="#Menu">Menu</a></li>
                <li><a href="#Gallary">Gallary</a></li>
                <li><a href="#Review">Review</a></li>
            </ul>
            <div class="icon">
                @if($meja)
                <div>
                    <a href="/order">
                        Your Order
                    </a>
                </div>
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
            <div class="men_text">
                <h1>Get Fresh<span style="color: rgb(93, 93, 209)">Food</span><br>in a Easy Way</h1>
            </div>

            <div class="main_image">
                <img src="images/home/sunda.png">
            </div>

        </div>

        <p>
           Restoran jawa ini adalah restoran yang menyediakan menu khas jawa yang sangat enak
        </p>

        <div class="main_btn" style="background: rgb(93, 93, 209) !important">
            <a href="#menu_makanan">Order Now</a>
            <i class="fa-solid fa-angle-right"></i>
        </div>

    </section>

    <!--Menu-->

    <div class="menu" id="Menu">
        <h1>Our<span style="color: rgb(93, 93, 209)">Foods</span></h1>

        <div class="menu_box" id="menu_makanan">

            @foreach ($makanan as $m )
            <div class="menu_card">

                <div class="menu_image">
                    <img src={{ asset($m->image) }}>
                </div>

                <div class="menu_info">
                    <h2 style="color: rgb(93, 93, 209)">{{ $m->name }}</h2>
                    <p class="p-3">
                        {{ $m->description }}
                    </p>
                    <h3>{{ convertRupiah($m->price); }}</h3>
                    <div style="cursor: pointer" class="menu_btn"  onclick="masukanKeranjang({{ $m }})">Order Now</div>
                </div>

            </div>
            @endforeach

        </div>

        <h1>Our<span style="color: rgb(93, 93, 209)">Drink</span></h1>

        <div class="menu_box">

            @foreach ($minuman as $m )
            <div class=" menu_card">

                <div class="menu_image">
                    <img src={{ asset($m->image) }}>
                </div>

                <div class="menu_info">
                    <h2 style="color: rgb(93, 93, 209)">{{ $m->name }}</h2>
                    <p class="p-3">
                        {{ $m->description }}
                    </p>
                    <h3>{{ $m->price }}</h3>
                    <div style="cursor: pointer" class="menu_btn"  onclick="masukanKeranjang({{ $m }})">Order Now</div>
                </div>

            </div>
            @endforeach

        </div>

    </div>

    <!--Gallary-->

    {{-- <div class="gallary" id="Gallary">
        <h1>Our<span>Gallary</span></h1>

        <div class="gallary_image_box">
            <div class="gallary_image">
                <img src="images/home/lele.jpeg">

                <h3>Food</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet laboriosam
                </p>
                <a href="#" class="gallary_btn">Order Now</a>
            </div>

            <div class="gallary_image">
                <img src="images/home/lele.jpeg">

                <h3>Food</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet laboriosam
                </p>
                <a href="#" class="gallary_btn">Order Now</a>
            </div>

            <div class="gallary_image">
                <img src="images/home/lele.jpeg">

                <h3>Food</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet laboriosam
                </p>
                <a href="#" class="gallary_btn">Order Now</a>
            </div>

            <div class="gallary_image">
                <img src="images/home/lele.jpeg">

                <h3>Food</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet laboriosam
                </p>
                <a href="#" class="gallary_btn">Order Now</a>
            </div>

            <div class="gallary_image">
                <img src="images/home/lele.jpeg">

                <h3>Food</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet laboriosam
                </p>
                <a href="#" class="gallary_btn">Order Now</a>
            </div>

            <div class="gallary_image">
                <img src="images/home/lele.jpeg">

                <h3>Food</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi sint eveniet laboriosam
                </p>
                <a href="#" class="gallary_btn">Order Now</a>
            </div>

        </div>

    </div> --}}

    <!--Review-->

    <div class="review" id="Review">
        <h1>Customer<span style="color: rgb(93, 93, 209)">Review</span></h1>

        <div class="review_box">
            <div class="review_card">

                <div class="review_profile">
                    <img src="images/home/review_1.png">
                </div>

                <div class="review_text">
                    <h2 class="name">John Deo</h2>

                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>

                    <div class="review_social">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-linkedin-in"></i>
                    </div>

                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus quam facere
                        blanditiis in fugiat tempore necessitatibus aliquid. Id adipisci, rem corrupti
                        asperiores distinctio delectus quae quia tenetur totam laboriosam quam. Lorem ipsum,
                        dolor sit amet consectetur adipisicing elit. Dolores soluta ullam ipsa voluptates
                        repudiandae dignissimos deleniti mollitia eum. Laudantium placeat velit nemo illo
                        pariatur. Fuga aperiam impedit illo atque repellendus!
                    </p>

                </div>

            </div>

            <div class="review_card">

                <div class="review_profile">
                    <img src="images/home/review_2.png">
                </div>

                <div class="review_text">
                    <h2 class="name">John Deo</h2>

                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>

                    <div class="review_social">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-linkedin-in"></i>
                    </div>

                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus quam facere
                        blanditiis in fugiat tempore necessitatibus aliquid. Id adipisci, rem corrupti
                        asperiores distinctio delectus quae quia tenetur totam laboriosam quam. Lorem ipsum,
                        dolor sit amet consectetur adipisicing elit. Dolores soluta ullam ipsa voluptates
                        repudiandae dignissimos deleniti mollitia eum. Laudantium placeat velit nemo illo
                        pariatur. Fuga aperiam impedit illo atque repellendus!
                    </p>

                </div>

            </div>

            <div class="review_card">

                <div class="review_profile">
                    <img src="images/home/review_3.png">
                </div>

                <div class="review_text">
                    <h2 class="name">John Deo</h2>

                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>

                    <div class="review_social">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-linkedin-in"></i>
                    </div>

                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus quam facere
                        blanditiis in fugiat tempore necessitatibus aliquid. Id adipisci, rem corrupti
                        asperiores distinctio delectus quae quia tenetur totam laboriosam quam. Lorem ipsum,
                        dolor sit amet consectetur adipisicing elit. Dolores soluta ullam ipsa voluptates
                        repudiandae dignissimos deleniti mollitia eum. Laudantium placeat velit nemo illo
                        pariatur. Fuga aperiam impedit illo atque repellendus!
                    </p>

                </div>

            </div>

            <div class="review_card">

                <div class="review_profile">
                    <img src="images/home/review_4.png">
                </div>

                <div class="review_text">
                    <h2 class="name">John Deo</h2>

                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>

                    <div class="review_social">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-linkedin-in"></i>
                    </div>

                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus quam facere
                        blanditiis in fugiat tempore necessitatibus aliquid. Id adipisci, rem corrupti
                        asperiores distinctio delectus quae quia tenetur totam laboriosam quam. Lorem ipsum,
                        dolor sit amet consectetur adipisicing elit. Dolores soluta ullam ipsa voluptates
                        repudiandae dignissimos deleniti mollitia eum. Laudantium placeat velit nemo illo
                        pariatur. Fuga aperiam impedit illo atque repellendus!
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!--Order-->

    <div class="order" id="Order">
        {{-- <h1><span>Order</span>Now</h1>

        <div class="order_main">

            <div class="order_image">
                <img src="images/home/order_image.png">
            </div>

            <form action="#">

                <div class="input">
                    <p>Name</p>
                    <input type="text" placeholder="you name">
                </div>

                <div class="input">
                    <p>Email</p>
                    <input type="email" placeholder="you email">
                </div>

                <div class="input">
                    <p>Number</p>
                    <input placeholder="you number">
                </div>

                <div class="input">
                    <p>How Much</p>
                    <input type="number" placeholder="how many order">
                </div>

                <div class="input">
                    <p>You Order</p>
                    <input placeholder="food name">
                </div>

                <div class="input">
                    <p>Address</p>
                    <input placeholder="you Address">
                </div>

                <a href="#" class="order_btn">Order Now</a>

            </form>

        </div> --}}

    </div>

    <!--Team-->

    <div class="team">
        <h1>Our<span style="color: rgb(93, 93, 209)">Team</span></h1>

        <div class="team_box">
            <div class="profile">
                <img src="images/home/chef1.png">

                <div class="info">
                    <h2 class="name">Chef</h2>
                    <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="images/home/chef2.png">

                <div class="info">
                    <h2 class="name">Chef</h2>
                    <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="images/home/chef3.jpg">

                <div class="info">
                    <h2 class="name">Chef</h2>
                    <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="images/home/chef4.jpg">

                <div class="info">
                    <h2 class="name">Chef</h2>
                    <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!--Footer-->

    <footer>
        <div class="footer_main">

            <div class="footer_tag">
                <h2>Location</h2>
                <p>Sri Lanka</p>
                <p>USA</p>
                <p>India</p>
                <p>Japan</p>
                <p>Italy</p>
            </div>

            <div class="footer_tag">
                <h2>Quick Link</h2>
                <p>Home</p>
                <p>About</p>
                <p>Menu</p>
                <p>Gallary</p>
                <p>Order</p>
            </div>

            <div class="footer_tag">
                <h2>Contact</h2>
                <p>+94 12 3456 789</p>
                <p>+94 25 5568456</p>
                <p>johndeo123@gmail.com</p>
                <p>foodshop123@gmail.com</p>
            </div>

            <div class="footer_tag">
                <h2>Our Service</h2>
                <p>Fast Delivery</p>
                <p>Easy Payments</p>
                <p>24 x 7 Service</p>
            </div>

            <div class="footer_tag">
                <h2>Follows</h2>
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin-in"></i>
            </div>

        </div>

        <p class="end">Design by<span><i class="fa-solid fa-face-grin"></i> Sundanaise Cruise</span></p>

    </footer>

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
