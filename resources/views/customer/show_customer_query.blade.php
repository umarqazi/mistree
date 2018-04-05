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
                                <h4>Customer Queries</h4>
                                <p>Customer Name : {{ $customerQuery->customer->name}}</p>
                                <p>Mobile : {{$customerQuery->customer->mobile}}</p>
                                <p>Email : {{$customerQuery->customer->email}}</p>
                                <p>Date : {{$customerQuery->created_at }}</p>
                            </div>
                        </div>
                        <div class="clear20"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="title">Subject : {{$customerQuery->subject}}</h5>
                                <div class="clear20"></div>
                                <div class="form-group">
                                    <h5 class="title">Description : </h5>
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