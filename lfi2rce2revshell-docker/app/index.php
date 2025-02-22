Test web page

<?php 
	if (isset($_GET['file'])) {
		include($_GET['file']);
	}
?>