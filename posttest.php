<!doctype html>
<html>
<body>
	<pre> <?php print_r($_POST); ?> </pre>

	<?php
		if(isset($_POST)){ echo "post"; };
		if(isset($_POST['3'])){ echo "asdf3"; };
		if(isset($_POST['4'])){ echo "asdf4"; };
	?>
</body>
</html>