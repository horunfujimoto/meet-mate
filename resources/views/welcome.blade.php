@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white rounded p-6">
            <div class="text-center my-10">
                <div class="max-w-md mb-10">
                    <h2 class="text-4xl text-black mb-8">Welcome to the meet♥mate</h2>
                    {{-- ユーザ登録ページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case mt-4" href="{{ route('register') }}" style="margin-bottom: 20px;">サインイン！</a>
                </div>
            </div>
        </div>
    </div>
@endsection