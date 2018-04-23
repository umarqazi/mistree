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
                                  <h4>Workshop Query</h4>
                                  <p>Workshop Name : @if(!is_null($workshopQuery->workshop)){{ $workshopQuery->workshop->name}}@endif</p>
                                  <p>Workshop ID : @if(!is_null($workshopQuery->workshop)){{ $workshopQuery->workshop->workshopId}}@endif</p>
                                  <p>Mobile : @if(!is_null($workshopQuery->workshop)){{$workshopQuery->workshop->mobile}}@endif</p>
                                  <p>Email :@if(!is_null($workshopQuery->workshop)) {{$workshopQuery->workshop->email}}@endif</p>
                                  <p>Date : {{$workshopQuery->created_at }}</p>
                              </div>
                              <div class="col-md-2">@include('partials.backbtn_workshop_query')</div>
                          </div>
                          <div class="clear20"></div>
                          <div class="row">
                              <div class="col-md-12">
                                  <h5 class="title">Subject : {{$workshopQuery->subject}}</h5>
                                  <div class="clear20"></div>
                                  <div class="form-group">
                                      <h5 class="title">Description : </h5>
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