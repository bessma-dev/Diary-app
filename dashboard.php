<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

include "includes/db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>
<body>

<div class="container">

    <div class="box">
        <h2>Welcome <?php echo $_SESSION['username']; ?> 👋</h2>
        <a href="logout.php">Logout</a>
    </div>
    <div class="box">
        <h2>Diary 📝</h2>

        <form method="POST" action="add_diary.php">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Write..." required></textarea>
            <button>Add</button>
        </form>

        <hr>

        <?php
        $uid = $_SESSION['user_id'];

        $res = $conn->query("SELECT * FROM diary WHERE user_id='$uid' ORDER BY id DESC");

        while ($row = $res->fetch_assoc()) {
            echo "
            <div class='item'>
                <h3>{$row['title']}</h3>
                <p>{$row['content']}</p>
                <a href='delete_diary.php?id={$row['id']}' onclick='return confirmDelete()'>Delete</a>
            </div>";
        }
        ?>
    </div>

    <div class="box">
        <h2>Tasks ✅</h2>

        <form method="POST" action="add_task.php">
            <input type="text" name="task" placeholder="New task" required>
            <button>Add</button>
        </form>

        <hr>

        <?php
        $res = $conn->query("SELECT * FROM todoliste WHERE user_id='$uid' ORDER BY id DESC");

        while ($row = $res->fetch_assoc()) {
            echo "
            <div class='item'>
                <p>{$row['task']}</p>
                <a href='delete_task.php?id={$row['id']}' onclick='return confirmDelete()'>Delete</a>
            </div>";
        }
        ?>
    </div>

</div>

</body>
</html>