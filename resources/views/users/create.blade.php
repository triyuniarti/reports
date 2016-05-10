@extends('layouts.app')

@section('content')
<div class="container spark-green">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create Report</div>

                <div class="panel-body">
                    {{--@if ( $errors->count() > 0 )
                        <div class="alert alert-danger">
                            <ul>
                                @foreach( $errors->all() as $message )
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif--}}
                    <form class="form-horizontal" method="post" action="{{ url("home/create") }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('report_date') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Report Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="report_date" placeholder="Report Date">
                                @if ($errors->has('report_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('report_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                @if($category->count())
                                    <select class="form-control" name="category_id">
                                        <option>-- Choose --</option>
                                        @foreach($category as $data)
                                            <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                                        @endforeach
                                        @if ($errors->has('category_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                    </select>
                                @else
                                    <select class="form-control" disabled>
                                        <option>Please add category</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Subject</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subject" placeholder="Subject">
                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="10" name="description" placeholder="Description"></textarea>
                                {{--<textarea id="editor" name="description" rows="7" class="form-control ckeditor" placeholder="Description"></textarea>--}}
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('attachments') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Attachments</label>
                            <div class="col-sm-10">
                                <input id="attachments" name="attachments" type="file" class="file">
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachments') }}</strong>
                                    </span>
                                @endif
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
