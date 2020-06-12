@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">


                    <h2 style="text-align:center">Please verify your OTP</h2>




                        {!! Form::open(['url' => '/verify-otp','method'=>'post']) !!}
                        <div class="row">
                          <div class="col-md-6">
                        <div class="col-md-12">{{ Form::text('otp',null, ['required','class'=>'center','placeholder'=>'Enter your 5 digit OTP']) }}</div>
                        </div>
                        <div class="col-md-6">
                          {{ Form::submit('Submit', ['name' => 'submit']) }}
                        </div>
                        @if(session()->has('error'))
                            <div class="alert alert-success">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')

<style>
.center {
  margin: auto;
  width: 50%;
  border: 3px solid green;
  padding: 10px;
}
</style>
@endsection

@section('script')

@endsection
