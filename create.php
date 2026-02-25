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
	  	$title = $subtitle = $slug = $image = $short_description = $description = $descriptionErr = $category = $tags = "";

		$categoryResult = mysqli_query($conn, "SELECT id, title FROM categories");

		$tagResult = mysqli_query($conn, "SELECT id, title FROM tags");

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

		    $errors = [];

		    $title = !empty($_POST["title"]) ? $_POST["title"] : $errors[] = "Title is required";
		    $subtitle = !empty($_POST["subtitle"]) ? $_POST["subtitle"] : $errors[] = "Subtitle is required";
		    $slug = !empty($_POST["slug"]) ? $_POST["slug"] : $errors[] = "Slug is required";
		    $short_description = !empty($_POST["short_description"]) ? $_POST["short_description"] : $errors[] = "Short Description is required";
		    $description = !empty($_POST["description"]) ? $_POST["description"] : $errors[] = "Description is required";
		    $category = !empty($_POST["category_id"]) ? $_POST["category_id"] : $errors[] = "Category is required";
		    $tags = !empty($_POST["tags"]) ? $_POST["tags"] : $errors[] = "Tags are required";

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

		    if (empty($errors)) {

		        $slugCheckQuery = "SELECT id FROM blogs WHERE slug = ?";
		        $stmt = mysqli_prepare($conn, $slugCheckQuery);
		        mysqli_stmt_bind_param($stmt, "s", $slug);
		        mysqli_stmt_execute($stmt);
		        mysqli_stmt_store_result($stmt);

		        if (mysqli_stmt_num_rows($stmt) > 0) {
		            $_SESSION['error_message'] = "This blog already exists.";
		        } else {

		            $insertBlogSQL = "INSERT INTO blogs (title, subTitle, slug, short_description, description, category_id, featured_image, created_at)
		                              VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

		            $stmt = mysqli_prepare($conn, $insertBlogSQL);
		            mysqli_stmt_bind_param($stmt, "sssssis", $title, $subtitle, $slug, $short_description, $description, $category, $imagePath);
		            
		            if (mysqli_stmt_execute($stmt)) {
		                $insertedId = mysqli_insert_id($conn);

		                foreach ($tags as $tag) {
		                    $insertTagSQL = "INSERT INTO blog_tag (blog_id, tag_id) VALUES (?, ?)";
		                    $stmtTag = mysqli_prepare($conn, $insertTagSQL);
		                    mysqli_stmt_bind_param($stmtTag, "ii", $insertedId, $tag);
		                    mysqli_stmt_execute($stmtTag);
		                    mysqli_stmt_close($stmtTag);
		                }

		                $_SESSION['success_message'] = "Blog uploaded successfully.";
		            } else {
		                $_SESSION['error_message'] = "Something went wrong during blog insert.";
		            }

		            mysqli_stmt_close($stmt);
		        }
			    header("Location: index.php");
			    exit();
		    } else {
		        $_SESSION['error_message'] = $errors[0];
		    }

		    
		}

		?>

		<div class="report-container">
			
		    <h2 class="form-title">Create New Blog</h2>
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
		            <input type="text" name="title" onkeyup="listingslug(this.value)" id="title" required>
		            <small><?php echo $titleErr; ?></small>
		        </div>

		        <div class="form-group">
		            <label for="slug">Slug</label>
		            <input type="text" name="slug" id="slug" required>
		            <small><?php echo $slugErr; ?></small>
		        </div>
		        <div class="form-group">
		            <label for="subtitle">SubTitle *</label>
	              	<input type="text" name="subtitle" placeholder="Enter Sub Title" required="required">
	              	<small><?php echo $subTitleErr; ?></small>                  
	            </div>

		        <div class="form-group">
		        	<img src="" class="profile-user-img img-responsive" height="100" width="100" alt="Selected Featured Image" id="output">
		            <label for="featured_image">Featured Image</label>
		            <input type="file" name="image" accept="image/*" onchange="loadFile(event)" id="featured_image" required>
		        </div>

		        <div class="form-group">
		            <label for="tags">Select Tags</label>
		            <select name="tags[]" id="tags" multiple="multiple" required>
		                <?php while($tag = mysqli_fetch_assoc($tagResult)) : ?>
		                    <option value="<?= $tag['id'] ?>"><?= htmlspecialchars($tag['title']) ?></option>
		                <?php endwhile; ?>
		            </select>
		            <small><?php echo $tagsErr; ?></small>
		        </div>

		        <div class="form-group">
				  	<label for="short_description">Short Description *</label>
				  	<textarea name="short_description" id="short_description" placeholder="Short Description" required></textarea>
				</div>

				<div class="form-group">
				  	<label for="description">Description *</label>
				  	<textarea name="description" id="description" placeholder="Description" required></textarea>
				</div>

		        <div class="form-group">
		            <label for="category">Select Category</label>
		            <select name="category_id" id="category" required>
		                <option value="">-- Select Category --</option>
		                <?php while($cat = mysqli_fetch_assoc($categoryResult)) : ?>
		                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['title']) ?></option>
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
		    if (output) {
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
