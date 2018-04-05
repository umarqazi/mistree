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
                              <div class="col-md-12">
                                  <h4>Workshop Queries</h4>
                                  <p>Workshop Name : {{ $workshopQuery->workshop->name}}</p>
                                  <p>Mobile : {{$workshopQuery->workshop->mobile}}</p>
                                  <p>Email : {{$workshopQuery->workshop->email}}</p>
                                  <p>Date : {{$workshopQuery->created_at }}</p>
                              </div>
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