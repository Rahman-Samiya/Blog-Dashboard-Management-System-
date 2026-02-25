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

    $sql = "SELECT blogs.id, blogs.title, blogs.slug, blogs.featured_image, categories.title AS category_title 
            FROM blogs 
            LEFT JOIN categories ON blogs.category_id = categories.id";

    $result = $conn->query($sql);
    ?>

    <div class="report-container">
        <div class="report-header">
            <h1 class="recent-Articles">DashBoard</h1>
            <a href="create.php" class="view">Add New</a>
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
                    <th onclick="sortTable(2)">Image ▲▼</th>
                    <th onclick="sortTable(3)">Tags ▲▼</th>
                    <th onclick="sortTable(4)">Category ▲▼</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $sr = 1;
                    while ($row = $result->fetch_assoc()) {
                        $blog_id = $row['id'];

                        // Fetch tags for each blog
                        $tag_sql = "SELECT tags.title FROM tags 
                                    JOIN blog_tag ON tags.id = blog_tag.tag_id 
                                    WHERE blog_tag.blog_id = ?";
                        $stmt = $conn->prepare($tag_sql);
                        $stmt->bind_param("i", $blog_id);
                        $stmt->execute();
                        $tag_result = $stmt->get_result();

                        $tags = [];
                        while ($tag_row = $tag_result->fetch_assoc()) {
                            $tags[] = $tag_row['title'];
                        }

                        $tag_list = implode(", ", $tags);
                        $slug = $row['slug'];
                        $id = $row['id'];
                        ?>

                        <tr>
                            <td><?= $sr++ ?></td>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td><img src="<?= htmlspecialchars($row['featured_image']) ?>" alt="Image" style="height: 50px;"></td>
                            <td>
                              <?php foreach ($tags as $tag): ?>
                                  <span class="tag-badge"><?= htmlspecialchars($tag) ?></span>
                              <?php endforeach; ?>
                            </td>
                            
                            <td><?= htmlspecialchars($row['category_title']) ?></td>

                            <td>
                                <div class="btn-group">
                                    <button class="btn">Action</button>
                                    <button class="btn dropdown-toggle" onclick="toggleDropdown(this)">▼</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="edit.php?slug=<?= $slug ?>">Edit</a>
                                        <a class="dropdown-item" href="updateblog.php?slug=<?= $slug ?>">View</a>
                                        <a class="dropdown-item" href="delete.php?id=<?= $id ?>" onclick="return confirm('Are you sure you want to delete this Blog?');">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No blogs found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
            <?php 
  } 
  include('layout.php');

?>