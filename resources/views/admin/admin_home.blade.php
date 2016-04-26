@extends('layouts.app')

@section('content')
<div class="container spark-green">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Admin</div>

                <div class="panel-body">
                    Welcome, <b>{{ Auth::user()->name }}</b><br>
                    You are logged in as admin, you can see all of the staff report.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
