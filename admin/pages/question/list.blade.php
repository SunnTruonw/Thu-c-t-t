@extends('admin.layouts.main')
@section('title',"Danh sach câu hỏi")

@section('css')

@endsection
@section('content')
<div class="content-wrapper">

    @include('admin.partials.content-header',['name'=>"Câu hỏi","key"=>"Danh sách câu hỏi"])

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
                <div class="text-right">
                    <a href="{{route('admin.question.create',['parent_id'=>request()->parent_id??0])}}" class="btn  btn-info btn-md mb-2">+ Thêm mới</a>
                </div>
                <div class="card card-outline card-info">
                    <div class="card-header pt-2 pb-2">
                        <div class="cart-title">
                            <i class="fas fa-list"></i> Câu hỏi
                        </div>
                    </div>
                </div>

                @if (isset($parentBr)&&$parentBr)
                <ol class="breadcrumb">
                  <li><a href="{{ route('admin.question.index',['parent_id'=>0]) }}">Root</a></li>

                  @foreach ($parentBr->breadcrumb as $item)
                   <li><a href="{{ route('admin.question.index',['parent_id'=>$item['id']]) }}">{{ $item['name'] }}</a></li>
                  @endforeach

                  <li><a href="{{ route('admin.question.index',['parent_id'=>$parentBr->id]) }}">{{ $parentBr->name }}</a></li>
                </ol>
                @endif
                    <div class="card card-outline card-primary">
                        <div class="card-body table-responsive lb-list-category">
                            @include('admin.components.category', [
                                'data' => $data,
                                'routeNameEdit'=>'admin.question.edit',
                                'routeNameAdd'=>'admin.question.create',
                                'routeNameDelete'=>'admin.question.destroy',
                                'routeNameOrder'=>'admin.loadOrderVeryModel',
                                 'table'=>'questions',
                            ])
                        </div>
                    </div>

            </div>
            <div class="col-md-12">
                {{$data->links()}}
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('js')
@endsection
