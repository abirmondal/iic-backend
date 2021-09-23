<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Guest Book | IIC Tech Wing</title>
	<link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css'); ?>">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="">IIC Tech Wing</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>

	    <div class="collapse navbar-collapse" id="navbarColor01">
	      <ul class="navbar-nav me-auto">
	        <li class="nav-item">
	          <a class="nav-link active" href="<?= base_url() ?>">Guest Book
	          </a>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>

	<div class="p-3">
	    <p class="fs-2">Guest Book</p>
	</div>
	<div class="px-3 w-50" id="premess">
		<?php if ($messages):
		 ?>
				<?php foreach ($messages as $row) {
				 ?>
					<div class="p-1">
						<strong class="fs-4"><?= $row->name ?></strong>
						<small class="form-text text-muted">&nbsp&nbsp<?= date('g:mA, jS M Y', strtotime($row->date)) ?></small>
						<p class="px-4 fs-5"><?= str_replace("\n", '<br>', $row->message) ?></p>
					</div>
				<?php
				}
				 ?>
		<?php endif ?>
	</div>

	<form class="w-50 px-3">
	  <fieldset>
	    <div class="form-group">
	      <label for="exampleInputEmail1" class="form-label mt-4">Name</label>
	      <input type="Name" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter Your Name Here...">
	      <div class="invalid-feedback" id="nameerror"></div>
	    </div>
	    <div class="form-group">
	      <label for="exampleTextarea" class="form-label mt-4">Message</label>
	      <textarea class="form-control" name="message" id="message" rows="3" placeholder="Enter Guest Message Here..."></textarea>
	      <div class="invalid-feedback" id="messerror"></div>
	    </div>
	    <div class="form-group p-3">
		    <button type="reset" class="btn btn-secondary" id="resetbtn">Reset</button>
		    <button type="submit" class="btn btn-primary" id="submitbtn">Post Message</button>
		</div>
	  </fieldset>
	</form>
</body>

<script type="text/javascript">
	$(document).ready(function(){
		$('form').submit(function(e){
			e.preventDefault();
			error = 0;
			$.ajax({
 				url: 	'<?= base_url('guestbook/newmess') ?>',
 				method: 'POST',
 				dataType: "json",
 				data: $('form input, form textarea').serialize(),

 				success: 	function(result) {
 					
 					// console.log(result);
		 			$('#submitbtn').text('Post Message');
					$('#submitbtn').css('cursor', 'pointer');
					if (result['name']) {
						$('#name').addClass('is-invalid');
						$('#nameerror').text(result['name']);
						++error;
					}
					if (result['message']) {
						$('#message').addClass('is-invalid');
						$('#messerror').text(result['message']);
						++error;
					}
					if (error == 0) {
						if (result == "1") {
							$('form input, form textarea').val(null);
							$('#premess').load(document.URL + ' #premess>*');
						}
						else {
							alert(result);
						}
					}
 				}
 			});
		});

		setInterval(function(){
			// $('#premess').load(document.URL + ' #premess>*');
		}, 1000);
	});
</script>

</html>