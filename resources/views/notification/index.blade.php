@extends('layouts.master')
@section('title', 'Notifications')
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
                                    <h4 class="title"><i class="ti-bell"></i> Notifications</h4>
                                    <p class="category">List of all Notifications.</p>
                                </div>
                            </div>
                        </div>
                        <div class="content table-responsive tbl-contained">
                            <div id="jsTable_wrapper" class="dataTables_wrapper">
                                <table class="table dataTable" id="jsTable" role="grid" aria-describedby="jsTable_info">
                                    <thead>
                                        <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1">Notifications</th>
                                    </thead>
                                    <tbody>
                                    @if(Auth::guard('admin')->check() && count(Auth::guard('admin')->user()->notifications))
                                        @foreach(Auth::guard('admin')->user()->notifications as $key => $notification)
                                        <tr role="row" 
                                        @if(is_null($notification->read_at))
                                            class="success"
                                        @endif
                                         >
                                            <td>
                                                <a  class="notification_lnks" href="{{$notification->data['notification_url']}}" notif-id="{{$notification->id}}" >
                                                    <div>
                                                        @if(snake_case(class_basename($notification->type )) == 'new_workshop')
                                                            <img class="notification_image pull-left" src="{{URL::to('/img/workshop-icon.png')}}">
                                                        @else
                                                            <img class="notification_image pull-left" src="{{URL::to('/img/Dummy-image.jpg')}}">
                                                        @endif
                                                        <p class="notification_text notification_msg">
                                                            {{$notification -> data['msg']}}
                                                            <br>
                                                            <span class="text-left notification_date">
                                                                 {{$notification->created_at->format('d-m-Y h:i')}}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @elseif(Auth::guard('workshop')->check() && count(Auth::guard('workshop')->user()->notifications))
                                        @foreach(Auth::guard('workshop')->user()->notifications as $key => $notification)
                                        <tr role="row" 
                                         @if(is_null($notification->read_at))
                                            class="success"
                                        @endif
                                        >
                                            <td>
                                                <a  class="notification_lnks" href="{{$notification->data['notification_url']}}" notif-id="{{$notification->id}}" >
                                                    <div>
                                                        @if(snake_case(class_basename($notification->type )) == 'new_workshop')
                                                            <img class="notification_image pull-left" src="{{URL::to('/img/workshop-icon.png')}}">
                                                        @else
                                                            <img class="notification_image pull-left" src="{{URL::to('/img/Dummy-image.jpg')}}">
                                                        @endif
                                                        <p class="notification_text notification_msg">
                                                            {{$notification -> data['msg']}}
                                                            <br>
                                                            <span class="text-left notification_date">
                                                                 {{$notification->created_at->format('d-m-Y h:i')}}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
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