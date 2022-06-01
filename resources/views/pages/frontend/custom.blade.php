@extends('layouts.frontend')

@section('content')
<!-- START: BREADCRUMB -->
<section class="bg-gray-100 py-8 px-4">
  <div class="container mx-auto">
    <ul class="breadcrumb">
      <li>
        <a href="{{ route('index') }}">Home</a>
      </li>
      <li>
        <a href="#">Custom</a>
      </li>
    </ul>
  </div>
</section>
<!-- END: BREADCRUMB -->

</section>


<!-- START: DETAILS -->
<section class="container mx-auto">
  <div class="my-8 text-center">
    <h6 class="font-semibold text-2xl">Pemesanan Layanan</h6>
    <p class="font-light text-lg" style="font-weight:300">Custom furniture seperti kitchen set, lemari, wardrobe, tempat tidur,
      sofa, meja makan, meja belajar, meja rias, <br/> kursi, rak buku, rak bawah tangga, hingga backdrop TV, sesuai dengan keinginan
      anda.
    </p>
  </div>
  @if (session("success"))
    <div class="my-5" role="alert">
        <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
            Success!, our admin will contact you as soon as possible
        </div>
    </div>
  @endif

  <div class="w-full md:px-4" id="shipping-detail">
    <div class="bg-gray-100 px-4 py-6 md:p-8 md:rounded-3xl">
      <form action="{{ route('custom-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-start mb-6">
          <h3 class="text-2xl">Informasi Perancang</h3>
        </div>

        <div class="flex flex-col mb-4">
          <label for="complete-name" class="text-sm mb-2"
            >Complete Name</label
          >
          <input
            required
            name="name"
            type="text"
            id="complete-name"
            class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
            placeholder="Input your name"
          />
        </div>

        <div class="flex flex-col mb-4">
          <label for="email" class="text-sm mb-2">Email Address</label>
          <input
            required
            name="email"
            type="email"
            id="email"
            class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
            placeholder="Input your email address"
          />
        </div>

        <div class="flex flex-col mb-4">
          <label for="address" class="text-sm mb-2">Address</label>
          <input
            required
            name="address"
            type="text"
            id="address"
            class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
            placeholder="Input your address"
          />
        </div>

        <div class="flex flex-col mb-4">
          <label for="phone-number" class="text-sm mb-2"
            >Phone Number</label
          >
          <input
            required
            name="phone"
            type="tel"
            id="phone-number"
            class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
            placeholder="Input your phone number"
          />
        </div>

        <div class="flex flex-col mb-4">
          <label for="location" class="text-sm mb-2"
            >Lokasi Pemasangan</label
          >
          <select
          class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
          name="location" id="location" required>
            <option  value="">Pilih lokasi pemasangan</option>
            <option  value="Jakarta">Jakarta</option>
            <option  value="Bogor">Bogor</option>
            <option  value="Depok">Depok</option>
            <option  value="Tangerang">Tangerang</option>
            <option  value="Bekasi">Bekasi</option>
          </select>
        </div>

        <div class="flex flex-start mb-6">
          <h3 class="text-2xl">Saya membutuhkan furniture untuk</h3>
        </div>

        <div class="flex flex-col mb-4">
          <label for="furniture_for" class="text-sm mb-2"
            >Kebutuhan Furniture</label
          >
          <select
          class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
          name="furniture_for" id="furniture_for" required>
            <option  value="">Pilih Kebutuhan Furniture</option>
            <option  value="Rumah">Rumah</option>
            <option  value="Kantor">Kantor</option>
            <option  value="Apartemen">Apartemen</option>
            <option  value="Cafe/Restaurant">Cafe/Restaurant</option>
            <option  value="Lainnya">Lainnya</option>
          </select>
        </div>

        <div class="flex flex-start mb-6">
          <h3 class="text-2xl">Furniture yang saya butuhkan adalah</h3>
        </div>

        <div class="flex flex-col mb-4">
          <label for="furniture_type" class="text-sm mb-2"
            >Furniture</label
          >
          <select
          class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
          name="furniture_type" id="furniture_type" required>
            <option  value="">Pilih Furniture</option>
            <option  value="Kitchen Set">Kitchen Set</option>
            <option  value="Lemari">Lemari</option>
            <option  value="Ranjang">Ranjang</option>
            <option  value="Backdrop TV">Backdrop TV</option>
            <option  value="Meja">Meja</option>
            <option  value="Rak">Rak</option>
            <option  value="Lainnya">Lainnya</option>
          </select>
        </div>

        <div class="flex flex-start mb-6">
          <h3 class="text-2xl">Referensi Desain Furniture</h3>
        </div>

        <div class="flex flex-col mb-4">
          <label for="file" class="text-sm mb-2"
            >Referensi Desain</label
          >
          <input
          required
          name="file"
          type="file"
          accept="image/*"
          id="file"
          class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
        />
        </div>

        <div class="flex flex-start mb-6">
          <h3 class="text-2xl">Buat Jadwal Temu</h3>
        </div>

        <div class="flex flex-col mb-4">
          <label for="date" class="text-sm mb-2"
            >Tanggal</label
          >
          <input
          required
          name="date"
          type="date"
          id="date"
          class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
        />
        </div>

        <div class="flex flex-col mb-4">
          <label for="description" class="text-sm mb-2"
            >Keterangan Lain</label
          >
         <textarea
         class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
         required
         name="description"
         placeholder="Masukkan warna, ukuran, jumlah, dan lainnya"
         ></textarea>
        </div>

        <div class="text-center">
          <button
            type="submit"
            class="bg-pink-400 text-black hover:bg-black hover:text-pink-400 focus:outline-none w-full py-3 rounded-full text-lg focus:text-black transition-all duration-200 px-6"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>

</section>


@endsection

@push('addon-script')
<script src="{{ url('frontend/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ url('frontend/js/isotope.min.js') }}"></script>

<script>
  $(document).ready(function(){
    $('.showcase-item').isotope({
      itemSelector: '.item',
      layoutMode: 'fitRows',
    });
    $('.categories ul li').click(function () {
      $('.categories ul li').removeClass('active');
      $(this).addClass('active');

      var selector = $(this).attr('data-filter');
      $('.showcase-item').isotope({
        filter: selector
      });
      return false;
    });
  });
</script>

@endpush
