@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Report List</b>
                </div>

                <div class="panel-body">
                    <!-- variabel message untuk menampilkan nilai variabel yang diterima dari controller -->
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable"> {{ Session::get('message') }}</p>
                    @endif

                    <!-- Jika tabel biodata memiliki isi-->
                    @if($report->count())
                    <!-- Tombol create -->
                    <div class="btn-create">
                        <a href="#add-category" data-toggle="modal"><button type="button" class="btn btn-success">Add Category Report</button></a>
                        <a href="{{ url("home/create") }}"><button type="button" class="btn btn-primary">Create Report</button></a>
                    </div>
                    <table id="reports" cellspacing="0" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Report Date</th>
                                <th>Category</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Perulangan untuk menampilkan seluruh isi tabel -->
                            @foreach($report as $data)
                                <tr>
                                    <td>{{ $data->report_date }}</td>
                                    <td>{{ $data->category->category_name }}</td>
                                    <td>{{ $data->subject }}</td>
                                    <td>{{ $data->description }}</td>
                                    <!-- Tombol Action -->
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary" id="action" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="action">
                                                <li><a href="{{ url("home/preview", $data->id) }}">View</a></li>
                                                <li><a href="{{ url("home/update", $data->id) }}">Edit</a></li>
                                                <li><a href="#delete_{{ $data->id }}" data-toggle="modal">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal for delete -->
                                <div class="modal fade bs-example-modal-sm" id="delete_{{ $data->id }}" role="dialog">
                                    <div class="modal-dialog modal-sm">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Delete Report</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to delete this report?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ url("home/delete", [$data->id]) }}"><button type="submit" class="btn btn-primary">Yes</button></a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Report Date</th>
                            <th>Category</th>
                            <th>Subject</th>
                            <th style="border-right-width: 1px">Description</th>
                        </tr>
                        </tfoot>
                    </table>
                    <!-- Sedangkan, bila tidak ada isinya, tampilkan isi berikut -->
                    @else
                        <a href="#add-category" data-toggle="modal"><button type="button" class="btn btn-success">Add Category Report</button></a>
                        <a href="{{ url("home/create") }}"><button class="btn btn-primary">Create Report</button></a>
                        <p>No result.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for add category -->
<div class="modal fade" id="add-category" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Category Report</h4>
            </div>
            <form class="form-horizontal" method="post" action="{{ url('home/add-category') }}">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Category Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="category_name" placeholder="Category Name" minlength="3" required>

                            @if ($errors->has('category_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ url("home/delete") }}"><button type="submit" class="btn btn-primary">Create</button></a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
