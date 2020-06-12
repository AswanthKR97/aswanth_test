@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <h2 style="text-align:center">User Profile</h2>
                    <p>
                      <a href="{{route('edit-user',\Crypt::encrypt(\Auth::user()->id))}}" class="btn btn-info btn-lg">
                        <span class="glyphicon glyphicon-pencil"></span> Edit
                      </a>
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <p><h5>Name</h5></p>
                        <p><h5>Email</h5></p>
                        <p><h5>Date Of Birth</h5></p>
                        <p> <h5>City</h5></p>
                      </div>

                      <div class="col-md-6">
                        <p class="title">{{isset($result->name)?$result->name:'NA'}}</p>
                        <p class="title">{{isset($result->email)?$result->email:'NA'}}</p>
                        <p class="title">{{isset($result->dob)?$result->dob:'NA'}}</p>
                        <p class="title">{{isset($result->city)?$result->city:'NA'}}</p>

                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

<style>
.title {
  color: grey;
  font-size: 10px;

}
.btn{
      float: right;
}

</style>
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('script')

@endsection
