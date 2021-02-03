<?php
if(!($_SESSION['user']->globalRole=="admin")) {
		header('Location: ../php/overview.view.php?permissions=insufficient');	
}
?>