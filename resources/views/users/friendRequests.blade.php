@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
        </aside>
        <div class="sm:col-span-2 mt-4">
            <div class="mt-4">
                {{-- ユーザ一覧 --}}
                @include('users.users')
            </div>

            {{-- 自分へ友達申請しているのユーザーがいない場合のメッセージ --}}
            @if($users->isEmpty())
                <p>友達申請はきていません。</p>
            @endif
        </div>
    </div>
@endsection
