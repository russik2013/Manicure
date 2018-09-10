{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: User--}}
 {{--* Date: 31.08.2018--}}
 {{--* Time: 2:05--}}
 {{--*/--}}
<button id="addLaws">Add Laws</button>

<script src="{{asset('js/jquery.js')}}"></script>
<script>
    $(function() {
        var settingsNumber = '{{$subscription->laws ? $subscription->laws->count() : 0}}';
        $("#addLaws").click( function()
            {
                $.ajax({
                    url: "{{route('admin.laws.all.post')}}",
                    type: "POST",
                    data: {// change data to this object
                        _token : "{{csrf_token()}}",
                    },
                    success: function(date){
                        if('{{$lawsCount->count()}}' != settingsNumber){
                            selector = "<br/><br/><select name='laws["+settingsNumber+"]'>";
                            for(j = 0; j < date.length; j++){
                                selector+= "<option value='"+date[j].id+"'>"+date[j].name+"</option>";
                            }
                            selector+= "</select>";
                            $('form').append( selector);

                            settingsNumber++;
                        }
                    }
                });
            }
        );
    });
</script>