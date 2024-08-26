<?php
// Database connection
$con = new mysqli('localhost', 'root', '', 'php-ajax');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Initialize error variable
$error = '';

if (isset($_POST['submit'])) {
    $textbox = trim($_POST['textbox']);

    if (empty($textbox)) {
        $error = "Please Enter A ToDo Title";
    } else {
        // Prepare and bind statement
        $stmt = $con->prepare("INSERT INTO todo_list (title) VALUES (?)");
        $stmt->bind_param("s", $textbox);

        // Execute statement
        $stmt->execute();

        // Close statement
        $stmt->close();
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Prepare and bind statement
    $stmt = $con->prepare("DELETE FROM todo_list WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute statement
    $stmt->execute();

    // Close statement
    $stmt->close();

    // Redirect to the index page
    header('Location: index.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Pico.css -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@picocss/pico@2.0.6/css/pico.min.css"
    />
    <style>
        form {
            position: relative;
            overflow: hidden;
            margin-bottom: 10px;
            padding: 10px;
        }
        .input,
        .left{
            width: 80%;
        }
        .submit,
        .right {
            width: 20%;
        }
        .input,
        .submit,
        .left,
        .right{
            float: left;
        }
        .todo-item {
            overflow: hidden;
            display: block;
            position: relative;
            border-bottom: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .right {
            text-align: center;
        }
        .delete {
            text-decoration: none;
        }
        .error{
            color: red;
        }

    </style>
</head>
<body>

    <main class="container">
        <h3 style="text-align: center;">PHP ToDo List</h3>
        <form method="post">
            <div class="input"><input type="textbox" id="textbox" name="textbox"><span class="error"><?php echo $error; ?></span></div>
            <div class="submit"><input type="submit" id="submit" name="submit"></div>
        </form>
        

        <?php 
        // Prepare SQL statement to select all items from todo_list
        $sql = "SELECT * FROM todo_list ORDER BY id DESC";
        $res = $con->query($sql);

        if ($res && $res->num_rows > 0) {
            // Fetch and display each row
            while ($row = $res->fetch_assoc()) {
                ?>
                <div class="todo-item">
                    <div class="left"><?php echo htmlspecialchars($row['title']); ?></div>
                    <div class="right">
                        <a href="index.php?delete=<?php echo intval($row['id']); ?>" class="delete">Delete</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p style="text-align:center;">Data Not Found</p>';
        }
        // Close connection
        $con->close();
        ?>
       

    </main>
    
</body>
</html>