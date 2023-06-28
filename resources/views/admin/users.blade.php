@extends('layouts.master')

@section('content')

<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming you have already set up your database connection in Laravel

            $users = DB::table('users')->select('id', 'name', 'email', 'role_as')->get();

            foreach ($users as $user) {
                echo '<tr>';
                echo '<td>' . $user->id . '</td>';
                echo '<td>' . $user->name . '</td>';
                echo '<td>' . $user->email . '</td>';
                echo '<td>' . ($user->role_as == 1 ? 'Admin' : 'User') . '</td>';
                echo '<td><img src="' . fetchImage($user->id) . '" alt="User Image" width="100"></td>';
                echo '</tr>';
            }

            function fetchImage($userId)
            {
                $url = 'https://reqres.in/api/users?fbclid=IwAR12Wd3sMaCXoCDUuugkkFFC04qVHXIHXk13uunj07ZffYqpqwNsrRLweXU';
                $data = file_get_contents($url);
                $jsonData = json_decode($data, true);
                $users = $jsonData['data'];

                foreach ($users as $user) {
                    if ($user['id'] == $userId) {
                        return $user['avatar'];
                    }
                }

                return '';
            }
            ?>
        </tbody>
    </table>
</div>

@endsection

