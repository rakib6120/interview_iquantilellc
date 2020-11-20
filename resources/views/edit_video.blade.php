@extends('layouts.app')

@section('content')
<div id="loader_div" class="loader_div"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <p class="float-left">Upload video</p>
                    <a href="{{ url('admin') }}" class="btn btn-primary float-right">Back to menu</a>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            {{$error}}
                        </div>
                        @endforeach
                    @endif
                    <form method="POST" action="{{ url('admin/' . $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="source">Upload Video</label>
                            <input name="source" type="file" class="form-control" id="source" placeholder="Upload a video" accept="video/*" />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="desc" class="form-control" id="description" placeholder="Upload your video description">{{ $data->desc }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
