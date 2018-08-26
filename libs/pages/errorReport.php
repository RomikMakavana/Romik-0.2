<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	/*echo "<pre>";
	print_r($error); exit; */
	?>
	<div  style="padding-top: 10px;">
		<h2 align="center" class="gedeant">ERROR</h2>
		<hr>
		<div class="accordion" id="accordionExample">
			<?php foreach($error as $k => $er): ?>
				<div class="alert alert-danger" role="alert">
					<h4 class="alert-heading"><?= $er['file'] ?></h4>
					<hr>
					<p>Line No . <?= $er['line'] ?></p>
					<p class="mb-0">function <b><?= $er['function']."()" ?></b></p>
					<p class="mb-0"><b><?= $er['msg'] ?></b></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</body>
</html>