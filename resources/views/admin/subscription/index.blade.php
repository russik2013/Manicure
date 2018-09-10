{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: User--}}
 {{--* Date: 31.08.2018--}}
 {{--* Time: 0:11--}}
 {{--*/--}}

@foreach($subscriptions as $subscription)
    <p>
        <a href="{{route('admin.subscription.single', ['id' => $subscription->id])}}">
            {{$subscription->name}}
        </a>
        <button onclick="window.location.href='{{route('admin.subscription.edit', ['id' => $subscription->id])}}'">
            Edit
        </button>

        <button onclick="window.location.href='{{route('admin.subscription.delete', ['id' => $subscription->id])}}'">
            Delete
        </button>
    </p>

    @endforeach

<p>
    <a href="{{route('admin.subscription.create')}}">
        Add new
    </a>
</p>