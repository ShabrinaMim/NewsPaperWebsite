<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users List</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>Serial Number</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php
                      $connection  = mysqli_connect("localhost", "root", "", "newspaper") or die("Connection Failed");
                      $limit = 3;
                      if(isset($_GET['page']))
                      {
                          $page = $_GET['page'];
                      }
                      else{
                          $page = 1;
                      }     
                      $offset = ($page - 1) * $limit;
                      $sql1 = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},$limit";
                      $result1 = mysqli_query($connection, $sql1) or die("Query Failed");
                      if (mysqli_num_rows($result1) > 0) {
                          $count = 0;
                        while ($row = mysqli_fetch_assoc($result1)) {
                            $count = $count + 1;
                      ?>
                          <tr>
                              <td class='id'><?php echo $count; ?></td>
                              <td><?php echo $row['first_name']." ".$row['last_name'] ;?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php 
                              if($row['role'] == 0){
                                  echo "Normal User";
                              }
                              else{
                                  echo "Admin";
                              } 
                              ?></td>
                              <td class='edit'><a href='update-user.php?userid=<?php echo $row['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?userid=<?php echo $row['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                          }
                        }
                      ?>       
                      </tbody>
                  </table>
                  <?php
                  $sql2 = "SELECT * FROM user";
                  $result2 = mysqli_query($connection, $sql2) or die("Query Failed");
                  $totalRecords = mysqli_num_rows($result2);
                  $totalPages = ceil($totalRecords/$limit);
                  echo "<ul class='pagination admin-pagination'>";
                  if($page > 1)
                  {
                      echo "<li><a href = 'users.php?page=".($page-1)."'>Prev</a></li>";
                  }
            
                  for($i = 1; $i <= $totalPages; $i++){
                      if($page == $i)
                      {
                          $active = "active";
                      }
                      else{
                          $active = "";
                      }
                      echo "<li class='".$active."'><a href = 'users.php?page=".$i."'>".$i."</a></li>";
                  }
                  if($page<$totalPages)
                  {
                      echo "<li><a href = 'users.php?page=".($page+1)."'>Next</a></li>";
                  }
                  echo "</ul>";
                  ?>

              </div>
          </div>
      </div>
  </div>
<?php include "header.php"; ?>
