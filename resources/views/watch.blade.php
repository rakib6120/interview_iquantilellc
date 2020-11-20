@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-body">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <video class="bg-dark" src="{{ url('uploads/' . $data->source) }}" controls style="width: 100%"></video>
                        <div class="card">
                            <div class="card-body">
                                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" alt="" class="rounded-circle" style="width:3em; height: 3em" />
                                <span>{{ $data->video_uploader->name }}</span>
                                <p>{{ $data->desc }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h3 class="pull-left">Top Responses</h3>
                        <a href="#" class="pull-right">View All</a>
                        <br>
                        <br>
                        <ul>
                            @foreach ($top_rate as $rate)
                                <li>{{ $rate->name }} -- {{ $rate->rate }}</li>
                            @endforeach
                        </ul>
                        <h3>Average Responses rating</h3>
                        <p>{{ $data->rate }} Star</p>
                        <h3>Sentiment</h3>
                        <p><i class="fa fa-smile-o fa-2x text-success"></i> {{ $positive_responsive }} % Positive Responsive</p>
                        <p><i class="fa fa-frown-o fa-2x text-danger"></i> {{ $negative_responsive }} % Negative Responsive</p>
                    </div>
                    <div class="col-md-12">
                        <h3>All Comments</h3>
                        @foreach ($comments as $item)
                            <div class="card mb-3">
                                <div class="card-body row">
                                    <div class="col-md-4">
                                        <p>
                                            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" alt="" class="rounded-circle" style="width:3em; height: 3em" />
                                            <span class="ml-2">
                                                {{ $item->name }}
                                                age : {{ $item->age }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>{{ $item->rate }} star</p>
                                        <p>{{ $item->comment }}</p>
                                    </div>
                                    <div class="col-md-2">{{ $data->created_at }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-12">
                        <h3>Add comment</h3>
                        <div class="card">
                            <div class="card-body">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        {{$error}}
                                    </div>
                                    @endforeach
                                @endif
                                <form class="row" method="post" action="{{ url('rate-video/' . $data->id) }}">
                                    @csrf
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Age</label>
                                        <input type="text" class="form-control" name="age">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Rating</label>
                                        <input type="text" max="5" min="1" class="form-control" name="rating">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Comment</label>
                                        <textarea class="form-control" name="comment"></textarea>
                                    </div>

                                    <button type="reset" class="btn btn-danger ">Cancel</button>
                                    <button type="submit" class="btn btn-info ml-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
