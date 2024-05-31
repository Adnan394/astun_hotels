@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="pagetitle">
            <h1>Room Types List</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item ">Room</li>
                <li class="breadcrumb-item active">Room Type</li>
              </ol>
            </nav>
          </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <!-- Table with stripped rows -->
                <table class="table table-striped">
                  <div class="d-flex justify-content-between align-items-center my-3">
                      <div class="">
                        <button class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#add">Add Room Type</button>
                      </div>
                  </div>
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($room_types as $item)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $item->name }}</td>
                      <td><img src="{{ asset($item->image) }}" alt="" width="50px" height="50px"></td>
                      <td>{{ $item->price_per_night }}</td>
                    </tr>
                    @endforeach
                </tbody>
    
            </table>
              <!-- End Table with stripped rows -->
            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Room Type</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('room_type_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="image" class="form-label">Image</label>
                          <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                          <label for="price" class="form-label">Price</label>
                          <input type="number" class="form-control" id="price_per_night" name="price_per_night">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection