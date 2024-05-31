@extends('layouts.app2')
@section('content2')
    <section class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-12 clo-md-8">
                <h4>My Booking</h4>
                <div class="d-flex gap-3 flex-wrap justify-content-center">
                    @foreach ($reservations as $item)
                    <div class="shadow-sm" style="width:20rem">
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-indicators">
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="{{ asset(App\Models\Room::find($item->id_room)->image1) }}" class="d-block w-100" alt="..."  style="height: 150px; object-fit: cover">
                              </div>
                              <div class="carousel-item">
                                <img src="{{ asset(App\Models\Room::find($item->id_room)->image2) }}" class="d-block w-100" alt="..."  style="height: 150px; object-fit: cover">
                              </div>
                              <div class="carousel-item">
                                <img src="{{ asset(App\Models\Room::find($item->id_room)->image3) }}" class="d-block w-100" alt="..."  style="height: 150px; object-fit: cover">
                              </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="p-3 text-center">
                            <p>{{ App\Models\Room::find($item->id_room)->room_type->name }}</p>
                            <h2 class="text-dark mt-3">{{ $item->invoice }}</h2>
                            <p class="text-dark">{{ App\Models\Room::find($item->id_room)->room_number }}</p>
                            <div class="d-flex justify-content-between text-dark">
                                <p><small>{{ $item->check_in_date }}</small></p>
                                <p><small>{{ $item->check_out_date }}</small></p>
                            </div>
                            <span class="text-uppercase letter-spacing-1 text-dark">Rp. {{ number_format($item->total_price, 0, ',', '.'); }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>  
    </section>
@endsection