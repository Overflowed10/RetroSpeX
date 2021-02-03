<?php 
require('../../controller/checkLoginStatus.php');
if(!isset($_SESSION['meeting'])){
    header('Location: meeting.view.php?id='.$_GET['id'].'&name='.$_GET['name']);
}
?>

<div class="container-fluid">
    <div class="navbar-nav fixed-top d-md-block justify-content-center">
        <ul class="navBar justify-content-between">
            <li class="navBar">
                <span class="navbar-text">
                    <?php echo $_GET['name']?>
                </span>
            </li>
            <li class="navBar">
                <span class="navbar-text">
                    Retrospektive
                </span>
            </li>
            <li class="navBar">
                <span class="navbar-text">
                    <?php echo $_GET['retroName']?>
                </span>
            </li>
        </ul>
    </div>
</div>
