<?php
include 'sqlread.php';
include ('authentication.php');
include('includes/header.register.php');
include('includes/navbar.php');
include('Crud-Operation/header.read.php');
?>
<div id="sarid">
<div class="container">
		<div class="box">
			<h4 class="display-4 text-center">Read</h4><br>
			<?php if (isset($_GET['success'])) { ?>
		    <div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
		    </div>
		    <?php } ?>
			<?php if (mysqli_num_rows($result)) { ?>
			<table class="table table-striped">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Name</th>
                  <th scope="col">Phone</th>
			      <th scope="col">Email</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	   $tableData = 0;
			  	   while($rows = mysqli_fetch_assoc($result)){
			  	   $tableData++;
			  	 ?>
			    <tr>
			      <th scope="row"><?=$tableData?></th>
			      <td><?=$rows['name']?></td>
                  <td><?=$rows['mobile']?></td>
			      <td><?php echo $rows['email']; ?></td>
			      <td><a href="update.php?id=<?=$rows['id']?>" 
			      	     class="btn btn-success">Update</a>

					  <a href="sqldelete.php?id=<?=$rows['id']?>" 
			      	     class="btn btn-danger">Delete</a>
			      </td>
			    </tr>
			    <?php } ?>
			  </tbody>
			</table>
			<?php } ?>
			<div class="link-right">
				<a href="form.php" class="btn btn-secondary">Create</a>
			</div>
		</div>
	</div>
</div>
<?php include('Crud-Operation/footer.php');?>