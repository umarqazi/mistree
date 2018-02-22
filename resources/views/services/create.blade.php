@extends('layouts.master')
@section('title', 'Create New Service')
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
                                <h4 class="title">Workshop Management - Create Service</h4>
                            </div>
                        </div>
                    </div>
                    <div class="clear20"></div>
                    <form method="POST" action="{{ url('admin/services') }}" enctype="multipart/form-data"> 
                      {{ csrf_field() }}
                      <div class="content">      
                          <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                  <div class="form-group">  
                                    <label class="control-label">Service Name</label>
                                    <input type="text" class="form-control border-input" name="name" required="required">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('name') }}</strong>
                                        </span>
                                     @endif
                                  </div>
                                  <div class="form-group">  
                                    <label class="control-label">Loyalty Points</label>
                                    <input type="text" class="form-control border-input" name="loyalty_points" value="0">
                                    @if ($errors->has('loyalty_points'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('loyalty_points') }}</strong>
                                        </span>
                                     @endif
                                  </div>

                                  <div class="form-group">  
                                    <label class="control-label">Parent</label>
                                    <select class="form-control border-input" name="parent_id" >
                                      <option value="0">Select Parent</option>
                                      @foreach($services as $key => $value)
                                      <option value="{{$value->id}}">{{$value->name}}</option>
                                      @endforeach
                                    </select>
                                  </div> 

                                  <div class="form-group">  
                                    <label class="control-label">Image</label>
                                    <input type="file" name="image">
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('image') }}</strong>
                                        </span>
                                     @endif
                                  </div> 

                                  <div class="form-group">  
                                    <!-- <label class="control-label">Image</label> -->
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