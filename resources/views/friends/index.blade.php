@extends('layouts.app')

@section('content')
<div class="mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="title">ユーザー関連</h2>
    </div>
    <div class="row mt-4">
        <div class="py-2">
            @include('users.nabtabs')
        </div>
        <div class="pt-4">
            @include('users.users')
            {{-- 自分が申請中のユーザーがいない場合のメッセージ --}}
            @if($users->isEmpty())
                <p>まだ友達がいません。ユーザー一覧から友達申請をしてみましょう！</p>
            @endif
        </div>
        
    </div>
</div>
@endsection