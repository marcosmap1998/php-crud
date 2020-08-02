<?php

include('db.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM task WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $title = $row['title'];
        $description = $row['description'];
    }

    if(isset($_POST['update'])){
        $id = $_GET['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $query = "UPDATE task SET title='$title', description='$description' WHERE id='$id'";
        mysqli_query($conn, $query);

        $_SESSION['message'] = 'Task update successfully';
        $_SESSION['message_type'] = 'warning';

        header("Location: index.php");
    }

}

?>

<?php include('includes/header.php'); ?>

<div class="container">
    <div class="row p-4">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit-task.php?id=<?php echo $_GET['id'] ?>" method="POST" class="mb-0">
                    <div class="form-group">
                        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Update title" class="form-control">
                    </div>
                    <div class="from-group">
                        <textarea name="description" rows="2" placeholder="Update description" class="form-control"><?php echo $description ?></textarea>
                    </div>
                    <div class="form-group mt-3 mb-0">
                        <button class="btn btn-primary form-control" name="update">Update</button>  
                    </div>           
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>