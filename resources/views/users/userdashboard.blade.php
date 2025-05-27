<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <div class="nav">
        <a href="{{ route('admin.dashboard') }}">← Back to Admin Dashboard</a>
        <a href="{{ route('dashboard') }}">Main Dashboard</a>
    </div>

    <div class="container">
        <div class="header">
            <h1>User Management</h1>
            <a href="{{ route('admin.create') }}" class="btn green">Create New User</a>
        </div>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->isAdmin() ? 'admin' : 'user' }}">
                                {{ $user->isAdmin() ? 'Admin' : 'User' }}
                            </span>
                        </td>
                        <td>
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn small">
                                        {{ $user->isAdmin() ? 'Remove Admin' : 'Make Admin' }}
                                    </button>
                                </form>
                            @else
                                <span style="color: #6c757d; font-size: 12px;">Current User</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
 