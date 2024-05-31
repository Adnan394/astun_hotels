@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Add Rooms</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Room</li>
        <li class="breadcrumb-item active">Add Room</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Add Room</h5>
      <form action="{{ route('room_store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="image" class="form-label">Image 1</label>
          <input type="file" class="form-control" id="image" name="image1">
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image 2</label>
          <input type="file" class="form-control" id="image" name="image2">
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image 3</label>
          <input type="file" class="form-control" id="image" name="image3">
        </div>
        <div class="mb-3">
          <label for="room_number" class="form-label">Room Number</label>
          <input type="text" class="form-control" id="room_number" name="room_number">
        </div>
        <div class="mb-3">
          <label for="room_type" class="form-label">Room Type</label>
          <select name="room_type" id="" class="form-select">
            @foreach ($room_types as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Description</label>
          <textarea name="desciption" class="form-control" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="mb-3">
          <label for="avaibility" class="form-label">Avaibility</label>
          <select name="avaibility" class="form-select" id="">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
@endsection