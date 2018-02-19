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
                                  </div>

                                  <div class="form-group">  
                                    <label class="control-label">Loyalty Points</label>
                                    <input type="text" class="form-control border-input" name="loyalty_points" required="required">
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