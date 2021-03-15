<?php include "header.php"; 
if (isset($_POST['submit'])) {
    $connection  = mysqli_connect("localhost", "root", "", "newspaper") or die("Connection Failed");
    $firstName = $_POST['f_name'];
    $lastName = $_POST['l_name'];
    $userName = $_POST['username'];
    $role = $_POST['role'];
    $userid = $_GET['userid'];

    $sqlQuery = "UPDATE user SET first_name = '{$firstName}',last_name = '{$lastName}',username = '{$userName}',role = {$role} WHERE user_id = {$userid}";
    if(mysqli_query($connection, $sqlQuery))
    {
        header("Location: http://localhost/NewsPaperWebsite/admin/users.php");
    }
    mysqli_close($connection);
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php
                  $connection  = mysqli_connect("localhost", "root", "", "newspaper") or die("Connection Failed");
                  $userid = $_GET['userid'];
                  $sqlQuery = "SELECT * FROM user WHERE user_id = {$userid}";
                  $result = mysqli_query($connection, $sqlQuery) or die("Query Failed");
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
                  <?php 
                    }
                }
                ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
