@extends('layouts.master')
@section('title', 'Show Customer Query')
@section('content')

@include('partials.header')


<div class="content">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                      <div class="header">
                          <div class="row">
                              <div class="col-md-12">
                                  <h4 class="title">{{$customerQuery->subject}}</h4>
                                  <p>Requested by {{$customerQuery->customer->name}}</p> 
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <p>{{$customerQuery->message}}</p>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="clear20"></div>
      
                </div>

            </div>
        </div>
    </div>

</div>
@include('partials.footer')
@endsection