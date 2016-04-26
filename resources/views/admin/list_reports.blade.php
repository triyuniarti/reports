@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>List Reports</b>
                </div>

                <div class="panel-body">

                    <!-- Jika tabel biodata memiliki isi-->
                    @if($report->count())
                    <table cellspacing="0" class="table table-striped table-bordered" id="reports">
                        <thead>
                            <tr>
                                <th>Report Date</th>
                                <th>Name</th>
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
                                    <td>{{ $data->name }}</td>
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
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- bila tidak ada isinya -->
                    @else
                        <p>No result.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
