<?php

include "db-conn/db_conn.php";

$sql = "SELECT * FROM users";

$result = $conn->query($sql);

?>

<!DOCTYPE html>

<html>

<head>

    <title>View Users</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">

</head>

<body>
    <div class='wrapper'>
        <?php include "common/header/header.php"; ?>
        <main>
            
        <h2>Users list</h2>

           
            
            <table class="table">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Username</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {

                            ?>

                            <tr>

                                <td>
                                    <?php echo $row['id']; ?>
                                </td>

                                <td>
                                    <?php echo $row['user_name']; ?>
                                </td>

                                <td>
                                    <?php echo $row['name']; ?>
                                </td>

                                <td>
                                    <?php echo $row['email']; ?>
                                </td>


                                <td><a class="links-btn edit-btn" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;<a
                                        class="links-btn del-btn" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>

                            </tr>

                        <?php }

                    }

                    ?>

                </tbody>

            </table>

        </main>
        <?php include 'common/footer/footer.php'; ?>
    </div>
</body>

</html>