@extends('layouts.app')

@section('content')
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Список</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Главная</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex p-3">
                            <form action="{{route('list.delete', $list->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Удалить">
                            </form>
                        </div>
                        <form action="{{route('list.update', $list->id)}}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf

                        <div class="mb-3">
                            <label class="form-label">Название</label>
                            <input class="form-control" type="text" name="title" value="{{$list->title}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Картинка</label>
                            <input name="image" type="file" class="form-control" id="exampleInputFile">
                            @if(!empty($list->image))
                            <div>
                                <img src="{{asset($list->image)}}" alt="{{$list->title ?? ''}}" width="150px" height="150px">
                                <a class="m-2 btn btn-danger" href="{{route('deleteImage', $list->id)}}"><span>X</span></a>
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Теги</label>
                            <input class="form-control" type="text" name="tags"
                                   value="{{ implode(',', $list->tags->pluck('name')->toArray()) }}">
                        </div>
                            <input type="hidden" name="user" value="{{$list->user_id}}">
                            <input class="btn btn-primary" type="submit" value="Сохранить">
                        </form>
                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
