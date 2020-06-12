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

                    <div class="row">
                      <div class="col-md-6">
                        <p><h5>Name</h5></p>
                        <p><h5>Email</h5></p>
                        <p><h5>Date Of Birth</h5></p>
                        <p> <h5>City</h5></p>
                      </div>

                      <div class="col-md-6">
                        <!-- <form method="post" action="{{route('user-registration.update',\Crypt::encrypt($result->id))}}">

                        <p ><div class="col-md-12"> <input type="text" name="name" id="" value="{{isset($result->name)?$result->name:NULL}}"> </div></p>
                        <p ><div class="col-md-12"> <input type="text" name="email" id="" value="{{isset($result->email)?$result->email:NULL}}"> </div></p>
                        <p ><div class="col-md-12"> <input type="text" name="dob" id="" value="{{isset($result->dob)?$result->dob:NULL}}"> </div></p>
                        <p ><div class="col-md-12"> <input type="text" name="city" id="" value="{{isset($result->city)?$result->city:NULL}}"> </div></p>
                        <button type="submit">Submit</button>
                      </form> -->

                          {{ Form::model($result, ['route' => ['user-registration.update', \Crypt::encrypt($result->id)], 'method' => 'patch']) }}
                          <div class="col-md-12">{{ Form::text('name',null, ['required']) }}</div>
                          <div class="col-md-12">{{ Form::text('email',null, ['required']) }}</div>
                          <div class="col-md-12">{{ Form::text('dob') }}</div>
                          <div class="col-md-12">{{ Form::text('city') }}</div>
                          {{ Form::submit('Save', ['name' => 'submit']) }}
                      {{ Form::close() }}

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
