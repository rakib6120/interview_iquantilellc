@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-body">
                @foreach ($data as $key => $item)
                    <div class="col-md-12 row">
                        <div class="col-md-5">
                            <video class="bg-dark" src="{{ url('uploads/' . $item->source) }}" controls style="width: 100%; height: 12em;"></video>
                        </div>
                        <div class="col-md-7">
                            <p>{{ $item->desc }}</p>
                            <p>Uploaded at : {{ $item->created_at }}</p>
                            <a href="{{ url('watch/' . $item->id) }}" class="btn btn-success col-md-12"><i class="fa fa-eye"></i> View</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <hr>
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
