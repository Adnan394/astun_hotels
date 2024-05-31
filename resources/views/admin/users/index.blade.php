@extends('layouts.app')

@section('content')
<div class="container">
    <div class="pagetitle">
        <h1>Guest List</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Guest</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
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
                    <input type="text" class="form-control my-3 ms-auto" id="search" placeholder="Search for names..">
                </div>
            </div>
          <!-- Table with stripped rows -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
            <tbody id="tbody">
                @foreach ($users as $item)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->address }}</td>
                  <td>{{ $item->phone }}</td>
                  <td>{{ $item->email }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <div id="links">
            {{ $users->links() }}
          </div>
          <!-- End Table with stripped rows -->
    
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
      url: "{{ route('search_guest') }}",
      type: "GET",
      dataType : "JSON",
      data: {
        search: $("#search").val(),
        sort : $("#sort").val()
      },
      success: function(data){
      console.log(data);
        html = "";
        $userlinks = data;
        $.each(data.data, function(i, item) {
          html += `
                <tr>
                  <th scope="row">${item.id}</th>
                  <td>${item.name}</td>
                  <td>${item.address}</td>
                  <td>${item.phone}</td>
                  <td>${item.email}</td>
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