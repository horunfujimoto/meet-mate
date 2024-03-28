@extends('layouts.app')

@section('content')
    <div class="prose ml-4 mt-8">
        <h2>出会った方の一覧</h2>
    </div>

    <div class="flex justify-center">
        <table class="w-1/2 border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">名前</th>
                    <th class="border border-gray-300 px-4 py-2">住んでる場所</th>
                    <th class="border border-gray-300 px-4 py-2">職業</th>
                    <th class="border border-gray-300 px-4 py-2">誕生日</th>
                    <th class="border border-gray-300 px-4 py-2">SNS</th>
                    <th class="border border-gray-300 px-4 py-2">出会い方</th>
                    <th class="border border-gray-300 px-4 py-2">その他</th>
                    <th class="border border-gray-300 px-4 py-2">画像</th>
                </tr>
            </thead>
            <tbody>
                @foreach($match_users as $match_user)
                <tr onclick="window.location='{{ route('match_users.show', $match_user->id) }}';" style="cursor:pointer;">
                    <td class="border border-gray-300 px-4 py-2">{{ $match_user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $match_user->address }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $match_user->work }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $match_user->birthday }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $match_user->sns }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $match_user->way }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $match_user->others }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <img src="{{ $match_user->image }}" alt="{{ $match_user->name }}" width="100">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


