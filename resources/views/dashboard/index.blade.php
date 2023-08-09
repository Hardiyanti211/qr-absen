@extends('layouts.index')
@section('content')
    <?php 
        $sekarang = date('Y-m-d'); 
        $title = 'Home';
        $admin = DB::table('users')->where('role', '=', 'Admin')->count();
        $karyawan = DB::table('users')->where('role', '=', 'Karyawan')->count();
        $masuk = DB::table('masuk')->where('tanggal_masuk', '=', $sekarang)->count();
    ?>
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $admin }}</h3>
            <p>Admin</p>
          </div>
          <div class="icon">
            <i class="fas fa-user"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $karyawan }}<sup style="font-size: 20px"></sup></h3>
            <p>Karyawan</p>
          </div>
          <div class="icon">
            <i class="fas fa-user"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $masuk }}<sup style="font-size: 20px"></sup></h3>
            <p>Data Presensi Karyawan Hari ini</p>
          </div>
          <div class="icon">
            <i class="fas fa-print"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
@endsection