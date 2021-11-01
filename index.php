<!DOCTYPE html>
<html>
	
	<head>

		<link rel="stylesheet" type="text/css" href="home.css">


	</head>



	<body>
		<?php require_once 'process.php'; ?>

		<!-- <?php
		if (isset($_SESSION['message'])): ?>

		<div id="<?= $_SESSION['msg_type'] ?>">
			<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>
		<?php endif ?> -->
		<div>
			<h1 class="ml12">ATS-1219 ;)</h1>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
			<script type="text/javascript">
				// Wrap every letter in a span
				var textWrapper = document.querySelector('.ml12');
				textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
					anime.timeline({loop: true})
					.add({
						targets: '.ml12 .letter',
						translateX: [40,0],
						translateZ: 0,
						opacity: [0,1],
						easing: "easeOutExpo",
						duration: 1200,
						delay: (el, i) => 500 + 30 * i
					}).add({
						targets: '.ml12 .letter',
						translateX: [0,-30],
						opacity: [1,0],
						easing: "easeInExpo",
						duration: 1100,
						delay: (el, i) => 100 + 30 * i
					});
			</script>




		</div>

		<div class="bodyHead">

			<div class="bodyPlace" >
				<form class="form" action="process.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div >
						<label class="Inputlabel">Firstname</label>
						<input name="firstname" type="text" class="infor" value="<?php echo $firstname; ?>" placeholder="Enter your firstname">
					</div>

					<div>
						<label>Lastname</label>
						<input name="lastname" type="text" class="infor" value="<?php echo $lastname; ?>" placeholder="Enter your lastname">
					</div>
					<div>
						<label>Phonenumber</label>
						<input name="phonenumber" type="text" class="infor" value="<?php echo $phonenumber; ?>" placeholder="Enter your phone number">
					</div>
					<br>
					<div>
						<label class="checkLabel" for="apply">agree</label>
						<input name="ready" type="checkbox" class="infor_box" id="apply" value="ready">
						<?php if ($update == true):
						?>				
							<button type="submit" name="update" class="saveButton" id="submit" disabled>
							Update</button>
						<?php else: ?>
							<button type="submit" name="save" class="saveButton" id="submit" disabled>
							Save</button>
						<?php endif; ?>
						
							<script>
								document.getElementById('apply').addEventListener('change', function (e) {
								document.getElementById('submit').disabled = !e.target.checked
								});
    						</script>
					</div> 
				</form>
				<hr class="hr_h">
				<p>by  <span class="copyrights">D. Bakxtishod & Y. Jasur</span></p>
				
			</div>

			<div class="bodyPlaceRight">
				<div class="form_group">

					<?php

						$mysqli = mysqli_connect('localhost', 'tatu_user', '12345','tatudb');

						$result = $mysqli -> query("SELECT * FROM data") or die($mysqli -> error);

					?>
					<h3>Registered people</h3>
					<table class="form_group " >
						<thead class="thetable">
							<tr color="#aaaaaa">
								<th>Firstname</th>
								<th>Lastname</th>
								<th>Phonenumber</th>
								<th colspan="3">Action</th>
							</tr>
						</thead>
				<?php 
					while ($row = $result -> fetch_assoc()): ?>
						<tr>
							<td><?php echo $row['firstname']; ?> </td>
							<td><?php echo $row['lastname']; ?> </td>
							<td><?php echo $row['phonenumber']; ?> </td>
							<td>
								<a href="index.php?edit=<?php echo $row[id]; ?>" class="btn-info">Edit</a>
								<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn-danger">Delete</a>
							</td>
						</tr>
					<?php endwhile; ?>
					</table>
				</div>
			
			</div>
				
		</div>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	

			
	</body>
</html>