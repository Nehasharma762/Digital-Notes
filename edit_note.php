<?php include('includes/session.php')?>
<?php include('includes/config.php')?>
<?php $get_id = $_GET['edit']; ?>
<?php

// ********************Updation********************
if (isset($_POST['update'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $note = mysqli_real_escape_string($conn, $_POST['note']);

    $query = "UPDATE notes SET title=\"$title\", note=\"$note\", last_updated_at=CURRENT_TIMESTAMP WHERE note_id = \"$get_id\" ";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Note Updated Successfully');</script>";
        echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
    } else {
        echo 'query error: ' . mysqli_error($conn);
    }
}

// ********************Selection********************
$query = "SELECT note_id, title, note, time_in FROM notes WHERE note_id = \"$get_id\" ";

if (mysqli_query($conn, $query)) {
    // get the query result
    $result = mysqli_query($conn, $query);
    // fetch result in array format
    $notesArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo 'query error: ' . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Notebook | Web Application</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #333;
      color: white;
      padding: 10px;
      text-align: center;
    }
    .container {
      width: 90%;
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
    }
    form {
      margin-bottom: 20px;
    }
    input, textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
    }
    .btn {
      padding: 10px 15px;
      background-color: #333;
      color: white;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
    }
    .note {
      background-color: #eaeaea;
      padding: 15px;
      margin-bottom: 20px;
    }
    .note-title {
      font-weight: bold;
    }
    .note-content {
      margin-top: 10px;
    }
    .note-actions {
      text-align: right;
    }
  </style>
</head>
<body>

<header>
  <h1>Notebook</h1>
</header>

<div class="container">
  <h2>Edit Note</h2>
  <form method="POST">
    <?php
    $query = mysqli_query($conn, "SELECT * FROM notes WHERE note_id = '$get_id' ") or die(mysqli_error($conn));
    $row = mysqli_fetch_array($query);
    ?>
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>

    <label for="note">Note</label>
    <textarea id="note" name="note" rows="8" required><?php echo htmlspecialchars($row['note']); ?></textarea>

    <button type="submit" name="update" class="btn">Update Note</button>
  </form>

  <h2>Note Details</h2>
  <?php foreach ($notesArray as $note) { ?>
    <div class="note">
      <div class="note-title"><?php echo htmlspecialchars($note['title']); ?></div>
      <div class="note-content"><?php echo htmlspecialchars($note['note']); ?></div>
      <div class="note-actions">
        <small>Last updated: <?php echo $note['time_in']; ?></small>
      </div>
    </div>
  <?php 
} ?>
</div>
</body>
</html>
