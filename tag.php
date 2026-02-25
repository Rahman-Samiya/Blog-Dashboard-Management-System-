<?php
  
  session_start();

  if(!(isset($_SESSION['email'])))
  {
      header("location:login.php");
  }
  else
  {
      $name = $_SESSION['name'];
      $email = $_SESSION['email'];
  }


  function section(){
    include 'connection.php';

    $sql = "SELECT * 
            FROM tags 
            ORDER BY id DESC ";

    $result = $conn->query($sql);
    ?>

    <div class="report-container">
        <div class="report-header">
            <h1 class="recent-Articles">Tag</h1>
            <a href="tagCreate.php" class="view">Add New</a>
        </div>

        <input type="text" id="searchInput" placeholder="Search..." />

        <?php
          if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
              <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
              <?php
              unset($_SESSION['success_message']);
          }

          if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) { ?>
              <div class="error-message" style="margin-bottom: 20px;font-size: 20px;color: red;"><?php echo $_SESSION['error_message']; ?></div>
              <?php
              unset($_SESSION['error_message']);
          }
          ?>
        <table id="myTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">Sr.No ▲▼</th>
                    <th onclick="sortTable(1)">Title ▲▼</th>
                    <th onclick="sortTable(2)">Slug ▲▼</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $sr = 1;
                    while ($row = $result->fetch_assoc()) {
                        
                        $title = $row['title'];
                        $slug = $row['slug'];
                        $id = $row['id'];
                        ?>

                        <tr>
                            <td><?= $sr++ ?></td>
                            <td><?= htmlspecialchars($title) ?></td>
                            <td><?= htmlspecialchars($slug) ?></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn">Action</button>
                                    <button class="btn dropdown-toggle" onclick="toggleDropdown(this)">▼</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="tagEdit.php?slug=<?= $slug ?>">Edit</a>
                                        <a class="dropdown-item" href="tagDelete.php?id=<?= $id ?>" onclick="return confirm('Are you sure you want to delete this Tag?');">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No Tags found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
            <?php 
  } 
  include('layout.php');

?>