<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="nav">
        <a href="{{ route('dashboard') }}">← Back to Dashboard</a>
        <a href="{{ route('profile.edit') }}">Profile</a>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: #007bff; cursor: pointer;">Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="header">
            <h1>Admin Dashboard</h1>
            <p>Welcome to the administration panel</p>
        </div>

        <div class="stats">
            <div class="stat-card blue">
                <h3>Total Users</h3>
                <div class="stat-number">{{ $users->count() }}</div>
            </div>
            <div class="stat-card green">
                <h3>Admin Users</h3>
                <div class="stat-number">{{ $users->where('is_admin', true)->count() }}</div>
            </div>
        </div>

        <div>
            <a href="{{ route('admin.users') }}" class="btn">Manage Users</a>
            <a href="{{ route('admin.users.create') }}" class="btn green">Create New User</a>
        </div>
    </div>
</body>
</html>