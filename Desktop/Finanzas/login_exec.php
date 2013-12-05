

    <?php
      //Start session
      session_start();
     
      //Include database connection details
      require_once('connection.php');
     
      //Array to store validation errors
      $errmsg_arr = array();
     
      //Validation error flag
      $errflag = false;
     
      //Function to sanitize values received from the form. Prevents SQL injection
      function clean($str) {
           $str = @trim($str);
       if(get_magic_quotes_gpc()) {
           $str = stripslashes($str);
       }
       return mysql_real_escape_string($str);
      }
     
      //Sanitize the POST values
      $username = clean($_POST['usuario']);
      $password = clean($_POST['password']);
     
      //Input Validations
       if($username == '') {
         $errmsg_arr[] = 'Usuario vacio';
         $errflag = true;
       }
       if($password == '') {
         $errmsg_arr[] = 'Password vacio';
         $errflag = true;
       }
     
       //If there are input validations, redirect back to the login form
       if($errflag) {
         $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
         session_write_close();
         header("location: index.php");
         exit();
       }
     
       //Create query
       $qry="SELECT * FROM Usuario WHERE usuario='$username' AND password='$password'";
       $result=mysql_query($qry);
     
       //Check whether the query was successful or not
       if($result) {
          if(mysql_num_rows($result) > 0) {
       //Login Successful
         session_regenerate_id();
         $member = mysql_fetch_assoc($result);
         $_SESSION['SESS_MEMBER_ID'] = $member['idUsuario'];
         $_SESSION['SESS_FIRST_NAME'] = $member['usuario'];
         $_SESSION['SESS_LAST_NAME'] = $member['password'];
          session_write_close();
         header("location: home.php");
         exit();
       }else {
       //Login failed
       $errmsg_arr[] = 'usuario y password no encontrados';
       $errflag = true;
        if($errflag) {
           $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
           session_write_close();
           header("location: login.php");
            exit();
        }
      }
      }else {
          die("Query failed");
        }
   ?>
