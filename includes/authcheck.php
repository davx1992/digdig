<?php if( !isset($_SESSION['User'])){
    header('Location: '.$_SERVER['HTTP_ORIGIN'].'/digdig/login.php');    
}?>