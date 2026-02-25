<?php
	include '../connection.php';

	$slug = $_GET['slug'];

	$slug = mysqli_real_escape_string($conn, $slug);
	$result = mysqli_query($conn, "SELECT * FROM blogs WHERE slug = '$slug'");
	$blogs = mysqli_fetch_assoc($result);

	if ($blogs) {
    	$id = $blogs['id'];
        $title = $blogs['title'];
        $subtitle = $blogs['subTitle'];
        $slug = $blogs['slug'];
        $short_description = $blogs['short_description'];
        $description = $blogs['description'];
        $category = $blogs['category_id'];
        $imagePath = $blogs['featured_image'];

        $tagQuery = mysqli_query($conn, "SELECT tag_id FROM blog_tag WHERE blog_id = $id");
        while ($row = mysqli_fetch_assoc($tagQuery)) {
            $selectedTags[] = $row['tag_id'];
        }
    } else {
        header("Location: home.php");
        exit();
    }

?>


    <main>
        <h1><?php echo $title; ?></h1>
        <h6><?php echo $subtitle; ?></h6>
        <p><?= htmlspecialchars($description); ?></p>
        <img src="../<?= htmlspecialchars($imagePath); ?>" width="300" height="200" alt="">
        <a href="blog.php" class="back-button">Back to Blog</a>
    </main>
</body>
</html>
