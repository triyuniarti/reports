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
                    <p><a href="{{ url("home/create") }}"><button type="button" class="btn btn-success">Create</button></a></p>
                    <table cellspacing="0" class="table table-striped table-bordered" id="reports">
                        <thead>
                            <tr>
                                <th>Report Date</th>
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
                                                <li><a href="{{ url("home/delete", $data->id) }}"  {{--data-toggle="modal" data-target="#delete"--}}>Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade bs-example-modal-sm" id="delete" role="dialog">
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
                                                <a href="{{ url("home/delete", $data->id) }}"><button type="submit" class="btn btn-primary">Yes</button></a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Sedangkan, bila tidak ada isinya, tampilkan isi berikut -->
                    @else
                        <p><a href="{{ url("home/create") }}"><button class="btn btn-primary">Create</button></a></p>
                        <p>No result.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
