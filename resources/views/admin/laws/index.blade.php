{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: User--}}
 {{--* Date: 30.08.2018--}}
 {{--* Time: 22:45--}}
 {{--*/--}}


@foreach($laws as $law)
    <p><a href="{{route('admin.laws.single', ['id' => $law->id])}}">{{$law->name}}</a></p>
@endforeach