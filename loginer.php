<?php include("includes/db.php");

  if(isset($_POST)){
    $email = $_POST['email'];
    $passw = sha1($_POST['password'].$salt);
    $result = mysql_query("SELECT * FROM users WHERE email = '".$email."' AND password = '".$passw."'",$db);
    $user =  mysql_fetch_array($result, MYSQL_ASSOC);
    if($user){
      unset($user['password']);
        $_SESSION['User'] = array();
        $_SESSION['User'] = $user;
        header('Content-Type: application/json');
        echo json_encode(array('response' => true));
    }else{
        header('Content-Type: application/json');
        echo json_encode(array('response' => false,
                               'error'    => "Wrong email or password!"));
    }
  }

?>
