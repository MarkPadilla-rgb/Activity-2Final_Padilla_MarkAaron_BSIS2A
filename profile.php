<?php
    require_once "connect.php";

    if(!isset($_SESSION['user_id']) && !isset($_SESSION['role']) && !isset($_SESSION['username'])){
        header("Location: index.php");
    }


    if($_SESSION['role'] !== 'admin'){
        header("Location: home.php");
    }
    $totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
    $tatalPending = $conn->query("SELECT COUNT(*) AS total FROM users WHERE status = 'pending'")->fetch_assoc()['total'];
    $totalProducts = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Banana Len</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a class="site-brand" href="home.php"><span class="brand-mark" aria-hidden="true">🍌</span> Banana Len</a>
            <nav class="nav" aria-label="Main navigation">
                <a href="home.php">Home</a>
                <a href="storage.php">Storage</a>
                <a href="profile.php" aria-current="page">Profile</a>
                <a href="logout.php">Log out</a>
            </nav>
        </div>
    </header>
    <main class="page-content">
        <section class="page-card">
            <p class="eyebrow">Your account</p>
            <h1>Profile</h1>
            <h3>Account overview</h3>
            <div class="table-wrap">
            <table class="data-table stats-table">
                <thead>
                    <tr>
                        <th>Total Users</th>
                        <th>Total Pending</th>
                        <th>Total Products</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $totalUsers; ?></td>
                        <td><?php echo $tatalPending; ?></td>
                        <td><?php echo $totalProducts; ?></td>
                    </tr>
                </tbody>
            </table>
            </div>
            <h3>Manage users</h3>
            <div class="table-wrap">
            <table class="data-table users-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $fetchquery = "SELECT * FROM users";

                        $fetch = mysqli_query($conn, $fetchquery);
                        
                        if(mysqli_num_rows($fetch) > 0){
                            while($users = mysqli_fetch_assoc($fetch)){
                                ?>
                                <tr>
                                    <td><?php echo $users['username']; ?></td>
                                    <td><?php echo $users['status']; ?></td>
                                    <td><?php echo $users['role']; ?></td>
                                    <td><?php echo $users['created_at']; ?></td>
                                    <td>
                                        <?php if($users['status'] === 'pending'): ?>
                                                <button class="table-button" type="button" onclick="window.location.href='aprove.php?userid=<?php echo rawurlencode((string) $users['ID']); ?>'">Approve</button>
                                        <?php elseif($users['status'] === 'approved'): ?>
                                                <button class="table-button danger" type="button" onclick="window.location.href='disable.php?userid=<?php echo rawurlencode((string) $users['ID']); ?>'">Disable</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        
                        else{
                            ?>
                            <tr>
                                <td colspan="5">No users found.</td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>    
            </table>
            </div>
        </section>
    </main>
</body>
</html>