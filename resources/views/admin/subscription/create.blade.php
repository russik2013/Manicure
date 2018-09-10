{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: User--}}
 {{--* Date: 31.08.2018--}}
 {{--* Time: 1:10--}}
 {{--*/--}}

<form action="{{route('admin.subscription.store')}}" method="POST">

    {{ csrf_field() }}

    <p><input name="name" placeholder="Name"></p>
    <p><input name="price" type="number" placeholder="Price"></p>
    <p><input name="term" type="number" placeholder="Term"></p>

<input type="submit">

</form>

@include('admin.laws.laswInclude')