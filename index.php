<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>CRUD Operation</title>
</head>

<body>

    <?php require_once 'process.php'; ?>

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?>" role="alert">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud_php') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()) :
            ?>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES) ?></td>
                        <td><?php echo htmlspecialchars($row['location'], ENT_QUOTES) ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id'] ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                </tbody>
            <?php endwhile ?>
        </table>

        <div class="row justify-content-center">
            <form action="process.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" name="location" value="<?php echo $location ?>" placeholder="Enter your location">
                </div>
                <?php if ($update == true) : ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                    </div>
                <?php else : ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</body>

</html>