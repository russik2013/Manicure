{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: User--}}
 {{--* Date: 31.08.2018--}}
 {{--* Time: 0:50--}}
 {{--*/--}}

<p>{{$subscription->name}}</p>
<p>{{$subscription->price}}</p>
<p>{{$subscription->term}}</p>

@if($subscription->laws)
Laws:
@foreach($subscription->laws as $law)
    <p>{{$law->lawInfo->name}}</p>
    @endforeach
@endif