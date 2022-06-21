@extends('layouts.main')
@section('body')
<div class="card">
    <div class="card-body">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        @if (session('user')['role'] == 'admin')
            <button type="button" data-bs-toggle="modal" data-bs-target="#createTravel" class="btn icon icon-right btn-primary btn-lg style="font-size: 14px">
                Tambah Travel
                <i data-feather="plus-circle"></i>
          </button>
        @endif
      </div>
        <table class='table table-striped' id="table1">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Durasi</th>
                    <th>Penginapan</th>
                    <th>Transportasi</th>
                    <th>Gambar</th>
                    @if (session('user')['role'] == 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0
                @endphp
                @foreach ($travel as $item)
                @php
                    $date1=date_create(date('Y-m-d', strtotime($item['startDate'])));
                    $date2=date_create(date('Y-m-d', strtotime($item['endDate'])));
                    $diff_date=date_diff($date1,$date2)->format('%d');
                    $diff_month=date_diff($date1,$date2)->format('%m');

                @endphp
                <tr>
                    <td>{{ Str::limit($item['title'], 20, '...') }}</td>
                    <td>Rp. {{ $item['price'] }}</td>
                    <td>{{ Str::limit($item['description'], 20, '...') }}</td>
                    @if ($diff_month != 0)
                    <td>{{ $diff_month }} Bulan {{ $diff_date }} hari</td>
                    @else
                        <td>{{ $diff_date }} hari</td>
                    @endif
                    <td>{{ $item['lodging'] }}</td>
                    <td>{{ $item['transportation'] }}</td>
                    <td>{{ $item['image'] }}</td>
                    @if (session('user')['role'] == 'admin')
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#updateTravel" id="edit" data-index="{{ $i }}" data-id="{{ $item['id'] }}">
                                <img src="assets/images/edit.svg" alt="" srcset="" width="16" height="16">
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" id="delete" data-id="{{ $item['id']}}">
                                <img src="assets/images/trash.svg" alt="" srcset="" width="16" height="16">
                            </a>
                        </td>
                    @endif
                </tr>
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Hapus artikel?</h5>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                   Apakah anda yakin untuk menghapus artikel?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tidak</span>
                                </button>
                                <form action="{{ route('deleteTravel') }}" method="post">
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="id" id="idd">
                                    @csrf
                                    <button type="submit" class="btn btn-danger ml-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Ya</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade text-left w-100" id="updateTravel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                        role="document">
                        <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('updateTravel') }}" role="form" files=true>
                            {{ method_field('PUT') }}
                            <input type="hidden" name="id" id="id">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Edit travel</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <section id="multiple-column-form">
                                        <div class="row match-height">
                                            <div class="col-12">
                                                <div class="card-body">
                                                  @csrf
                                                  <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="judulu">Judul</label>
                                                            <input type="text" id="judulu" class="form-control" placeholder="Judul"
                                                                name="judul">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="harga">Harga</label>
                                                            <input type="text" id="hargau" class="form-control" placeholder="Harga"
                                                                name="harga">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="penginapanu">Penginapan</label>
                                                            <input type="text" id="penginapanu" class="form-control" placeholder="Penginapan"
                                                                name="penginapan">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        Durasi
                                                        <div class="input-group input-daterange">
                                                            <input type="text" class="form-control"
                                                                aria-label="Amount (to the nearest dollar)" id="start"
                                                                placeholder="Tanggal mulai" name="start">
                                                            <span class="input-group-text">sampai</span>
                                                            <input type="text" class="form-control" name="end" id="end"
                                                            aria-label="Amount (to the nearest dollar)"
                                                            placeholder="Tanggal selesai">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                      <div class="form-group">
                                                          <label for="transportasiu">Transportasi</label>
                                                          <input type="text" id="transportasiu" class="form-control" placeholder="Transportasi"
                                                              name="transportasi">
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                      <div>Gambar</div>
                                                      <div class="form-file">
                                                          <input type="file" class="form-file-input" id="image" name="image" onchange="document.getElementById('outputu').src = window.URL.createObjectURL(this.files[0])">
                                                          <label class="form-file-label" for="customFile">
                                                              <span class="form-file-button">Browse</span>
                                                          </label>
                                                      </div>
                                                  </div>       
                                                  <div class="col-md-6 col-12">
                                                      <div class="form-group">
                                                          <label for="deskripsiu">Deskripsi</label>
                                                          <textarea class="form-control" id="deskripsiu" placeholder="Deskripsi" name="deskripsi"
                                                              rows="10"></textarea>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6 col-12">
                                                    <img id="outputu" style="max-height: 250px;">
                                                  </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary"
                                        data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Kembali</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ml-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @php
                    $i++
                @endphp
              @endforeach
            </tbody>
        </table>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-4">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
<div class="modal fade text-left w-100" id="createTravel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
        role="document">
        <form class="form" method="POST" enctype="multipart/form-data" action={{ route('postTravel') }} role="form" files=true>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Buat travel</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <section id="multiple-column-form">
                        <div class="row match-height">
                            <div class="col-12">
                                <div class="card-body">
                                        @csrf
                                        <div class="row">
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="judul">Judul</label>
                                                  <input type="text" id="judul" class="form-control" placeholder="Judul"
                                                      name="judul">
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="harga">Harga</label>
                                                  <input type="text" id="harga" class="form-control" placeholder="Harga"
                                                      name="harga">
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="penginapan">Penginapan</label>
                                                  <input type="text" id="penginapan" class="form-control" placeholder="Penginapan"
                                                      name="penginapan">
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                              Durasi
                                              <div class="input-group input-daterange">
                                                  <input type="text" class="form-control"
                                                      aria-label="Amount (to the nearest dollar)"
                                                      placeholder="Tanggal mulai" name="start">
                                                  <span class="input-group-text">sampai</span>
                                                  <input type="text" class="form-control" name="end"
                                                  aria-label="Amount (to the nearest dollar)"
                                                  placeholder="Tanggal selesai">
                                              </div>
                                          </div>
                                          <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="transportasi">Transportasi</label>
                                                <input type="text" id="transportasi" class="form-control" placeholder="Transportasi"
                                                    name="transportasi">
                                            </div>
                                          </div>
                                          <div class="col-lg-6 col-md-12">
                                            <div>Gambar</div>
                                            <div class="form-file">
                                                <input type="file" class="form-file-input" id="image" name="image" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                                <label class="form-file-label" for="customFile">
                                                    <span class="form-file-text">Choose file...</span>
                                                    <span class="form-file-button">Browse</span>
                                                </label>
                                            </div>
                                        </div>       
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi</label>
                                                <textarea class="form-control" id="deskripsi" placeholder="Deskripsi" name="deskripsi"
                                                    rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                          <img id="output" style="max-height: 250px;">
                                        </div>
                                      </div>
                                                   
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Kembali</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Submit</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    

$(document).ready(function () {

$('body').on('click', '#edit', function (event) {

    event.preventDefault();
    var index = $(this).data('index');
    var id = $(this).data('id');
    var jobs = {!! json_encode($travel) !!};
    var data = jobs[index];
    $('#judulu').val(data['title']);
    $('#hargau').val(data['price']);
    $('#deskripsiu').val(data['description']);
    $('#durasiu').val('3 hari');
    $('#penginapanu').val(data['lodging']);
    $('#transportasiu').val(data['transportation']);
    $('#start').val(data['startDate']);
    $('#end').val(data['endDate']);
    $('#id').val(id);
    $('#outputu').attr('src', data['image']);
});

});

$(document).ready(function () {

$('body').on('click', '#delete', function (event) {

        event.preventDefault();
        var id = $(this).data('id');
        $('#idd').val(id);
    });

}); 

$(function(){
            $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates');
    });
});
</script>
@endsection
