<?php 
	//show the admins table
	session_start();
	require 'default/database.php';
	require 'default/redirect.php';
	//viewing the admins data
	$showAdmins = $pdo->prepare("SELECT * FROM users_db_table WHERE user_role = :user_role");
	$showAdminCriteria = [
		'user_role' => "admin"
	];
	$showAdmins->execute($showAdminCriteria);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admins</title>
	<?php require 'default/header.php'; ?>
	<?php require 'default/section.php'; ?>
	<main>
		<h1>Admin Data</h1>
		<a href="add_admin.php">
			<div class="menu">Add New Admin</div>
		</a><br/>

		<table border="1px" class="table">
			<tr>
				<th>Admin id</th>
				<th>Admin username</th>
				<th>Admin role</th>
				<th>Admin Action</th>
			</tr>
				<?php $id=1;
				 foreach ($showAdmins as $tableValues) {?>
					<tr>
						<td><?php echo $id++; ?></td>
						<td><?php echo $tableValues['username']; ?></td>
						<td><?php echo $tableValues['user_role']; ?></td>
						<?php 
						// if s/he is super admin then s/he can edit his/her admin table and edit/delete other admins. The other admins can only view the admin table
						if($tableValues['user_role'] == 'admin'){ ?>
						<td>
							<a href="edit_admin.php?edid=<?php echo $tableValues['user_id']; ?>">
								Edit
							</a>/
							<a href="delete/deleteAdmin.php?del_id=<?php echo $tableValues['user_id']; ?>">
								Delete
							</a>
						</td>
						<?php }
						 else
						 	{ ?>
							<td>YOU CANNOT EDIT OR DELETE OTHER ADMINS</td>
						<?php  }?>
					</tr>
				<?php }?>
		</table>
	</main>
	<?php require '../default/footer.php'; ?>	
</body>
</html>