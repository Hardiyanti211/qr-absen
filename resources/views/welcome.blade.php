<?php 
  $konf = DB::table('setting')->first();
  $hari = date('Y-m-d');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $konf->instansi_setting }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
  </head>
  <body>
    {{-- Start Nav --}}

    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('logo/'.$konf->logo_setting) }}" alt="" style="width: 40px;">{{ $konf->instansi_setting }}</a>
          <div class="d-flex">
            <a href="{{ route('login') }}" class="btn btn-dark">Login</a>
          </div>
        </form>
      </div>
    </nav>

    {{-- End Nav --}}
    <div class="container mt-4">
      <div class="row text-center">
        <h5>Scan QR Disini!</h5>
      </div>
      <div class="row mt-4">
        <div class="col-sm-6 mx-auto mt-3">
          @if ($message = Session::get('Sukses'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
              <strong>{{ $message }}</strong>
          </div>
        @endif
    
        @if ($message = Session::get('Gagal'))
          <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
          </div>
        @endif
          <div class="card bg-light shadow rounded-3 p-3 border-0">
            <video id="preview"></video>
            <form action="{{ route('store') }}" method="POST" id="form">
              @csrf
              <input type="hidden" name="id_user" id="id_user">
            </form>
          </div>
        </div>
        <div class="row table table-responsive mt-3">
          <div class="col-md-6 py-5 mr-3">
            <h3>Data Presensi Masuk {{ Carbon\Carbon::parse($hari)->isoFormat('dddd, D MMMM ')  }}</h3>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Status</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="col md-6 py-5 ml-3">
            <h3>Data Presensi Pulang {{ Carbon\Carbon::parse($hari)->isoFormat('dddd, D MMMM ') }}</h3>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($masuk as $row)
                    <tr>
                      <td>{{ $row->name }}</td>
                      <td>{{ Carbon\Carbon::parse($row->tanggal_masuk)->isoFormat('dddd, D MMMM Y')  }}</td>
                      <td>{{ $row->jam_masuk }}</td>
                      <td>
                          @if ($row->jam_masuk <= $konf->masuk_setting)
                              Berhasil
                          @else
                              Telat    
                          @endif
                      </td>
                    </tr>
                @endforeach
              </tbody>
              <tbody>
                @foreach ($pulang as $row)
                    <tr>
                      <td>{{ $row->name }}</td>
                      <td>{{ Carbon\Carbon::parse($row->tanggal_pulang)->isoFormat('dddd, D MMMM ') }}</td>
                      <td>{{ $row->jam_pulang }}</td>
                      <td>
                        @if ($row->jam_pulang >= $konf->pulang_setting)
                        Berhasil
                       @else
                        Bolos
                        @endif
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
   
  </body>
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  {{-- Script Kamera --}}
  <script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
      console.log(content);
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });

    scanner.addListener('scan', function(c){
      document.getElementById('id_user').value = c;
      document.getElementById('form').submit();
    })
  </script>
</html>
