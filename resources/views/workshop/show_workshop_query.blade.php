@extends('layouts.master')
@section('title', 'Show Workshop Query')
@section('content')

@include('partials.header')


<div class="content">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                      <div class="header">
                          <div class="row">
                              <div class="col-md-10">
                                  <h4 class="title">{{$workshopQuery->subject}}</h4>
                                  <p>Requested by {{$workshopQuery->workshop->name}}</p> 
                              </div>
                              <div class="col-md-2">@include('partials.backbtn_workshop_query')</div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <p>{{$workshopQuery->message}}</p>
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