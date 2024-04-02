@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white rounded p-6">
            <div class="text-center my-10">
                <div class="max-w-md mb-10">
                    <h2 class="text-4xl text-black mb-8">meet♥mate</h2>
                    <p>～ たくさんの出会いを記録し、親しい友人に共有できるアプリ ～</p>
                    {{-- ユーザ登録ページへのリンク --}}
                    <a class="btn btn-lg normal-case mt-4" href="{{ route('register') }}" style=" background-color: #FF6699; color: white; font-size: 1.2rem;">サインイン！</a>
                </div>
            </div>
        </div>
    </div>
@endsection