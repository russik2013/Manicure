{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: User--}}
 {{--* Date: 31.08.2018--}}
 {{--* Time: 2:04--}}
 {{--*/--}}

<form action="{{route('admin.subscription.update', ['id' => $subscription->id])}}" method="POST">

    {{ csrf_field() }}

    <p><input name="name" placeholder="Name" value="{{$subscription->name}}"></p>
    <p><input name="price" type="number" placeholder="Price" value="{{$subscription->price}}"></p>
    <p><input name="term" type="number" placeholder="Term" value="{{$subscription->term}}"></p>

    @php $i = 0 @endphp

    @foreach($subscription->laws as $law)
        <select name='laws[{{$i}}]'>
            @foreach($lawsCount as $lawsList)
            <option value="{{$lawsList->id}}" @if($lawsList->id == $law->laws_id) selected @endif>
                {{$lawsList->name}}
            </option>
                @endforeach
        </select>
        @php $i++ @endphp
    @endforeach

    <p><input type="submit"></p>

</form>

@include('admin.laws.laswInclude')