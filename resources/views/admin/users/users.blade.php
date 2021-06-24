@extends('admin.layouts.admin-layout')

@section('content')

    @if(!is_null($users))

        <table rules="all" cellpadding="15px" border="solid 1px black">

            <th>ID</th>
            <th>NAME</th>
            <th>E-Mail</th>
            <th>Role</th>
            <th>Photo</th>

            @foreach($users as $user)

                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if(!is_null($user->profile_photo_path))

                            Есть фото

                        @else

                            Нет фото

                        @endif

                    </td>
                </tr>

            @endforeach

        </table>

    @endif

@endsection
