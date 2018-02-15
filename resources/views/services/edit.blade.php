@extends('layouts.master')
@section('title', 'Create New Workshop')
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
                                <h4 class="title">Workshop Management - Edit Service</h4>
                            </div>
                        </div>
                    </div>
                    <div class="clear20"></div>
                    <form method="POST" action="{{ url('admin/services/') }}{{"/".$service->id}}"> 
                      {{ csrf_field() }}
                      <div class="content">      
                          <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                  <div class="form-group">  
                                    <label class="control-label">Service Name</label>
                                    <input type="text" class="form-control border-input" name="name" value="{{ $service->name }}" required="required">
                                  </div>

                                  <div class="form-group">  
                                    <label class="control-label">Loyalty Points</label>
                                    <input type="text" class="form-control border-input" value="{{ $service->loyalty_points }}" name="loyalty_points" required="required">
                                    <input type="hidden"  value="PUT" name="_method"">
                                  </div>

                                  <div class="form-group">  
                                    <label class="control-label">Parent</label>
                                    <select class="form-control border-input" name="parent_id" >
                                      <option value="0">Select Option</option>
                                      @foreach($services as $key => $value)
                                          @if( $service->parent_id == $value->id)
                                            <option selected value="{{$value->id}}">{{$value->name}}</option>
                                            @else
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                          @endif
                                      @endforeach
                                    </select>
                                  </div> 

                                  <div class="form-group">  
                                    <label class="control-label">Image</label>
                                    <input type="file" value="{{ $service->image }}" name="image">
                                  </div> 

                                  <div class="form-group">  
                                    <button type="submit" class="btn btn-header pull-right">Save</button>
                                  </div> 

                              </div>  

                              <div class="col-md-3"></div>                            
                           </div> <!-- /end row -->
                      </div> <!-- /end content -->
                    </form>
                </div>
            </div>
        </div>
     </div>

  </div>
</div>

</div>
@endsection