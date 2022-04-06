@extends('layouts.main')
@section('body')
<div class="card">
    <div class="card-body">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="button" data-bs-toggle="modal" data-bs-target="#createArtikel" class="btn icon icon-right btn-primary btn-lg style="font-size: 14px">
          Tambah Artikel
          <i data-feather="plus-circle"></i>
        </button>
      </div>
        <table class='table table-striped' id="table1">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Konten</th>
                    <th>Pembuat</th>
                    <th>Gambar</th>
                    <th>Update</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0
                @endphp
                @foreach ($artikel as $item)
                <tr>
                    <td>{{ Str::limit($item['title'], 20, '...') }}</td>
                    <td>{{ $item['content'] }}</td>
                    <td>{{ $item['author'] }}</td>
                    <td>{{ Str::limit($item['image'], 20, '...') }}</td>
                    <td>{{ date('d-m-y', strtotime($item['updated_at'])) }}</td>
                    <td>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#updateArtikel" id="edit" data-index="{{ $i }}" data-id="{{ $item['id'] }}">
                        <img src="assets/images/edit.svg" alt="" srcset="" width="16" height="16">
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" id="delete" data-id="{{ $item['id']}}">
                        <img src="assets/images/trash.svg" alt="" srcset="" width="16" height="16">
                    </a>
                    </td>
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
                                <form action="{{ route('deleteArtikel') }}" method="post">
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
                <div class="modal fade text-left w-100" id="updateArtikel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                        role="document">
                        <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('updateArtikel') }}" role="form" files=true>
                            {{ method_field('PUT') }}
                            <input type="hidden" name="id" id="id">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel16">Edit artikel</h4>
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
                                                                    <input type="text" id="judulu" class="form-control" placeholder="Judul"
                                                                        name="judul">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="form-group">
                                                                  <label for="pembuat">Pembuat</label>
                                                                  <input type="text" id="pembuatu" class="form-control" placeholder="Pembuat"
                                                                      name="pembuat" readonly="readonly" value="{{ Session::get('name') }}">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                              <div class="form-group">
                                                                  <label for="exampleFormControlTextarea1">Konten</label>
                                                                  <textarea class="form-control" id="kontenu" placeholder="Keterangan"
                                                                      rows="16" name="konten"></textarea>
                                                              </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div>Gambar</div>
                                                                <div class="form-file">
                                                                    <input type="file" class="form-file-input" id="imageu" name="image" onchange="document.getElementById('outputu').src = window.URL.createObjectURL(this.files[0])">
                                                                    <label class="form-file-label" for="image">
                                                                        <span class="form-file-button">Browse</span>
                                                                    </label>
                                                                </div>
                                                                <br>
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
<div class="modal fade text-left w-100" id="createArtikel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
        role="document">
        <form class="form" method="POST" enctype="multipart/form-data" action={{ route('postArtikel') }} role="form" files=true>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Buat artikel</h4>
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
                                                  <label for="pembuat">Pembuat</label>
                                                  <input type="text" id="pembuat" class="form-control" placeholder="Pembuat"
                                                      name="pembuat" readonly="readonly" value="{{ Session::get('name') }}">
                                              </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                              <div class="form-group">
                                                  <label for="exampleFormControlTextarea1">Konten</label>
                                                  <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Keterangan"
                                                      rows="16" name="konten"></textarea>
                                              </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div>Gambar</div>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input" id="image" name="image" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                                    <label class="form-file-label" for="image">
                                                        <span class="form-file-button">Browse</span>
                                                    </label>
                                                </div>
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
    var jobs = {!! json_encode($artikel) !!};
    var data = jobs[index];
    $('#judulu').val(data['title']);
    $('#kontenu').val(data['content']);
    $('#id').val(id);
    $('#outputu').attr('src', 'http://localhost:8080/storage/'+data['image']);
});

});

$(document).ready(function () {

$('body').on('click', '#delete', function (event) {

        event.preventDefault();
        var id = $(this).data('id');
        $('#idd').val(id);
    });

}); 
</script>
@endsection
