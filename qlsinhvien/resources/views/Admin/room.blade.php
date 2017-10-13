@extends('layouts.app')
@section('title')
Quản lý phòng học
@endsection
@section('content')
<div ng-controller="MainCtrl">
      <div id="grid1" ui-grid="gridOptions" class="grid"></div>
    </div>
@endsection
