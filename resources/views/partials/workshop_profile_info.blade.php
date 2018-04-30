<div class="profile-info">
    <img src="{{$workshop->profile_pic}}" class="img-shadow" width="200px" height="150px" onclick="imagezoom(this)">
    <div class="name-info">
        <h4 class="title">Workshop Name : {{$workshop->name}}</h4>
        <h5 class="title">Owner Name : {{$workshop->owner_name}}</h5>
        @if(!is_null($workshop->address))
            <div class="address">
                {{ workshopAddressGenerator($workshop->address) }}
            </div>
        @endif
        <div class="phone">Mobile : {{$workshop->mobile}}</div>
        @if(!is_null($workshop->balance))
            <div class="phone">Current Balance : {{$workshop->balance->balance}} PKR</div>
        @endif
        @if(!is_null($workshop->workshopId))
            <div>Workshop ID : {{$workshop->workshopId}}</div>
        @endif
        <div>Rating : {{$workshop->rating}} <i class="ti-star"></i></div>
        @php
            $url = explode('/',url()->current() );
        @endphp
        @if(Auth::guard('workshop')->check())
            @if($url [3] == "profile")
                <div>
                    <a href="{{url('profile/'.$workshop->id.'/edit')}}" class=" btn btn-header btn-export">Edit
                        Workshop
                    </a>
                </div>
            @endif
            @if( $url[3] == "leads")
                <div>Total Earnings : {{$total_earning}} PKR</div>
            @endif
        @endif

        @if(Auth::guard('admin')->check())
            @if(sizeof($url) > 6)
                @if($url[6] == "history")
                    <div>Total Earnings : {{$total_earning}} PKR</div>
                @endif
            @endif
        @endif
    </div>
</div>