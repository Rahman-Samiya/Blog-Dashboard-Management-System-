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

		    if (empty($errors)) {

	            $insertCategorySQL = "INSERT INTO categories (title, slug, created_at)
	                              VALUES (?, ?, NOW())";

	            $stmt = mysqli_prepare($conn, $insertCategorySQL);
	            mysqli_stmt_bind_param($stmt, "ss", $title, $slug);
	            
	            if (mysqli_stmt_execute($stmt)) {
	                
	                $_SESSION['success_message'] = "Category successfully.";
	            } else {
	                $_SESSION['error_message'] = "Something went wrong during category insert.";
	            }
	            mysqli_stmt_close($stmt);

			    header("Location: category.php");
			    exit();
		    } else {
		        $_SESSION['error_message'] = $errors[0];
		    }

		    
		}
		?>
		<div class="report-container">
			<h2 class="form-title">Create Category</h2>
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
		            <input type="text" name="title" onkeyup="listingslug(this.value)" id="title" required>
		            <small><?php echo $titleErr; ?></small>
		        </div>

		        <div class="form-group">
		            <label for="slug">Slug</label>
		            <input type="text" name="slug" id="slug" required>
		            <small><?php echo $slugErr; ?></small>
		        </div>

		        <button type="submit" class="submit-btn">Create Category</button>
		    </form>
		</div>
		<?php
	}
	include('layout.php');

?>