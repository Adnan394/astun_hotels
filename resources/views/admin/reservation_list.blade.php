@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="pagetitle">
            <h1>Reservation Lists</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Reservation Lists</li>
              </ol>
            </nav>
          </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <!-- Table with stripped rows -->
                <table class="table table-striped">
                  <div class="d-flex justify-content-between">
                    <div class="my-3">
                        <select name="" id="sort" class="form-select d-block">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="250">250</option>
                        </select>
                    </div>
                    <div class="">
                        <input type="text" class="form-control my-3 ms-auto" id="search" placeholder="Search for user names..">
                    </div>
                </div>
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Room</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Total Price</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($reservations as $item)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ \App\Models\User::where('id', $item->id_user)->first()->name }}</td>
                      <td>{{ \App\Models\Room::where('id', $item->id_room)->first()->room_number }}</td>
                      <td>{{ \App\Models\Payment::where('id', $item->id_payment)->first()->name }}</td>
                      <td>{{ $item->check_in_date }}</td>
                      <td>{{ $item->check_out_date }}</td>
                      <td>{{ $item->total_price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
              <!-- End Table with stripped rows -->
              <div id="links">
                {{ $reservations->links() }}
              </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  $('#search').on('input', function(e){
    showData();
  });
  $('#sort').on('change', function(e){
    showData();
  });

  function showData() {
    $.ajax({
      url: "{{ route('search_reservation') }}",
      type: "GET",
      dataType : "JSON",
      data: {
        search: $("#search").val(),
        sort : $("#sort").val()
      },
      success: function(data){
        html = "";
        $userlinks = data;
        console.log(data);
        $.each(data.data, function(i, item) {
          html += `
                <tr>
                  <th scope="row">${item.id}</th>
                  <td>${item.name_user}</td>
                  <td>${item.name_room}</td>
                  <td>${item.name_payment}</td>
                  <td>${item.check_in_date}</td>
                  <td>${item.check_out_date}</td>
                  <td>${item.total_price}</td>
                </tr>
          `
        });
        $('#tbody').html(html);
        $('#links').html(data.links);
      }
    });
  }
</script>
@endsection