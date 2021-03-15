<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>
                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save User" required />
                  </form>
                   <!-- Form End-->
                   <?php
                        if (isset($_POST['save'])) {
                            $connection  = mysqli_connect("localhost", "root", "", "newspaper") or die("Connection Failed");
                            $firstName = $_POST['fname'];
                            $lastName = $_POST['lname'];
                            $userName = $_POST['user'];
                            $password = $_POST['password'];
                            $role = $_POST['role'];
                            $sql = "SELECT username FROM user WHERE username = '{$userName}'";
                            $result1 = mysqli_query($connection, $sql) or die("Query Failed");
                            if(mysqli_num_rows($result1) > 0){
                                echo "<p style = 'color:red;text-align:center;margin:10px 0px;'>Username already exists.</p>";
                            }
                            else{
                                $sqlQuery = "INSERT INTO user(first_name,last_name,username,password,role) 
                                VALUES ('{$firstName}','{$lastName}','{$userName}','{$password}',{$role})";
                                $result2 = mysqli_query($connection, $sqlQuery) or die("Query Failed");
                            }
                            mysqli_close($connection);
                        }
                   ?>
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>