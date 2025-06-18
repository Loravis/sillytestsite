<?php
// config.php - Database and admin credentials
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'password123'); // In production, use hashed passwords
define('SESSION_NAME', 'admin_session');

session_start();

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION[SESSION_NAME]) && $_SESSION[SESSION_NAME] === true;
}

// Login function
function login($username, $password) {
    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION[SESSION_NAME] = true;
        $_SESSION['admin_username'] = $username;
        return true;
    }
    return false;
}

// Logout function
function logout() {
    session_destroy();
    header('Location: test.php');
    exit;
}

// Handle login form submission
$error = '';
if ($_POST && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (login($username, $password)) {
        header('Location: test.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}

// Handle logout
if ($_GET && isset($_GET['logout'])) {
    logout();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isLoggedIn() ? 'Admin Dashboard' : 'Admin Login'; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        
        .dashboard {
            max-width: 800px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .header {
            background: #4a5568;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .content {
            padding: 2rem;
        }
        
        h1, h2 {
            margin-bottom: 1rem;
            color: #2d3748;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #4a5568;
        }
        
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn {
            background: #667eea;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #5a67d8;
        }
        
        .btn-logout {
            background: #e53e3e;
        }
        
        .btn-logout:hover {
            background: #c53030;
        }
        
        .error {
            background: #fed7d7;
            color: #c53030;
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            border: 1px solid #feb2b2;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: #f7fafc;
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }
        
        .stat-label {
            color: #718096;
            font-size: 0.9rem;
        }
        
        .menu {
            list-style: none;
        }
        
        .menu li {
            margin-bottom: 0.5rem;
        }
        
        .menu a {
            color: #4a5568;
            text-decoration: none;
            padding: 0.5rem;
            display: block;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        .menu a:hover {
            background: #e2e8f0;
        }
    </style>
</head>
<body>
    <?php if (!isLoggedIn()): ?>
        <!-- Login Form -->
        <div class="container">
            <h1>Admin Login</h1>
            
            <?php if ($error): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" name="login" class="btn">Login</button>
            </form>
            
            <p style="margin-top: 1rem; color: #718096; font-size: 0.9rem;">
                Demo credentials: admin / password123
            </p>
        </div>
        
    <?php else: ?>
        <!-- Admin Dashboard -->
        <div class="dashboard">
            <div class="header">
                <h1>Admin Dashboard</h1>
                <div>
                    Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!
                    <a href="?logout=1" class="btn btn-logout" style="margin-left: 1rem;">Logout</a>
                </div>
            </div>
            
            <div class="content">
                <!-- Statistics -->
                <div class="stats">
                    <div class="stat-card">
                        <div class="stat-number">150</div>
                        <div class="stat-label">Total Users</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">25</div>
                        <div class="stat-label">New Orders</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">$12,540</div>
                        <div class="stat-label">Revenue</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Uptime</div>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <h2>Admin Menu</h2>
                <ul class="menu">
                    <li><a href="#users">Manage Users</a></li>
                    <li><a href="#products">Manage Products</a></li>
                    <li><a href="#orders">View Orders</a></li>
                    <li><a href="#settings">System Settings</a></li>
                    <li><a href="#reports">Generate Reports</a></li>
                </ul>
                
                <!-- Quick Actions -->
                <h2>Quick Actions</h2>
                <p>This is your admin dashboard. You can add more functionality here such as:</p>
                <ul style="margin: 1rem 0; padding-left: 2rem;">
                    <li>User management forms</li>
                    <li>Content management system</li>
                    <li>File upload functionality</li>
                    <li>Database operations</li>
                    <li>System monitoring tools</li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>