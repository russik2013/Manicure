{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: User--}}
 {{--* Date: 30.08.2018--}}
 {{--* Time: 23:52--}}
 {{--*/--}}


<p>{{$law->name}}</p>
@foreach($law->routes as $key => $heads)

    <p>Root : {{$key}}</p>

        @foreach($heads as $roots)

        <p>{{$roots}}</p>

        @endforeach

@endforeach
