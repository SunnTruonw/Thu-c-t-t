@extends('admin.layouts.main')
@section('title',"Thêm slider")
@section('css')
@endsection
@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header',['name'=>"Slider","key"=>"Thêm hình ảnh"])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              @if(session("alert"))
                <div class="alert alert-success">
                    {{session("alert")}}
                </div>
              @elseif(session('error'))
                <div class="alert alert-warning">
                    {{session("error")}}
                </div>
              @endif
              <form action="{{route('admin.slider.store')}}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-8">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                <h3 class="card-title">Thông tin hình ảnh</h3>
                                </div>
                                <div class="card-body table-responsive p-3">
                                    <div class="form-group">
                                        <label for="">Tên</label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" placeholder="Nhập tên">
										@error('name')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
                                    </div>
                                    <div class="form-group">
                                            <label for="">Slug</label>
                                            <input type="text"
                                                class="form-control @error('slug') is-invalid @enderror"

                                                value="{{ old('slug') }}"
                                                name="slug"
                                                placeholder="Nhập slug"
                                            >
                                    </div>
                                        @error('slug')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    <div class="form-group">
                                            <label for="">Nhập giới thiệu</label>
                                            <textarea class="form-control tinymce_editor_init" name="description" id="" rows="3" value="{{ old('description') }}"  placeholder="Nhập giới thiệu"></textarea>
                                    </div>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="card card-outline card-primary">
                                 <div class="card-body table-responsive p-3">

                                    <div class="form-group">
                                        <label class=" control-label" for="">Chọn danh mục</label>
                                        <select
                                            class="form-control custom-select select-2-init @error('category_id')
                                              is-invalid
                                             @enderror"
                                            id="" value="{{ old('category_id') }}" name="category_id">

                                            <option value="0">--- Chọn danh mục cha ---</option>
                                            @if (old('category_id'))
                                                {!! \App\Models\CategorySlider::getHtmlOption(old('category_id')) !!}
                                            @else
                                                {!! $option !!}
                                            @endif
                                        </select>
                                        @error('category_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="wrap-load-image mb-3">
                                        <div class="form-group">
                                            <label for="">Hình ảnh</label>
                                            <input
                                               type="file"
                                               class="form-control-file img-load-input border"
                                               id=""
                                               name="image_path"
                                               >
                                         </div>
                                         @error('image_path')
                                         <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror
                                         <img class="img-load border p-1 w-100" src="{{asset('admin_asset/images/upload-image.png')}}" alt="no image" style="height: 200px;object-fit:cover;">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="1" name="active" @if(old('active')==="1"||old('active')===null) {{'checked'}}  @endif>Hiện
                                        </label>
                                        </div>
                                        <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="0" @if(old('active')==="0"){{'checked'}}  @endif name="active">Ẩn
                                        </label>
                                        </div>
                                    </div>
                                    @error('active')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label class="control-label" for="">Số thứ tự</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            value="{{ old('order') }}"
                                            name="order"
                                            placeholder="Nhập số thứ tự"
                                        >
                                        @error('order')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
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
