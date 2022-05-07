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
        <a href="#">Showcase</a>
      </li>
    </ul>
  </div>
</section>
<!-- END: BREADCRUMB -->

</section>


<!-- START: DETAILS -->
<section class="container mx-auto">
  <div class="mt-4 text-center">
    <h6 class="font-semibold text-2xl">Desain Inspirasi</h6>
    <p class="font-light text-lg" style="font-weight:300">Cari ide desain furniture di sini! Kami akan mewujudkannya untuk Anda! <br/>
      *gambar pada halaman ini hanya sebagai referensi desain yang diambil dari Social Media
    </p>
  </div>


    <div class="flex justify-center my-8 categories">
      <ul class="flex">
        <li class="mx-3 text-lg active" data-filter="*"><a  href="#" class="text">All</a></li>
        @foreach ($categories as $category)
        <li class="mx-3 text-lg" data-filter=".category{{ $category->id }}"><a href="#" class="text">{{ $category->showcase_name }}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="w-full px-4 md:mb-0">
      <div class="flex -mx-4 flex-wrap relative showcase-item">
        <!-- START: JUST ARRIVED ROW 1 -->
        @foreach ($showcases as $showcase)
        <div class="px-4 relative card group w-6/12 md:w-3/12 item category{{ $showcase->categories_id }} " style="margin-bottom: 100px">
          <div
          class="rounded-xl overflow-hidden card-shadow relative"
          style="height: 200px"
          >
          <img
          src="{{ $showcase->exists() ? Storage::url($showcase->url) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' }}"
          alt=""
          class="w-full h-full object-cover object-center"
          />
        </div>
        <a href="#" class="stretched-link">
        </a>
      </div>
      @endforeach
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
