@extends('admin.layouts.main')
@section('title', 'Thêm danh mục ' . $categoryConfig['type'])
@section('content')


    <div class="content-wrapper">

        @include('admin.partials.content-header',['name'=>"Danh mục","key"=>"Thêm danh mục ".$categoryConfig['type']])


        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('alert'))
                            <div class="alert alert-success">
                                {{ session('alert') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-warning">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form class="form-horizontal" action="{{ route($categoryConfig['routeNameStore']) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-header">
                                        @foreach ($errors->all() as $message)
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-tool p-3 text-right">
                                        <button type="submit" class="btn btn-primary btn-lg">Chấp nhận</button>
                                        <button type="reset" class="btn btn-danger btn-lg">Làm lại</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Thông tin danh mục</h3>
                                        </div>
                                        <div class="card-body table-responsive p-3">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#tong_quan">Tổng
                                                        quan</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#hinh_anh">Hình
                                                        ảnh</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#seo">Seo</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">

                                                <!-- START Tổng Quan -->
                                                <div id="tong_quan" class="container tab-pane active"><br>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Tên danh
                                                                mục</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="name"
                                                                    value="{{ old('name') }}" name="name"
                                                                    placeholder="Nhập tên danh mục" required="required">
                                                            </div>
                                                        </div>
                                                        @error('name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Slug</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control lb_load_slug"
                                                                    id="slug" value="{{ old('slug') }}" name="slug"
                                                                    placeholder="Nhập slug" required="required">
                                                            </div>
                                                        </div>
                                                        @error('slug')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Nhập giới
                                                                thiệu</label>
                                                            <div class="col-sm-10">
                                                                <textarea
                                                                    class="form-control  @error('description') is-invalid @enderror"
                                                                    name="description" id="" rows="3"
                                                                    placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                                                            </div>
                                                        </div>


                                                        @error('description')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Nhập nội
                                                                dung</label>
                                                            <div class="col-sm-10">
                                                                <textarea
                                                                    class="form-control tinymce_editor_init @error('content') is-invalid  @enderror"
                                                                    name="content" id="" rows="20" value=""
                                                                    placeholder="Nhập nội dung"> {{ old('content') }}</textarea>
                                                            </div>
                                                        </div>
                                                        @error('content')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- END Tổng Quan -->




                                                <!-- START Hình Ảnh -->
                                                <div id="hinh_anh" class="container tab-pane fade"><br>
                                                    <div class="wrap-load-image mb-3">
                                                        <div class="form-group">
                                                            <label for="">Ảnh đại diện</label>
                                                            <input type="file"
                                                                class="form-control-file img-load-input border" id=""
                                                                value="" name="avatar_path">
                                                        </div>
                                                        @error('avatar_path')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <img class="img-load p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            alt="" style="height: 170px;object-fit:cover;max-width: 260px;">
                                                    </div>
                                                    <div class="wrap-load-image mb-3">
                                                        <div class="form-group">
                                                            <label for="">Ảnh icon</label>
                                                            <input type="file"
                                                                class="form-control-file img-load-input border" id=""
                                                                value="" name="icon_path">
                                                        </div>
                                                        @error('icon_path')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <img class="img-load p-1 w-100"
                                                            src="{{ asset('admin_asset/images/upload-image.png') }}"
                                                            alt="" style="object-fit:cover;max-width: 50px;width:auto;">
                                                    </div>
                                                </div>
                                                <!-- END Hình Ảnh -->
                                                <!-- START Seo -->
                                                <div id="seo" class="container tab-pane fade"><br>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Nhập title
                                                                seo</label>
                                                            <div class="col-sm-10">
                                                                <input type="text"
                                                                    class="form-control @error('title_seo') is-invalid @enderror"
                                                                    id="" value="{{ old('title_seo') }}" name="title_seo"
                                                                    placeholder="Nhập title seo">
                                                            </div>
                                                        </div>
                                                        @error('title_seo')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Nhập mô tả
                                                                seo</label>
                                                            <div class="col-sm-10">
                                                                <input type="text"
                                                                    class="form-control @error('description_seo') is-invalid @enderror"
                                                                    id="" value="{{ old('description_seo') }}"
                                                                    name="description_seo" placeholder="Nhập mô tả seo">
                                                            </div>
                                                        </div>
                                                        @error('description_seo')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 control-label" for="">Nhập từ khóa
                                                                seo</label>
                                                            <div class="col-sm-10">
                                                                <input type="text"
                                                                    class="form-control @error('keyword_seo') is-invalid @enderror"
                                                                    id="" value="{{ old('keyword_seo') }}"
                                                                    name="keyword_seo" placeholder="Nhập từ khóa seo">
                                                            </div>
                                                        </div>
                                                        @error('keyword_seo')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- END Seo -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card card-outline card-primary">
                                        {{-- <div class="card-header">
                                    <h3 class="card-title">Thông tin thêm</h3>
                                </div> --}}
                                        <div class="card-body table-responsive p-3">
                                            <div class="form-group">
                                                <label class="control-label" for="">Chọn danh mục cha</label>
                                                <select class="form-control custom-select" id=""
                                                    value="{{ old('parent_id') }}" name="parent_id">
                                                    <option value="0">Chọn danh mục cha</option>
                                                    @if (old('parent_id'))
                                                        {!! $modelInstance->getHtmlOptionAddWithParent(old('parent_id')) !!}
                                                    @else
                                                        {!! $option !!}
                                                    @endif
                                                </select>
                                                @error('parent_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Số thứ tự</label>
                                                <input type="number" class="form-control" value="{{ old('order') }}"
                                                    name="order" placeholder="Nhập số thứ tự">
                                                @error('order')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="">Trạng thái</label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="1"
                                                            name="active" @if (old('active') === '1' || old('active') === null){{ 'checked' }}  @endif>
                                                        Hiện
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="0"
                                                            @if (old('active') === '0') {{ 'checked' }}  @endif name="active">
                                                        Ẩn
                                                    </label>
                                                </div>
                                                @error('active')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
