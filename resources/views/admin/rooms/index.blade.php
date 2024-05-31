@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    <div class="pagetitle">
        <h1>Rooms List</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Rooms</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table table-striped">
              <div class="d-flex justify-content-between align-items-center my-3">
                  <div class="">
                      <a href="{{ route('room_create') }}" class="btn btn-primary mb-0">Add Room</a>
                  </div>
              </div>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Image</th>
                <th scope="col">Image</th>
                <th scope="col">Number</th>
                <th scope="col">Type</th>
                <th scope="col">Description</th>
                <th scope="col">Avaibility</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $item)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td><img src="{{ asset($item->image1) }}" alt="" width="50px" height="50px"></td>
                  <td><img src="{{ asset($item->image2) }}" alt="" width="50px" height="50px"></td>
                  <td><img src="{{ asset($item->image3) }}" alt="" width="50px" height="50px"></td>
                  <td>{{ $item->room_number }}</td>
                  <td>{{ App\Models\Room_type::where('id', $item->room_type_id)->first()->name }}</td>
                  <td>{{ $item->description }}</td>
                  <td>{{ $item->price_per_night }}</td>
                  <td  data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}" class="{{ ($item->avaibility == 1) ? 'text-success' : 'text-danger' }} pointer">{{ ($item->avaibility == 1) ? 'Available' : 'Not Available' }}</td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <h3>Set {{ ($item->avaibility == 1) ? 'Not Available' : 'Available' }}</h3>
                      </div>
                      <form action="{{ route('room_avaibility', $item->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
                @endforeach
            </tbody>

        </table>
          <!-- End Table with stripped rows -->
    
        </div>
    </div>
</div>
@endsection