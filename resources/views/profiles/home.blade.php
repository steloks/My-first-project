@extends('layouts.app')

@section('content')
    {{--CTRL + SHIFT + C--}}
    {{--SHIFT + ALT + arrows--}}
    <div class="container  ">

        <div class="row">
            <div class="col-3 p-5">
                <img src="{{$user->profile->profileImage()}}" class="w-100">
            </div>
            <div class="col-9 p-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h4 ">{{ $user->username }}</div>
{{--                                           <input type="button" id="ohmale" value="ohmale" class="js-update-folow"  >--}}

                        <div class="pl-4" >
                            <button
                                class="btn btn-primary js-update-folow" data-id="{{$user->id}}">{{Auth::user()->isfollowing($user->id)?'Unfollow':'Follow'}}
                            </button>
                        </div>
                    </div>

                    @can('update',$user->profile)
                        <a href="/p/create">Add New Post</a>
                    @endcan
                </div>
                <div>
                    @can('update',$user->profile)
                        <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
                    @endcan
                </div>
                <div class="d-flex">
                    <div class="pr-3"><strong>{{$user->posts->count()}}</strong> posts</div>
                    <div class="pr-3"><strong>{{$user->profile->followers->count()}}</strong> followrs</div>
                    <div class="pr-3"><strong>{{$user->following->count()}}</strong> following</div>

                </div>
                <div class="pt-4">{{$user->profile->title }} </div>
                <div>{{$user->profile->description}}</div>
                <div><a href="$">{{$user->profile->url ?? 'N/A'}}</a></div>


            </div>
        </div>
        <div class="row">
            @foreach($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{$post->id}}">
                        <img src="/storage/{{$post->image}}" class="w-100">
                    </a>
                </div>
            @endforeach
        </div>


    </div>
@endsection
@section('extrajs')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.js-update-folow').click(function () {

                $.ajax({
                    type: "POST",
                    url: "{{route("toggle")}}",
                    data: {
                        ass: $(this).attr('data-id')
                    },
                    beforeSend: function () {

                    },
                    success: function (response) {
                        console.log(response);
                        if(response.message == 'Follow successful'){
                            $('.js-update-folow').text('Unfollow');
                        }else{
                            $('.js-update-folow').text('Follow');
                        }
                        toastr.success(response.message, 'Miracle Max Says')

                    },
                    error: function (response) {

                    },
                    completed: function () {

                    },
                    dataType: "json"
                });

            });


        })
    </script>
@endsection
