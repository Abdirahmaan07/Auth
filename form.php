<?php 
include('Crud-Operation/header.php');
include ('authentication.php');
include('includes/header.register.php');
include('includes/navbar.php');
?>
    <div id="kala_sarid">
        <div class="container">
            <form method="POST" action="create.php">
                <h4 class="display-6 text-center">Create</h4><hr />
                <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-control" name="user_name" value="<?php if(isset($_GET['user_name'])) echo $_GET['user_name'];?>" placeholder="Enter Name">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Phone Number:</label>
                    <input type="tel" id="" class="form-control" name="user_mobile" value="<?php if(isset($_GET['user_mobile'])) echo $_GET['user_mobile'];?>" placeholder="Enter Phone Number">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="user_email" value="<?php if(isset($_GET['user_email'])) echo $_GET['user_email'];?>" placeholder="name@example.com">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary m-1" name="create">Create</button>
                    <a href="read.php" class="btn btn-secondary m-1">View</a>
                </div>
            </form>
        </div>
    </div>

<?php include('Crud-Operation/footer.php');?>