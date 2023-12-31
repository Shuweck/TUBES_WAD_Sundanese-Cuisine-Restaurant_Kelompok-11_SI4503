@include('templates.header')

@include('templates.sidebar.chef')
<style>
.bg-slate-200 {
    --tw-bg-opacity: 1;
    background-color: rgb(226 232 240 / var(--tw-bg-opacity));
}
</style>

<div class="content-body p-3">
    <div class="m-3">
        <h1>Selamat datang, chef {{ $chef->name }}</h1>
    </div>

    <div class="m-3">
        <h3>Daftar Order Pesanan</h3>
    </div>

    {{-- looping meja --}}
   {{-- jika meja kosong tampilkan tidak ada pesanan hari ini --}}
    @if ($meja->count() == 0)
        <div style="margin-top:  200px" class="text-center">
            <h3>Sedang tidak ada pesanan :(</h3>
        </div>
    @endif

    @foreach ($meja as $m )
    <div class="border border-dark">
        <h4>Meja {{ $m->id }}</h4>
        <div class="bg-slate-200 p-3 my-3">
            <div class="row">
                {{-- looping order --}}
               @foreach ($m->reserve as $r)
                @foreach ($r->order as $o )
                {{-- jika status order bukan antri atau dimasak maka skip --}}
                @if ($o->status != 'antri' && $o->status != 'dimasak')
                @continue
                @endif
                <hr>
                    <div class="col-6">
                        <div class="row h-100 align-items-center"> <!-- Menambahkan h-100 dan align-items-center -->
                            <div class="col-6">
                                <h4>Menu</h4>
                                <p>{{ $o->menu->name }}</p>
                            </div>
                            <div class="col-6">
                                <h4>Jumlah</h4>
                                <p>{{ $o->quantity }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center">
                        {{-- button pojok kanan --}}
                        <div class="d-flex justify-content-end w-100">
                                <form action="/chef/order/status" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $o->id }}">
                                <input type="hidden" name="status" value="{{ $o->status == "antri" ? 'dimasak' : 'diantar' }}">
                                <button class="btn btn-primary">{{ $o->status }}</button>
                            </form>
                        </div>
                    </div>
                {{-- buat garis bawah --}}
                <hr>
                @endforeach
               @endforeach
            </div>
        </div>
    </div>
    @endforeach

</div>



@include('templates.footer')
