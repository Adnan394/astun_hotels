@extends('layouts.app2')

@section('content2')
<section class="container" style="margin-top: 100px">
    <h4>Reservation</h4>
    <div class="row">
        <div class="col-12 col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ asset($rooms->image1) }}" class="d-block w-100" alt="..."  style="height: 350px; object-fit: cover">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset($rooms->image2) }}" class="d-block w-100" alt="..."  style="height: 350px; object-fit: cover">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset($rooms->image3) }}" class="d-block w-100" alt="..."  style="height: 350px; object-fit: cover">
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
        </div>
        <div class="col-12 col-md-6">
            <h2>{{ $rooms->room_number }}</h2>
            <h4>{{ $rooms->room_type->name }}</h4>
            <p>{{ $rooms->description }}</p>
            <form action="{{ route('reservation_store') }}" method="POST">
                @csrf
                <input type="hidden" name="room_id" value="{{ $rooms->id }}">
                <input type="hidden" name="total_price" value="{{ $rooms->room_type->price_per_night }}">
                <div class="mb-3">
                    <label for="" class="form-label">Check In Date</label>
                    <input type="date" class="form-control" name="check_in">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Check Out Date</label>
                    <input type="date" class="form-control" name="check_out">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Payment</label>
                    <select name="payment" id="" class="form-select">
                        @foreach ($payments as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Book Now</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection