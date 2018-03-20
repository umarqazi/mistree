@extends('layouts.master')
@section('title', 'Create New Workshop Query')
@section('content')

    @include('partials.header')


    <div class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (session('success_message'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        {{ session('success_message') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (session('error_message'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        {{ session('error_message') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form method="POST" action="{{ url('workshop-queries') }}">
                            {!! csrf_field() !!}
                            <div class="header">
                                @if ($errors->any())
                                    <div class="row text-center alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <div><span class="manadatory">{{ $error }}</span></div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="title">Workshop Query - Submit New Request</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="subject" class="control-label">Subject:</label>
                                            <input type="text" class="form-control border-input" id="subject" name="subject" placeholder="Subject">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="message" class="control-label">Message:</label>
                                            <textarea class="form-control border-input" rows="5" id="message" name="message" placeholder="Enter your query here..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control btn btn-primary border-input" type="submit" name="submit" value="Submit Request">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clear20"></div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
    @include('partials.footer')
@endsection