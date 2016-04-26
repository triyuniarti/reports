@extends('layouts.app')

@section('content')
<div class="container spark-green">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Change Password</div>

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

                    <!-- variabel message untuk menampilkan nilai variabel yang diterima dari controller -->
                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert alert-success') }} alert-dismissable"> {{ Session::get('success') }}</p>
                    @endif

                    @if(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert alert-danger') }} alert-dismissable"> {{ Session::get('failed') }}</p>
                    @endif

                    <form class="form-horizontal" method="post" action="{{ url("home/password") }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-sm-offset-2 col-sm-2 control-label">Old Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="old_password" placeholder="Old Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-offset-2 col-sm-2 control-label">New Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="new_password" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-offset-2 col-sm-2 control-label">Re-type New Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="retype_password" placeholder="Re-type New Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
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
