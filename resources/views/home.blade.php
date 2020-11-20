@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <p class="float-left">List of videos</p>
                    <a href="{{ url('admin/create') }}" class="btn btn-primary float-right">Upload Video</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-inverse">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>SL.</th>
                                    <th>Video</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td scope="row">{{ $key + $data->firstItem() }}</td>
                                        <td style="width: 40%">
                                            <video class="bg-dark" src="{{ url('uploads/' . $item->source) }}" controls style="width: 100%; height: 12em;"></video>
                                        </td>
                                        <td>
                                            <p>{{ $item->desc }}</p>
                                            <p>Uploaded at : {{ $item->created_at }}</p>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{{ 'admin/'. $item->id . '/edit' }}"><i class="fa fa-edit"></i> Edit</a>
                                            <a class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#delete_modal" onclick="delete_video('{{ $item->id }}')"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="delete_form" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center">
                    <i class="fa fa-trash-o fa-2x text-danger" aria-hidden="true"></i>
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function delete_video(id){
        document.getElementById('delete_form').setAttribute('action', "{{ url('admin') }}" + '/' + id)
    }
</script>
@endsection
