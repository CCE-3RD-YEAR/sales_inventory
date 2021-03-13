<?php


 
	$username = "";
	$errors = array(); 
	$shift = 3;

	
	$db = mysqli_connect('localhost','root','','sales_inventory_db');
	
	//for registration
	if(isset($_POST['save'])){
               
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		
    function encrypt($str, $shift) {
    $encrypted = "" ;
    $shift = $shift % 26;
    if($shift < 0) {
        $shift += 26;
    }
    $a= 0;
    while($a < strlen($str)) {
        $char = strtoupper($str[$a]); 
        if(($char >= "A") && ($char <= 'Z')) {
            if((ord($char) + $shift) > ord("Z")) {
                $encrypted .= chr(ord($char) + $shift - 26);
        } else {
            $encrypted .= chr(ord($char) + $shift);
        }
      } else {
          $encrypted.= " ";
      }
      $a++;
    }
    return $encrypted;
	}
	
	if (count($errors) == 0) {
    $encryp = encrypt($password, $shift);
  	$query = "INSERT INTO users ('', '', username, password, '') 
  			  VALUES('', '', '$username', '$encryp', '')";
  	mysqli_query($db, $query);
  	
  	
  }
}
	// for log in
	if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    function decrypt($str, $shift) {
        $decrypted = "";
        $shift = $shift % 26;
        if($shift < 0) {
            $shift += 26;
        }
        $a = 0;
        while($a < strlen($str)) {
            $char = strtoupper($str[$a]); 
            if(($char >= "A") && ($char <= 'Z')) {
                if((ord($char) - $shift) < ord("A")) {
                    $decrypted .= chr(ord($char) - $shift + 26);
            } else {
                $decrypted .= chr(ord($char) - $shift);
            }
          } else {
              $decrypted .= " ";
          }
          $a++;
        }
        return $decrypted;
    }
    
     if (count($errors) == 0) {
        $query = "SELECT `password` FROM users where username='$username'";
        $result = mysqli_query($db, $query);
       while($row = mysqli_fetch_array($result)) 
       { 
       $hold = $row['password'];      
       $decryp = decrypt($hold, $shift);
       if ($decryp == strtoupper($password)){
           $query = "SELECT * FROM users WHERE username='$username' AND password='$hold'";
           $results = mysqli_query($db, $query);
           if (mysqli_num_rows($results) == 1) {
           
             header('location: index.php');
           }else {
               array_push($errors, "Invalid Username or Password");
           }
       }
       else{
           array_push($errors, "Invalid Username or Password");
       }
   }
       
   }
 }
?>