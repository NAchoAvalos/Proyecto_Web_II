<?php
ob_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
        <!--<link rel="stylesheet" href="styles/style.css">-->
  </head>
 
  <body>
    
    <header>
       <?php
      include 'Archivos_class.php';
      $archivo = new Archivos();
      //var_dump($_SERVER['REQUEST_METHOD'] );
      if($_SERVER['REQUEST_METHOD'] == "POST"){

        if($archivo->registro(array('full_name' =>$_POST['full_name'],
                                  'email' =>$_POST['email'],
                                  'username' =>$_POST['username'],
                                  'password' =>$_POST['password'],
                                  're-password' =>$_POST['re-password']
                              ))){
          header('location:index.php');}
      }
      ?>
      </header>
    
    <main>
      <table>
        <form action="#" name="register_form" method="POST">
        <tr>
          <th>Sign Up</th>
        </tr>
        <tr>
          <td>
            <label>Full Name</label><br>
            <input type="text" name="full_name" required>
          </td>
        </tr>
        <tr>
          <td>
            <label>Email</label><br>
            <input type="text" name="email"required>
          </td>
        </tr>
        <tr>
          <td>
            <label>Username</label><br>
            <input type="text" name="username" required>
          </td>
        </tr>
        <tr>
          <td>
            <label>Pasword</label><br>
            <input type="password" name="password" required>
          </td>
        </tr>
        <tr>
          <td>
            <label>Confirm Password</label><br>
            <input type="password" name="re-password" required>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="Sign Up" name="sign_up"  >
          </td>
          <td>
            <input type="submit" value="Sign In" name="sign_in">
          </td>
        </tr>
        </form>
      </table>
     
    </main>

    <footer>
      <p>©Copyright by Universidad Nacional de Costa Rica 2018</p>
    </footer>

  </body>
</html>
<?php
ob_end_flush();
?>
