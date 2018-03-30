@extends('layouts.master')
@section('title', 'Authhorized Workshops')
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
                                <h4 class="title">Authorized Workshops</h4>
                                <p class="category">List of all authorized workshops.</p>
                            </div>
                        </div>
                        <div class="clear20"></div>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-6 balance-info">                         
                                <div class="clear10"></div>
                                <div class="dropdown pull-right">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   + More Options
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="{{ url('admin/workshops') }}" class="">All Workshops</a>
                                        <a href="{{ url('admin/unauthorized-workshops') }}" class="">UnAuthorized Workshops</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear20"></div>
                    <div class="content table-responsive table-full-width">
                        <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info" style="padding: 10px;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 130px;">Workshop Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 142px;">Owner Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 207px;">Area</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Services Booked: activate to sort column ascending" style="width: 156px;">Balance</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Time: activate to sort column ascending" style="width: 114px;">Leads</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="&amp;nbsp;: activate to sort column ascending" style="width: 57px;">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="&amp;nbsp;: activate to sort column ascending" style="width: 57px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($workshops as $key => $value)    
                                <tr role="row" class="odd">
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->owner_name }}</td>
                                    @if($value->address)
                                    <td>{{ $value->address->town }}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>{{ $value->balance['balance'] }}</td>
                                    @php $leads = $value->bookings->count(); @endphp
                                    <td>{{ $leads }}</td>
                                    <td>
                                        @if( ! $value->is_approved )
                                            Not Approved
                                        @else
                                            Approved
                                        @endif
                                    <td>
                                        <form method="POST" id="ws_block_form" action="workshops/{{ $value->id }}" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    @if(! $value->is_approved )
                                            <a href="{{ url( 'admin/approve-workshop/'.$value->id ) }}" class="ti-check" data-toggle="tooltip" data-placement="top" title="Approve"></a>
                                        @endif
                                            <a class= "mistri-icons ti-eye" href="{{url('admin/workshops/'. $value->id)}}" data-toggle="tooltip" data-placement="top" title="View"></a>
                                            <a class= "mistri-icons ti-pencil-alt" href="{{url('admin/workshops/'.$value->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Edit"></a>
                                            <button class="mistri-icons block_button" data-toggle="tooltip" data-placement="top" title="Block" value="submit" type="submit" form="ws_block_form"><i class="ti-hand-stop"></i></button>
                                    </td>
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                     </div>
                </div>
            </div>

        </div>
    </div>

    </div>
@include('partials.footer')
@endsection