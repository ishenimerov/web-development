<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $post_title = $_POST['post_title'];
        $post_description = $_POST['post_description'];
        $user_id = $_SESSION['id'];
        include_once "db-conn/db_conn.php";

        // Insert post into the database using prepared statements to prevent SQL injection
        $sql = "INSERT INTO posts (post_title, post_description, user_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $post_title, $post_description, $user_id);
        $stmt->execute();

        // Check if the insertion was successful
        if ($stmt->affected_rows > 0) {
            // Redirect after successful operation
            header("Location: my-post.php");
            exit();
        } else {
            // Handle insertion failure
            echo "Failed to insert post into the database.";
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
    <title>Create Post</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <style>
        /* Additional custom styling */
        .form-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 20px;
        }

        .form-group {
            width: 100%;
            margin-bottom: 20px;

        }

        label {
            font-weight: bold;
            color: black;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }

        #post_description {
            min-height: 200px;
            max-height: 500px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class='wrapper'>
        <?php include 'common/header/header.php'; ?>

        <main>
            <div class="main-box">
                <span style="text-align: center; font-size: 50px; margin-bottom: 100px;">Create Post</span>
                <form method="POST" action="create-post.php" enctype="multipart/form-data">
                    <div class="form-wrapper" style="display:flex; flex-direction: column;">
                        <div class="form-group">
                            <label for="post_title">Title:</label>
                            <input type="text" id="post_title" name="post_title" placeholder="Type the title" required
                                maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="post_description">Description:</label>
                            <textarea id="post_description" name="post_description" placeholder="Type the description"
                                required></textarea>
                        </div>
                        <div style="display:flex; flex-direction: row; width: 100%">
                            <label for="post_picture" style="display: flex; align-items: center;">
                                <span>Select File:</span>
                                <input type="file" id="post_picture" name="post_picture"
                                    style="position: absolute; left: -9999px;" onchange="displayFileName()">
                            </label>
                            <button type="button"
                                onclick="document.getElementById('post_picture').click();">Browse</button>
                            <span id="file_name" style="margin-left: 10px;"></span>
                        </div>
                        <script>
                            function displayFileName() {
                                var input = document.getElementById('post_picture');
                                var fileName = input.files.length > 0 ? input.files[0].name : 'No file selected';
                                document.getElementById('file_name').innerText = fileName;
                            }
                        </script>
                        <button type="submit" name="submit">Submit</button>
                    </div>

                </form>
            </div>
        </main>
        <?php (include ('common/footer/footer.php')) ?>
    </div>
</body>

</html>