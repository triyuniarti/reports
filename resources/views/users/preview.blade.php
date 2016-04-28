@extends('layouts.app')

@section('content')
<div class="container spark-green">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create Report</div>

                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Report Date</label>
                            <div class="col-sm-10">
                                {{ $report->report_date }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                {{ $report->category_name }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Subject</label>
                            <div class="col-sm-10">
                                {{ $report->subject }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                {{ $report->description }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                @if(Auth::user()->admin == 1)
                                    <a href="{{ url("home/reports") }}"><button class="btn btn-primary">Back</button></a>
                                @else
                                    <a href="{{ url("/home") }}"><button class="btn btn-primary">Back</button></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
