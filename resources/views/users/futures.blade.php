@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }} ({{ $user->hometeam }},{{ $user->codingteam }})</h3>
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->name, 500) }}" alt="">
                </div>
            </div>
            @include('user_friend.friend_button', ['user' => $user])
            @include('user_friend.zuttomo_button', ['user' => $user])
        </aside>
        <div class="col-xs-10">
            <ul class="nav nav-tabs nav-justified">
                <!--<li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">メモ一覧 <span class="badge">{{ $count_memos }}</span></a></li>-->
                <li role="presentation" class="{{ Request::is('users/*/friends') ? 'active' : '' }}"><a href="{{ route('users.friends', ['id' => $user->id]) }}">友達になりたい人たち<span class="badge">{{ $count_friends }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/futures') ? 'active' : '' }}"><a href="{{ route('users.futures', ['id' => $user->id]) }}">ズッ友になるかも<span class="badge">{{ $count_futures }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/zuttomoings') ? 'active' : '' }}"><a href="{{ route('users.zuttomoings', ['id' => $user->id]) }}">ズッ友たち<span class="badge">{{ $count_zuttomoings }}</span></a></li>
            </ul>
            @include('users.users', ['users' => $users])
            @include('users.users', ['users' => $user2])
            
            <!--{{ $user->futures2 }}-->
        </div>
    </div>
@endsection