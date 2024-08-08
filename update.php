<?php
include 'sqlupdate.php';
include ('authentication.php');
include('includes/header.register.php');
include('includes/navbar.php');
include('Crud-Operation/header.php');
?>

<div id="kala_sarid">
<div class="container">
		<form action="sqlupdate.php" method="post">
		   <h4 class="display-4 text-center">Update</h4><hr><br>
		   <?php if (isset($_GET['error'])) { ?>
		   <div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
		    </div>
		   <?php } ?>
		   <div class="form-group">
           <label for="name" class="form-label">Name</label>
           <input type="text" id="name" class="form-control" name="user_name" value="<?=$row['name'] ?>" >
		   </div>
		   <div class="form-group">
           <label for="" class="form-label">Phone Number:</label>
           <input type="tel" id="tel" class="form-control" name="user_mobile" value="<?=$row['mobile']?>" >
		   </div>
           <div class="form-group">
		   <label for="email" class="form-label">Email address</label>
           <input type="email" class="form-control" id="email" name="user_email"value="<?=$row['email']?>" >
            </div>
                 <input type="text" name="id" value="<?=$row['id']?>" hidden >
                  <div class="link-right">
		   <button type="submit" class="btn btn-primary m-1" name="update">Update</button>
		    <a href="read.php" class="btn btn-secondary m-1">View</a>
            
            </div>
	    </form>
	</div>
</div>
<?php include('Crud-Operation/footer.php');?>