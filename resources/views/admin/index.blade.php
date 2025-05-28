<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
<style>
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* Navigation Bar - matching your main site */
        .nav {
            background-color: #3a4a5c;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            margin-right: 20px;
            transition: color 0.3s ease;
        }

        .nav a:hover {
            color: #ccc;
        }

        .nav button {
            background: none !important;
            border: none !important;
            color: white !important;
            cursor: pointer !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav button:hover {
            color: #ccc !important;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Header */
        .header {
            margin-bottom: 40px;
        }

        .header h1 {
            color: #3a4a5c;
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .header p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        /* Stats Grid */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        /* Stat Cards - matching your main site card style */
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .stat-card h3 {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card.blue h3 {
            color: #0066cc;
        }

        .stat-card.green h3 {
            color: #28a745;
        }

        .stat-number {
            color: #3a4a5c;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Buttons - matching your main site style */
        .btn {
            display: inline-block;
            background-color: #6c757d;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin-right: 15px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #5a6268;
            transform: translateY(-1px);
        }

        .btn.green {
            background-color: #28a745;
        }

        .btn.green:hover {
            background-color: #218838;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .nav a {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .btn {
                display: block;
                text-align: center;
                margin-right: 0;
                margin-bottom: 15px;
            }
        }

        /* Add some visual hierarchy */
        .stat-card.blue {
            border-left: 4px solid #0066cc;
        }

        .stat-card.green {
            border-left: 4px solid #28a745;
        }
</style>    
</head>
<body>
    <div class="nav">
        <a href="{{ route('admin.index') }}">← Back to Dashboard</a>
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
            <a href="{{ route('admin.users.index') }}" class="btn">Manage Users</a>
            <a href="{{ route('admin.users.create') }}" class="btn green">Create New User</a>
            <a href="{{ route('admin.news.index') }}" class="text-blue-600 underline">Beheer Nieuws</a>
            <a href="{{ route('admin.faq.categories') }}" class="text-blue-600 underline">Beheer FAQ's</a>
        </div>
    </div>
</body>
</html>