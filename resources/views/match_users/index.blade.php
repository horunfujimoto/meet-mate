@extends('layouts.app')

@section('content')
    <div class="mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="title">出会った方の一覧</h2>
            <a href="{{ route('match_users.create') }}" class="btn btn-hover" style="background-color: #FF6699; color: white; font-size: 1.2rem;">出会った方の登録</a>
        </div>
        <div class="row mt-4">
            <table class="table table-bordered ">
                <div class="py-2">
                    <thead style="background-color: #FFCCCC;">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">出会った方</th>
                            <th class="border border-gray-300 px-4 py-2">住んでる場所</th>
                            <th class="border border-gray-300 px-4 py-2">出会い方</th>
                            <th class="border border-gray-300 px-4 py-2">画像</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($match_users as $match_user)
                        <tr onclick="window.location='{{ route('match_users.show', $match_user->id) }}';" style="cursor:pointer;">
                            <td class="border border-gray-300 px-4 py-2">{{ $match_user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $match_user->address }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $match_user->way }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="/images/{{ $match_user->image }}" alt="{{ $match_user->name }}" width="50" height="auto">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </table>
        </div>
    </div>
@endsection