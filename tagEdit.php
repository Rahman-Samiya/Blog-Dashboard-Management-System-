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

  	include('connection.php'); 
	function section(){
		global $conn;

		$titleErr = $slugErr = $title = $slug = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

		    $errors = [];

		    $title = !empty($_POST["title"]) ? $_POST["title"] : $errors[] = "Title is required";
		    $slug = !empty($_POST["slug"]) ? $_POST["slug"] : $errors[] = "Slug is required";
		    $id = $_POST["get_id"];
		    if (empty($errors)) {

	            $updateSQL = "UPDATE tags SET title = ?, slug = ?, updated_at = NOW() WHERE id = ?";
	            $stmt = mysqli_prepare($conn, $updateSQL);
	            mysqli_stmt_bind_param($stmt, "ssi", $title, $slug, $id);
	            
	            if (mysqli_stmt_execute($stmt)) {
	                
	                $_SESSION['success_message'] = "Tag successfully.";
	            } else {
	                $_SESSION['error_message'] = "Something went wrong during tag insert.";
	            }
	            mysqli_stmt_close($stmt);

			    header("Location: tag.php");
			    exit();
		    } else {
		        $_SESSION['error_message'] = $errors[0];
		    }
 
		}

		if (isset($_GET['slug'])) {
	        $slug = $_GET['slug'];

			$slug = mysqli_real_escape_string($conn, $slug);
			$result = mysqli_query($conn, "SELECT * FROM tags WHERE slug = '$slug'");
			$tag = mysqli_fetch_assoc($result);

	        if ($tag) {
	        	$id = $tag['id'];
	            $title = $tag['title'];
	            $slug = $tag['slug'];
	        } else {
	            $_SESSION['error_message'] = "Tag not found.";
	            header("Location: tag.php");
	            exit();
	        }
	    } else {
	        $_SESSION['error_message'] = "No Tag ID provided.";
	        header("Location: tag.php");
	        exit();
	    }
		?>
		<div class="report-container">
			<h2 class="form-title">Edit Tag</h2>
		    <?php 
				if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) { ?>
	              <div class="error-message" style="margin-bottom: 20px;font-size: 20px;color: red;"><?php echo $_SESSION['error_message']; ?></div>
	              <?php
	              unset($_SESSION['error_message']);
	          	}
	        ?>
		    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="blog-form">
		        
		        <div class="form-group">
		            <label for="title">Title</label>
		            <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" onkeyup="listingslug(this.value)" id="title" required>
		            <small><?php echo $titleErr; ?></small>
		        </div>

		        <div class="form-group">
		            <label for="slug">Slug</label>
		            <input type="text" name="slug" value="<?= htmlspecialchars($slug) ?>" id="slug" required>
		            <small><?php echo $slugErr; ?></small>
		        </div>

		        <input type="hidden" name="get_id" value="<?php echo $id ?>">

		        <button type="submit" class="submit-btn">Create Tag</button>
		    </form>
		</div>
		<?php
	}
	include('layout.php');

?>