@extends('layouts.app2')

@section('content2')
<section>
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('assets/images/img1.jpeg') }}" class="d-block w-100" alt="..." style="height: 100vh; object-fit: cover">
            <div class="carousel-caption d-none d-md-block">
              <h5>Modern Hotels</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ asset('assets/images/executif.jpeg') }}" class="d-block w-100" alt="..."  style="height: 100vh; object-fit: cover">
            <div class="carousel-caption d-none d-md-block">
              <h5>Executive View</h5>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
</section>
<section class="section mt-5" id="rooms">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
                <h2 class="heading" data-aos="fade-up">Rooms &amp; Suites</h2>
                <p data-aos="fade-up" data-aos-delay="100">Kamar-kamar kami dirancang untuk memberikan kenyamanan
                    maksimal bagi para tamu kami. Setiap kamar dilengkapi dengan perabotan modern dan desain yang
                    elegan, menciptakan suasana yang menyenangkan untuk bersantai setelah seharian beraktivitas.</p>
            </div>
        </div>
        <div class="row">
            <div class="d-flex gap-3 flex-wrap justify-content-center" data-aos="fade-up">
                @foreach ($room_types as $item)
                    <a href="{{ route('room-lists', $item->id) }}" class="" style="width:24rem">
                        <figure class="img-wrap">
                            <img src="{{ asset($item->image) }}" alt="Free website template" style="height: 250px;width: 100%; object-fit: cover" class="img-fluid mb-3">
                        </figure>
                        <div class="p-3 text-center">
                            <h2>{{ $item->name }}</h2>
                            <span class="text-uppercase letter-spacing-1">Rp. {{ number_format($item->price_per_night, 0, ',', '.'); }} / a Night</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="container my-5" id="gallery">
    <h4 class="text-center mb-3">Gallery</h4>
    <div class="d-flex flex-wrap gap-3 justify-content-center">
        <img src="{{ asset('assets/images/img1.jpeg') }}" class="img-fluid" width="300px" width="200px" alt="">
        <img src="{{ asset('assets/images/img_2.jpg') }}" class="img-fluid" width="300px" width="200px" alt="">
        <img src="{{ asset('assets/images/img_4.jpg') }}" class="img-fluid" width="300px" width="200px" alt="">
        <img src="{{ asset('assets/images/slider-1.jpg') }}" class="img-fluid" width="300px" width="200px" alt="">
        <img src="{{ asset('assets/images/slider-2.jpg') }}" class="img-fluid" width="300px" width="200px" alt="">
        <img src="{{ asset('assets/images/slider-3.jpg') }}" class="img-fluid" width="300px" width="200px" alt="">
        <img src="{{ asset('assets/images/slider-4.jpg') }}" class="img-fluid" width="300px" width="200px" alt="">
        <img src="{{ asset('assets/images/slider-5.jpg') }}" class="img-fluid" width="300px" width="200px" alt="">
    </div>
</section>

<section class="container" id="reviews">
    <h4 class="text-center mb-3">Reviews</h4>
    <div class="d-flex flex-wrap gap-3">
        @foreach ($reviews as $item)
        <div class="card p-3" style="width: 24rem">
            <div class="d-flex gap-3 flex-wrap justify-content-center">
                <div class="">
                    <img src="{{ asset('assets/img/user.png') }}" alt="" width="50px">
                </div>
                <div class="">
                    <strong class="text-bold">{{ App\Models\User::where('id', $item->user_id)->first()->name }}</strong>
                    <p>{{ $item->review }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="">
        <form action="{{ route('review') }}" method="POST">
           @csrf
           <div class="mb-3">
                <label for="" class="form-label">Type your review and experience</label>
                <textarea name="review" class="form-control" id="" cols="30" rows="10"></textarea>
           </div> 
           <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
           </div>
        </form>
    </div>
</section>

<section class="bg-white py-5" id="contact">
    <div class="container">
        <div class="row">
            <div class="col">
                <h4>Hotel</h4>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126602.10402470682!2d109.15202030847739!3d-7.430268301312824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655c3136423d1d%3A0x4027a76e352e4a0!2sPurwokerto%2C%20Kabupaten%20Banyumas%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1716999830228!5m2!1sid!2sid" width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p><strong>Address:</strong> Jl. Raya Cibodas No. 6, Cibodas, Kec. Purwokerto Utara, Purwokerto, Jawa Tengah 53114</p>
            </div>
            <div class="col">
                <h4>Contact</h4>
                <ul class="list-unstyled">
                    <li><strong>Phone:</strong> 08 123 456 789</li>
                    <li><strong>Email:</strong> 8VbGk@example.com</li>
                    <li><strong>Website:</strong> www.hotel.com</li>
                </ul>
            </div>
            <div class="col">
                <h4>Navigations</h4>
                <ul class="list-unstyled">
                    <li><a class="text-dark pointer" href="/">Home</a></li>
                    <li><a class="text-dark pointer" href="#rooms">Rooms</a></li>
                    <li><a class="text-dark pointer" href="#reviews">Reviews</a></li>        
                    <li><a class="text-dark pointer" href="#gallery">Gallery</a></li>        
                </ul>
            </div>
        </div>
    </div>
</section>
<footer class="bg-primary shadow-sm overflow-hidden">
    <p class="text-center text-white my-3">Copyright © 2023. All rights reserved.</p>
</footer>
@endsection
