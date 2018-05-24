@extends('layouts.master')
@section('title', 'Workshop Details')
@section('content')

    @include('partials.header')

    <div class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ url('admin/store-workshop-service') }}">
                            <input type="hidden" value="{{$workshop->id}}" name="workshop_id">
                            {!! csrf_field() !!}
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h4 class="title">{{$workshop->name}}</h4>
                                        <p>Add Services</p>
                                    </div>
                                    <div class="col-md-2">@include('partials.backbtn_workshop_back')</div>
                                </div>
                            </div>
                            <div class="clear20"></div>
                            <div class="content">
                                <div class="row services-row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="child-box-wrap">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="form-group">
                                                        <label class="control-label">Select Category<span
                                                                    class="manadatory">*</span></label>
                                                        <select class="form-control chosen-select  border-input"
                                                                name="category_id" onchange="getServices({{$workshop->id}})"
                                                                id="category_id">
                                                            <option value="" disabled selected>Select Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{$category->id}}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('category_id'))
                                                            <span class="help-block">
                                                                <strong class="manadatory">{{ $errors->first('category_id')}}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Select Service <span class="manadatory">*</span></label>
                                                        <select class="form-control border-input" name="service_id"
                                                                id="service_ids" disabled>
                                                            <option value="" disabled selected>Select Service</option>
                                                        </select>
                                                        @if ($errors->has('service_id'))
                                                            <span class="help-block">
                                                  <strong class="manadatory">{{ $errors->first('service_id') }}</strong>
                                              </span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Service Rate PKR <span
                                                                class="manadatory">*</span></label>
                                                    <input type="number" class="form-control border-input" name="service_rate" Required max="99999" >
                                                    @if ($errors->has('service_rate'))
                                                        <span class="help-block">
                                                <strong class="manadatory">{{ $errors->first('service_rate') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Enter Time</label>
                                                    <select name ="service_time" class="form-control chosen-select border-input">
                                                        <option value="1.0">1.0 hr</option>
                                                        <option value="1.5">1.5 hr</option>
                                                        <option value="2.0">2.0 hr</option>
                                                        <option value="2.5">2.5 hr</option>
                                                        <option value="3.0">3.0 hr</option>
                                                        <option value="3.5">3.5 hr</option>
                                                        <option value="4.0">4.0 hr</option>
                                                        <option value="4.5">4.5 hr</option>
                                                        <option value="5.0">5.0 hr</option>
                                                        <option value="5.5">5.5 hr</option>
                                                        <option value="6">6.0 hr</option>
                                                        <option value="6.5">6.5 hr</option>
                                                        <option value="7.0">7.0 hr</option>
                                                        <option value="7.5">7.5 hr</option>
                                                        <option value="8.0">8.0 hr</option>
                                                        <option value="8.5">8.5 hr</option>
                                                        <option value="9.0">9.0 hr</option>
                                                        <option value="9.5">9.5 hr</option>
                                                        <option value="10">10 hr</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    </div>

                                </div>
                                <!-- End Row -->

                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a class="btn btn-header" href="{{url('admin/workshops/'.$workshop->id)}}">Back</a>
                                            <input type="submit" value="Store Service" class="btn btn-header">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getServices(workshop) {
            var id = $("#category_id").val();
            $('#service_ids').children().remove();
            $.ajax({
                type : 'post',
                url : '{{ url('admin/get-category-services') }}',
                data : {workshop : workshop, category : id, _token : '{{ csrf_token() }}'},
                dataType: "json",
                success : function (response){
                    $.each(response, function(i, service) {
                        $('#service_ids').removeAttr('disabled');
                        if(service.is_doorstep == true){
                            $('#service_ids').append('<option value="' + service.id +'">' + service.name + ' at doorstep' + '</option>');
                        }else{
                            $('#service_ids').append('<option value="' + service.id +'">' + service.name + '</option>');
                        }
                    });
                }
            })
        }

    </script>

    @include('partials.footer')
@endsection