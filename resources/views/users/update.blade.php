@extends('layouts.app')

@section('content')
<div class="container spark-green">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create Report</div>

                <div class="panel-body">
                    @if ( $errors->count() > 0 )
                        <div class="alert alert-danger">
                            <ul>
                                @foreach( $errors->all() as $message )
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-horizontal" method="post" action="{{ url("home/update", $report->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Report Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="report_date" value="{{ $report->report_date }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Subject</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subject" value="{{ $report->subject }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="10" name="description">{{ $report->description }}</textarea>
                                {{--<textarea id="editor" name="description" rows="7" class="form-control ckeditor">{{ $report->description }}</textarea>--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Submit</button>
                                <a href="{{ url("/home") }}"><button type="button" class="btn btn-default">Cancel</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
