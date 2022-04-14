@extends('admin.layout.app')
@section('title', 'Setting')
@section('content_admin')
    <style>
        th {
            width: 250px;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Web Setting</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-primary">
                            {{-- in thông báo lưu thành công ! --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form role="form" method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <table class="table">
                                    <tr>
                                        <th scope="row">Địa Chỉ</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id=""
                                                       placeholder="Enter address" name="address"
                                                       value="{{ isset($setting->address) ? $setting->address : '' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="email" class="form-control" id=""
                                                       placeholder="Enter address" name="email"
                                                       value="{{ isset($setting->email) ? $setting->email : '' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Số điện thoại</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id=""
                                                       placeholder="Enter phone number" name="phone"
                                                       value="{{ isset($setting->phone) ? $setting->phone : '' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Logo</th>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                               id="exampleInputFile" name="logo_img">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <p><b>Logo hiện tại: </b></p>
                                            @if(isset($setting->logo_img))
                                                @php
                                                    $type = explode(".",$setting->logo_img);
                                                @endphp
                                                @if(end($type) == "mp4")
                                                    <video width="100" controls>
                                                        <source src="images/{{ $setting->logo_img }}" type="video/mp4">
                                                    </video>
                                                @else
                                                    <a href="images/{{ $setting->logo_img }}"><img
                                                            src="images/{{ $setting->logo_img }}"
                                                            style="width: 100px; cursor: pointer"></a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Background</th>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                               id="exampleInputFile" name="bg_img">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <p><b>Background hiện tại: </b></p>
                                            @if(isset($setting->bg_img))
                                                @php
                                                    $type = explode(".",$setting->bg_img);
                                                @endphp
                                                @if(end($type) == "mp4")
                                                    <video width="100" controls>
                                                        <source src="images/{{ $setting->bg_img }}" type="video/mp4">
                                                    </video>
                                                @else
                                                    <a href="images/{{ $setting->bg_img }}"><img
                                                            src="images/{{ $setting->bg_img }}"
                                                            style="width: 100px; cursor: pointer"></a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button type="submit" class="btn btn-primary">Submit</button>&emsp;
                                            <a href="{{ route('index') }}" class="btn btn-warning">Quay Lại</a>
                                        </th>
                                        <td>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </section>
    </div>
    <!-- /.content -->
@stop
@section('script')
    <script>
        $("ul li:nth-child(6) > a").addClass("active");
    </script>
@stop
