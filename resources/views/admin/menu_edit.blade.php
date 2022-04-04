@extends('admin.layout.app')
@section('title', 'Sửa menu')
@section('content_admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa menu</h1>
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
                            {{-- check lỗi validate --}}
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            {{-- check lỗi không lưu được bản ghi trong DB --}}
                            @if (session('err'))
                                <div class="alert alert-danger">
                                    {{ session('err') }}
                                </div>
                            @endif
                            {{-- in thông báo lưu thành công ! --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form role="form" method="post" action="{{ route('p_edit_menu') }}">
                                @csrf
                                <table class="table">
                                    <tr>
                                        <th scope="row">Tên(<span style="color: red">*</span>)</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" value="{{ $menu->name }}" class="form-control"
                                                       id="name" placeholder="Enter name" name="name" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mô tả</th>
                                        <td>
                                            <div class="form-group">
                                                <textarea class="textarea" placeholder="Place some text here"
                                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;"
                                                          name="menu_description">{{ $menu->description }}</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Trạng thái</th>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" id="" name="status">
                                                    <option value="1"
                                                            @if($menu->status == 1)
                                                            selected
                                                            @endif>Hiển thị
                                                    </option>
                                                    <option value="0"
                                                            @if($menu->status == 0)
                                                            selected
                                                            @endif>Ẩn
                                                    </option>
                                                    >Ẩn</option>
                                                </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Thứ tự hiển thị(<span style="color: red">*</span>)</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" value="{{ $menu->m_order }}" class="form-control" id="m_order"
                                                       placeholder="Enter number" name="m_order" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button type="submit" class="btn btn-primary">Submit</button>&emsp;
                                            <a href="{{ route('menus') }}" class="btn btn-warning">Quay Lại</a>
                                        </th>
                                        <td>
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" name="id" value="{{ $menu->id }}">
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
