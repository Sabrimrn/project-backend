<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
</head>
<body>
    <div class="nav">
        <a href="{{ route('admin.users') }}">← Back to User Management</a>
        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
    </div>

    <div class="container">
        <h1>Create New User</h1>

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @if($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="checkbox-group">
                <input id="is_admin" type="checkbox" name="is_admin">
                <label for="is_admin">Make this user an admin</label>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.users') }}" class="btn gray">Cancel</a>
                <button type="submit" class="btn">Create User</button>
            </div>
        </form>
    </div>
</body>
</html>