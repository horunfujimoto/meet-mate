@extends('layouts.app')

@section('content')
    <div class="flex justify-center h-screen">
        <div class="text-center">
            <div class="max-w-md">
                <h2 class="text-4xl mt-4">meet♥mate</h2>
                <p class="mt-4">～ たくさんの出会いを記録し、親しい友人に共有できるアプリ ～</p>
                {{-- ユーザ登録ページへのリンク --}}
                <a class="btn btn-lg normal-case mt-4" href="{{ route('register') }}" style=" background-color: #FF6699; color: white; font-size: 1.2rem;">サインイン！</a>
            </div>
        </div>
    </div>
@endsection