@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="row justify-content-center pt-5 pl-5">


            <div id="chat-template" class="item" style="display: none; opacity: 0;">
                {{--                <div class="d-flex align-items-center ">--}}
                {{--                    <div class="sender-image left" style="display: none;">--}}
                {{--                        <img src="" style="max-width: 40px" class="rounded-circle">--}}
                {{--                    </div>--}}
                {{--                    <div class="sender-username"></div>--}}
                {{--                    <div class="sender-image right" style="display: none;">--}}
                {{--                        <img src="" style="max-width: 40px" class="rounded-circle">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="sender-message"></div>--}}

                <div class="img" style="display: none;">
                    <img src="" style="max-width: 40px" class="rounded-circle">
                </div>
                <div class="message">

                </div>
            </div>


            <div id="follower-template" class="d-flex align-items-center pb-2" style="display: none;">

                <div class="follower-image">
                    <img src="" style="max-width: 40px" class="rounded-circle">
                    <span class="follower-username">
                    </span>

                </div>

            </div>


            <li id="comment-template" style="display: none; opacity: 0;">
                <div class="d-flex align-items-baseline ">
                    <div class="img-holder">
                        {{--                    {{$comment->user->profile->profileImage()}}--}}
                        <img src="" class="rounded-circle  "
                             height="40px" width="40"/>
                    </div>
                    <div class="pl-3">
                    <span class="name font-weight-bolder">
{{--                        {{$comment->user->username}}--}}
                    </span>
                    </div>
                    <div class="pl-3">
                        <p class="comment">
                            {{--                        {{$comment->comment}}--}}
                        </p>
                    </div>
                    <div>
                        <button type="button" class=" btn btn-link  btn-del box-icon" comment_id="">
                            {{--                        <span class="box-label">Delete</span>--}}
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                </div>

            </li>


            <div class="col-6">
                @foreach( $posts  as  $post)
                    <div class="post-holder">
                        <div class="nav row align-items-center">
                            <div class="col">
                                <img src="{{$post->user->profile->profileImage()}}" class="w-50 rounded-circle">
                                <div class="title font-weight-bolder">{{$post->user->username}}</div>
                            </div>
                            <div class="date col text-right">
                                {{$post->created_at}}
                            </div>
                        </div>

                        <div class="img-holder ">
                            <a href="{{route('profile.show',$post->user->id)}}">
                                <img src="/storage/{{$post->image}}" class="w-50">
                            </a>
                        </div>
                        <hr>
                        <div class="comments-holder " style="overflow-y: scroll; max-height: 400px">

                            <ul class="commentList" data-id="{{$post->id}}" style="list-style-type:none;"></ul>

                        </div>

                        <div class="form-holder">
                            <form class="form-inline comment-form">
                                @csrf
                                <div class="form-group">
                                    <input id="comment" name="comment" class="form-control" type="text"
                                           placeholder="Your comments"/>
                                </div>
                                <input name="post_id" type="hidden" value="{{$post->id}}"/>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Add</button>
                                </div>
                            </form>
                        </div>

                    </div>




                @endforeach
            </div>

            <div class=" col-6 ">

                <div class="followers-holder ">
                    <nav id="navbar-example2" class="navbar navbar-light bg-light">
                        <a class="navbar-brand" href="#">
                            <div class="col d-flex align-items-center">
                                <img src="{{Auth::user()->profile->profileImage()}}" style="max-width: 60px;"
                                     class="w-25 rounded-circle pt-3 pl-3">
                                <div class="title font-weight-bolder pl-3">{{Auth::user()->username}}</div>
                            </div>
                        </a>
                    </nav>
                    <hr>
                    <div class="">
                        <ul style="list-style-type:none; overflow-y: scroll; max-height: 400px">
                            @foreach(Auth::user()->following as $follow)
                                <div class="d-flex">
                                    <div>
                                        <li class="followerList" user-id="{{$follow->user_id}}"></li>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-link btn-chat"
                                                user-id="{{$follow->user_id}}">
                                            <i class='bx bxl-messenger btnChat'
                                               style='color:#08b1f3; font-size: 30px'></i>
                                        </button>
                                    </div>
                                </div>

                            @endforeach
                        </ul>
                    </div>
                    <hr>
                    <div>
                        <div class="footer ">
                            <ul class="nav justify-content-center align-items-center" id="chatnav">
                                <li class="nav-item">
                                    User Image
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Username</a>
                                </li>

                            </ul>
                        </div>

                        <div class="messageList">


                        </div>


                        <div class="messageform-holder" style=" position: absolute;bottom: 0;">
                            <form class="form-inline message-form justify-content-center ">
                                @csrf
                                <div class="form-group">
                                    <input id="message" name="message" class="form-control" type="text"
                                           placeholder="Message..." style="height: 60px; width: 350px;"/>
                                </div>
                                <input class="userholder" name="to_user_id" type="hidden" value="">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-link"><i class='bx bxs-send'
                                                                                  style='color:#08b1f3; font-size: 30px;'></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>


                </div>

            </div>


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

            var $template = $("#comment-template");
            // load comment

            $.each($('.commentList'), function (i, item) {
                var $ul = $(this);

                $.ajax({

                    type: "POST",
                    url: "{{route("get.comments")}}",
                    data: {
                        id: $ul.attr('data-id')
                    },
                    beforeSend: function () {

                    },
                    success: function (response) {
                        //console.log(response);

                        $.each(response.comments, function (i, item) {
                            //console.log(item);
                            var $cloned = $template.clone().removeAttr("style").removeAttr("id");
                            $cloned.find('.img-holder img').attr('src', '/storage/' + item.image);
                            $cloned.find('.name').text(item.username);
                            $cloned.find('.comment').text(item.comment);
                            $cloned.find('.btn-del').attr('comment_id', item.id);

                            $ul.append($cloned);
                        });

                        // toastr.success(response.message, 'Miracle Max Says')
                        deleteButton();
                    },
                    error: function (response) {

                    },
                    completed: function () {

                    },
                    dataType: "json"
                });


            });

            function deleteButton() {
                $('.btn-del').click(function () {
                    var button = $(this);

                    $.ajax({
                        type: "POST",
                        url: "{{route("post.comment.delete")}}",
                        data: {
                            commentid: $(this).attr('comment_id')
                        },
                        beforeSend: function () {
                            button.attr("disabled", 'disabled');
                            button.html('Loading..');
                        },
                        success: function (response) {
                            //console.log(response);
                            button.parent().parent().parent().slideUp(500, function () {
                                $(this).remove();
                            });
                        },
                        error: function (response) {

                        },
                        completed: function () {
                            button.removeAttr("disabled");
                            button.text('Delete');
                        },
                        dataType: "json"
                    });
                });
            }


            $('.comment-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{route("posts.comment.show")}}",
                    data: $(this).serialize(),
                    beforeSend: function () {

                    },
                    success: function (response) {
                        //console.log(response);
                        var $ul = $(".commentList[data-id=" + response.new_comment.post_id + "]");
                        var $cloned = $template.clone().removeAttr("id");
                        $cloned.find('.img-holder img').attr('src', '/storage/' + response.new_comment.image);
                        $cloned.find('.name').text(response.new_comment.username);
                        $cloned.find('.comment').text(response.new_comment.comment);


                        $ul.append($cloned);
                        $ul.find('li').last().slideDown(500);
                        $ul.find('li').last().animate({
                            opacity: 1
                        }, 500);
                        toastr.success('Successfully added new comment');
                    },
                    error: function (response) {

                    },
                    completed: function () {

                    },
                    dataType: "json"
                });
            });


            var $followertemp = $("#follower-template");
            // load followers

            $.each($('.followerList'), function (i, item) {
                var $li = $(this);

                $.ajax({

                    type: "POST",
                    url: "{{route("get.followers")}}",
                    data: {
                        userID: $li.attr('user-id')
                    },
                    beforeSend: function () {

                    },
                    success: function (response) {
                        //  console.log(response);


                        $.each(response.follower, function (i, item) {
                            // console.log(item);
                            var $clone = $followertemp.clone().removeAttr("style").removeAttr("id");

                            $clone.find('.follower-username').text(item.username);
                            $clone.find('.follower-image img').attr('src', '/storage/' + item.image);


                            $li.append($clone);
                        });


                        // toastr.success(response.message, 'Miracle Max Says')

                    },
                    error: function (response) {

                    },
                    completed: function () {

                    },
                    dataType: "json"
                });


            });

            var $chattemp = $("#chat-template");
            var $msglist = $(".messageList");

            $('.btn-chat').click(function () {
                var button = $(this);
                $('.userholder').attr('value', $(this).attr('user-id'));
                $.ajax({
                    type: "POST",
                    url: "{{route("get.messages")}}",
                    data: {
                        to: $(this).attr('user-id')
                    },
                    beforeSend: function () {

                    },
                    success: function (response) {
                        //console.log(response);
                        $msglist.empty();
                        var logged_user = parseInt("{{Auth::user()->id}}");
                        $.each(response.messages, function (i, item) {
                            console.log(item);
                            var $cloned = $chattemp.clone().removeAttr("style").removeAttr("id");
                            // $cloned.find('.sender-username').text(item.username);
                            $cloned.find('.message').text(item.message);

                            if (logged_user == item.from_user_id) {
                                $cloned.find('.img.right').removeAttr("style");
                                $cloned.addClass('right');
                            } else {
                                $cloned.find('.img img').attr('src', '/storage/' + item.image);
                                $cloned.find('.img').removeAttr("style");
                                $cloned.addClass('left');
                            }

                            last_user = item.from_user_id;
                            //console.log($cloned);
                            $msglist.append($cloned);
                        });

                        setTimeout(function () {
                            updateMessages(button.attr('user-id'));
                        }, 3000);
                    },
                    error: function (response) {

                    },
                    completed: function () {
                        button.removeAttr("disabled");
                    },
                    dataType: "json"
                });
            });


            function updateMessages(to_user_id = null) {
                if (!to_user_id || to_user_id != $('.userholder').val()) {
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "{{route("get.messages")}}",
                    data: {
                        to: to_user_id
                    },
                    success: function (response) {
                        //console.log(response);
                        $msglist.empty();
                        var logged_user = parseInt("{{Auth::user()->id}}");
                        $.each(response.messages, function (i, item) {
                            console.log(item);
                            var $cloned = $chattemp.clone().removeAttr("style").removeAttr("id");
                            // $cloned.find('.sender-username').text(item.username);
                            $cloned.find('.message').text(item.message);

                            if (logged_user == item.from_user_id) {
                                $cloned.find('.img.right').removeAttr("style");
                                $cloned.addClass('right');
                            } else {
                                $cloned.find('.img img').attr('src', '/storage/' + item.image);
                                $cloned.find('.img').removeAttr("style");
                                $cloned.addClass('left');
                            }

                            last_user = item.from_user_id;
                            //console.log($cloned);
                            $msglist.append($cloned);
                        });
                        $msglist.animate({scrollTop: $msglist[0].scrollHeight}, 1000);
                    },
                    error: function (response) {

                    },
                    dataType: "json"
                });

                setTimeout(function () {
                    updateMessages(to_user_id);
                }, 3000);
            }

            $('.message-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{route("message.show")}}",
                    data: $(this).serialize(),
                    beforeSend: function () {

                    },
                    success: function (response) {
                      $('#message').val('');
                        toastr.success('Successfully added new comment');
                    },
                    error: function (response) {

                    },
                    completed: function () {

                    },
                    dataType: "json"
                });
            });


        });
    </script>
@endsection
