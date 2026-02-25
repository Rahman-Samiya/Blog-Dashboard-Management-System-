<?php
	session_start();

	if (!(isset($_SESSION['email']))) {
		header("location:login.php");
	} else {
		$name = $_SESSION['name'];
		$email = $_SESSION['email'];
	}

	include('connection.php'); 

	function section() {
		global $conn;

	    $titleErr = $subTitleErr = $slugErr = $imageErr = $short_descriptionErr = $descriptionErr = $categoryErr = $tagsErr = "";
	    $title = $subtitle = $slug = $imagePath = $short_description = $description = $category = "";
	    $selectedTags = [];

	    $categoryResult = mysqli_query($conn, "SELECT id, title FROM categories");
	    $tagResult = mysqli_query($conn, "SELECT id, title FROM tags");

	    if ($_SERVER["REQUEST_METHOD"] == "POST") {
	        $errors = [];

	        $title = $_POST["title"] ?? $errors[] = "Title is required";
	        $subtitle = $_POST["subtitle"] ?? $errors[] = "Subtitle is required";
	        $slug = $_POST["slug"] ?? $errors[] = "Slug is required";
	        $short_description = $_POST["short_description"] ?? $errors[] = "Short Description is required";
	        $description = $_POST["description"] ?? $errors[] = "Description is required";
	        $category = $_POST["category_id"] ?? $errors[] = "Category is required";
	        $tags = $_POST["tags"] ?? [];

	        $id = $_POST["get_id"];

	        if (!empty($_FILES['image']['name'])) {
	            $image = $_FILES['image'];
	            $imageName = $image['name'];
	            $imageTmpName = $image['tmp_name'];
	            $imageSize = $image['size'];
	            $imageError = $image['error'];
	            $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
	            $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

	            if (!in_array($imageExt, $allowedExt)) {
	                $errors[] = "Only JPG, PNG, JPEG & GIF allowed.";
	            } elseif ($imageError !== 0) {
	                $errors[] = "Image upload error.";
	            } elseif ($imageSize > 5 * 1024 * 1024) {
	                $errors[] = "Image size too large.";
	            } else {
	                $newImageName = time() . "_" . basename($imageName);
	                $imagePath = "uploads/" . $newImageName;
	                move_uploaded_file($imageTmpName, $imagePath);
	            }
	        }

	        if (empty($errors)) {
	            $updateSQL = "UPDATE blogs SET title = ?, subTitle = ?, slug = ?, short_description = ?, description = ?, category_id = ?, featured_image = ?, updated_at = NOW() WHERE id = ?";
	            $stmt = mysqli_prepare($conn, $updateSQL);
	            mysqli_stmt_bind_param($stmt, "sssssssi", $title, $subtitle, $slug, $short_description, $description, $category, $imagePath, $id);

	            if (mysqli_stmt_execute($stmt)) {
	            	
	                mysqli_query($conn, "DELETE FROM blog_tag WHERE blog_id = $id");

	                foreach ($tags as $tag) {
	                    $tagInsertSQL = "INSERT INTO blog_tag (blog_id, tag_id) VALUES (?, ?)";
	                    $stmtTag = mysqli_prepare($conn, $tagInsertSQL);
	                    mysqli_stmt_bind_param($stmtTag, "ii", $id, $tag);
	                    mysqli_stmt_execute($stmtTag);
	                    mysqli_stmt_close($stmtTag);
	                }

	                $_SESSION['success_message'] = "Blog updated successfully.";
	                header("Location: index.php");
	                exit();
	            } else {
	                $_SESSION['error_message'] = "Update failed.";
	            }

	            mysqli_stmt_close($stmt);
	        } else {
	            $_SESSION['error_message'] = $errors[0];
	        }
	    }

	    if (isset($_GET['slug'])) {
	        $slug = $_GET['slug'];

			$slug = mysqli_real_escape_string($conn, $slug);
			$result = mysqli_query($conn, "SELECT * FROM blogs WHERE slug = '$slug'");
			$blog = mysqli_fetch_assoc($result);

	        if ($blog) {
	        	$id = $blog['id'];
	            $title = $blog['title'];
	            $subtitle = $blog['subTitle'];
	            $slug = $blog['slug'];
	            $short_description = $blog['short_description'];
	            $description = $blog['description'];
	            $category = $blog['category_id'];
	            $imagePath = $blog['featured_image'];

	            $tagQuery = mysqli_query($conn, "SELECT tag_id FROM blog_tag WHERE blog_id = $id");
	            while ($row = mysqli_fetch_assoc($tagQuery)) {
	                $selectedTags[] = $row['tag_id'];
	            }
	        } else {
	            $_SESSION['error_message'] = "Blog not found.";
	            header("Location: index.php");
	            exit();
	        }
	    } else {
	        $_SESSION['error_message'] = "No blog ID provided.";
	        header("Location: index.php");
	        exit();
	    }

	?>

		<div class="report-container">
			
		    <h2 class="form-title">Edit Blog</h2>
		    <?php 
				if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) { ?>
	              <div class="error-message" style="margin-bottom: 20px;font-size: 20px;color: red;"><?php echo $_SESSION['error_message']; ?></div>
	              <?php
	              unset($_SESSION['error_message']);
	          	}
	        ?>
		    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="blog-form">
		        
		        <div class="form-group">
		            <label for="title">Blog Title</label>
		            <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" onkeyup="listingslug(this.value)" id="title" required>
		            <small><?php echo $titleErr; ?></small>
		        </div>
		        <input type="hidden" name="get_id" value="<?php echo $id ?>">
		        <div class="form-group">
		            <label for="slug">Slug</label>
		            <input type="text" name="slug" value="<?= htmlspecialchars($slug) ?>" id="slug" required>
		            <small><?php echo $slugErr; ?></small>
		        </div>
		        <div class="form-group">
		            <label for="subtitle">SubTitle *</label>
	              	<input type="text" name="subtitle" value="<?= htmlspecialchars($subtitle) ?>" placeholder="Enter Sub Title" required="required">
	              	<small><?php echo $subTitleErr; ?></small>                  
	            </div>

		        <div class="form-group">
		        	<img src="<?= $imagePath ?>" class="profile-user-img img-responsive" height="100" width="100" alt="Selected Featured Image" id="output">
		            <label for="featured_image">Featured Image</label>
		            <input type="file" name="image" accept="image/*" onchange="loadFile(event)" id="featured_image" required>
		        </div>

		        <div class="form-group">
		            <label for="tags">Select Tags</label>
		            <select name="tags[]" id="tags" multiple="multiple" required>
					    <?php
					    $tagResult = mysqli_query($conn, "SELECT id, title FROM tags");
					    while($tag = mysqli_fetch_assoc($tagResult)) :
					        $selected = in_array($tag['id'], $selectedTags) ? 'selected' : '';
					    ?>
					        <option value="<?= $tag['id'] ?>" <?= $selected ?>><?= htmlspecialchars($tag['title']) ?></option>
					    <?php endwhile; ?>
					</select>
		            <small><?php echo $tagsErr; ?></small>
		        </div>

		        <div class="form-group">
				  	<label for="short_description">Short Description *</label>
				  	<textarea name="short_description" id="short_description" placeholder="Short Description" required><?= htmlspecialchars($short_description) ?></textarea>
				</div>

				<div class="form-group">
				  	<label for="description">Description *</label>
				  	<textarea name="description" id="description" placeholder="Description" required><?= htmlspecialchars($description) ?></textarea>
				</div>

		        <div class="form-group">
		            <label for="category">Select Category</label>
		            <select name="category_id" id="category" required>
					    <option value="">-- Select Category --</option>
					    <?php
					    $catResult = mysqli_query($conn, "SELECT id, title FROM categories");
					    while($cat = mysqli_fetch_assoc($catResult)) :
					        $selected = ($cat['id'] == $category) ? 'selected' : '';
					    ?>
					        <option value="<?= $cat['id'] ?>" <?= $selected ?>><?= htmlspecialchars($cat['title']) ?></option>
					    <?php endwhile; ?>
					</select>
		            <small><?php echo $categoryErr; ?></small>
		        </div>



		        <button type="submit" class="submit-btn">Create Blog</button>
		    </form>
		</div>


		<?php
	}
	include('layout.php');

	function extra_js() {
	  ?>
	    <script type="text/javascript">

		  document.addEventListener('DOMContentLoaded', function () {
		    var output = document.getElementById('output');
		    if (output.src == '') {
		      output.style.display = 'none';
		    }
		  });

		  var loadFile = function(event) {
		    var output = document.getElementById('output');
		    if (output) {
		      output.style.display = 'block';
		      output.src = URL.createObjectURL(event.target.files[0]);
		    }
		  };
		</script>

	  <?php
	  }
?>
