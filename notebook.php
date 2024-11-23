<?php 
session_start(); 
include('includes/session.php');
include('includes/config.php');

date_default_timezone_set("Asia/Kolkata");

// Handle delete
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $sql = "DELETE FROM notes WHERE note_id = ".$delete;
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Note removed Successfully');</script>";
        echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
    }
}

// Handle form submission
if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $note = mysqli_real_escape_string($conn, $_POST['note']);
    $time_now = date("Y-m-d H:i:s");

    $query = "INSERT INTO notes(user_id, title, note, time_in) VALUES('$session_id', '$title', '$note', '$time_now')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Note Added Successfully');</script>";
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

// Fetch notes
$query = "SELECT note_id, title, note, time_in FROM notes WHERE user_id = \"$session_id\" ";
$notesArray = [];
if (mysqli_query($conn, $query)) {
    $result = mysqli_query($conn, $query);
    $notesArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo 'Query error: ' . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notebook | Web Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #333333;
            color: white;
            padding: 30px 20px;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        header h1 {
            margin: 0;
            font-size: 1.5em;
        }
        
        header .btn {
            margin-left: auto;
        }
        
        .container {
            width: 90%;
            margin: 20px auto;
            padding: 10px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        
        h2 {
            text-align: center;
        }
        
        label {
            font-weight: bold;
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }
        
        form {
            margin-bottom: 20px;
        }
        
        input, textarea {
            width: 98%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
        }
        
        .btn {
            display: inline-block;
            padding: 10px;
            background-color: #333;
            color: white;
            text-align: right;
            text-decoration: none;
            cursor: pointer;
        }
        
        .note {
            padding: 15px;
            background-color: #eaeaea;
            margin-bottom: 10px;
        }
        
        .note-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .note-content {
            margin: 10px 0;
            line-height: 1.5;
        }

        .note-time {
            font-size: 12px;
            margin-bottom: 10px;
            color: #555;        
        }

        .note-actions {
            text-align: right;
        }
    </style>
</head>
<body>

<header>
    <h1>✍️ Notebook</h1>
    <a href="index.php" class="btn">Logout</a>
</header>

<div class="container">
    <h2>Add Note</h2>
    <form method="POST">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Note title" required>

        <label for="note">Note</label>
        <textarea id="note" name="note" rows="4" placeholder="Write your note..." required></textarea>

        <button type="submit" name="submit" class="btn">Add Note</button>
    </form>

    <h2>Your Notes</h2>
    <?php foreach ($notesArray as $note): ?>
        <div class="note">
            <div class="note-title"><?php echo htmlspecialchars($note['title']); ?></div>
            <div class="note-content"><?php echo nl2br(htmlspecialchars($note['note'])); ?></div>
            <div class="note-time"><?php echo date("d M Y, h:i A", strtotime($note['time_in'])); ?></div>
            <div class="note-actions">
                <a href="edit_note.php?edit=<?php echo $note['note_id']; ?>" class="btn">Edit</a>
                <a href="notebook.php?delete=<?php echo $note['note_id']; ?>" class="btn">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
