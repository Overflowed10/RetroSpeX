<?php
if(!isset($_SESSION['user'])) {
		header('Location: ../php/login.view.php?login=invalid');	
	}
?>