@extends('layouts.app')
@section('title')
Trang quản lý
@endsection
@section('content')
<div class="wrapper container-middle text-center">
  <a href="" class="box box-link">Kỳ thi</a>
  <a href="" class="box box-link">Khoá học</a>
  <a href="{{url('admin/room')}}" class="box box-link">Phòng</a>
  <a href="" class="box box-link">Học viên</a>
</div>
@endsection
