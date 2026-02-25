<?php
	include '../connection.php';

	$sql = "SELECT * FROM blogs ORDER BY id DESC limit 3";
	$query = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Home - Simple Blog</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
	<style>
		*, *::before, *::after {
			box-sizing: border-box;
		}
		body, html {
			margin: 0; padding: 0; height: 100%;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: #fefefe;
			color: #333;
		}
		nav {
			background-color: #2a9d8f;
			box-shadow: 0 2px 8px rgba(38, 70, 83, 0.3);
			position: sticky;
			top: 0;
			z-index: 1000;
		}
		nav ul {
			display: flex;
			justify-content: center;
			list-style: none;
			padding: 1rem 2rem;
			margin: 0;
			gap: 3.5rem;
		}
		nav a {
			color: #e9f1f0;
			font-weight: 600;
			font-size: 1.1rem;
			text-decoration: none;
			position: relative;
			transition: color 0.3s ease;
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}
		nav a:hover {
			color: #f4a261;
		}
		nav a::after {
			content: '';
			position: absolute;
			bottom: -8px;
			left: 0;
			width: 0;
			height: 3px;
			background: #f4a261;
			transition: width 0.3s ease;
		}
		nav a:hover::after {
			width: 100%;
		}
		header.hero {
			text-align: center;
			padding: 8rem 1.5rem 5rem;
			background: #ffffff;
			color: #2a9d8f;
			position: relative;
			overflow: hidden;
		}
		header.hero h1 {
			font-size: 3rem;
			margin-bottom: 1rem;
			color: #2a9d8f;
			text-shadow: none;
			opacity: 0;
			animation: fadeUp 1s ease forwards;
			animation-delay: 0.3s;
		}
		header.hero p {
			font-size: 1.3rem;
			margin-bottom: 2rem;
			max-width: 600px;
			margin-left: auto;
			margin-right: auto;
			color: #555;
			opacity: 0;
			animation: fadeUp 1s ease forwards;
			animation-delay: 0.8s;
		}
		header.hero button {
			background: #2a9d8f;
			border: none;
			color: #ffffff;
			font-size: 1rem;
			padding: 0.8rem 2.5rem;
			border-radius: 36px;
			cursor: pointer;
			box-shadow: 0 6px 15px rgba(38, 70, 83, 0.3);
			transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
			opacity: 0;
			animation: fadeUp 1s ease forwards;
			animation-delay: 1.3s;
		}
		header.hero button:hover {
			background: #f4a261;
			color: #fff;
			transform: scale(1.05);
			box-shadow: 0 8px 25px #f4a261;
		}
		@keyframes fadeUp {
			from {
				opacity: 0;
				transform: translateY(20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
		main {
			max-width: 960px;
			margin: 3rem auto 4rem;
			padding: 0 1.5rem;
		}
		.blog-cards {
			display: grid;
			gap: 2rem;
			grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
		}
		.card {
			background: #ffffff;
			border-radius: 14px;
			box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
			overflow: hidden;
			display: flex;
			flex-direction: column;
			transition: transform 0.3s ease, box-shadow 0.3s ease;
		}
		.card:hover {
			transform: translateY(-7px);
			box-shadow: 0 14px 40px rgba(0, 0, 0, 0.15);
		}
		.card img {
			width: 100%;
			height: 180px;
			object-fit: cover;
		}
		.card h2 {
			font-size: 1.4rem;
			margin: 1rem 1rem 0.5rem;
			color: #264653;
		}
		.card p {
			font-size: 1rem;
			color: #555;
			margin: 0 1rem 1rem;
		}
		.card a.read-more {
			font-weight: 600;
			font-size: 0.95rem;
			text-decoration: none;
			color: #2a9d8f;
			margin: 0 1rem 1rem;
			border-bottom: 2px solid transparent;
			align-self: flex-start;
			transition: color 0.3s ease, border-color 0.3s ease;
		}
		.card a.read-more:hover {
			color: #e76f51;
			border-color: #e76f51;
		}
		button.show-all {
			display: block;
			margin: 3rem auto;
			background: #2a9d8f;
			color: white;
			padding: 0.75rem 2rem;
			border: none;
			border-radius: 20px;
			font-size: 1rem;
			cursor: pointer;
			transition: background 0.3s ease;
		}
		button.show-all:hover {
			background: #e76f51;
		}
		footer {
			text-align: center;
			padding: 1.8rem;
			font-size: 0.85rem;
			color: #777;
			border-top: 1px solid #ddd;
		}
		.card .icon {
			font-size: 2rem;
			color: #2a9d8f;
			margin: 1rem;
		}
	</style>
</head>
<body>

<nav>
	<ul>
		<li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
		<li><a href="blog.php"><i class="fas fa-blog"></i> Blog</a></li>
		<li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
	</ul>
</nav>

<header class="hero">
	<h1>Welcome to Samiya's Blog & Management System</h1>
	<p>Explore insightful blogs, manage your categories with ease, and enjoy a seamless user experience. Whether you're here to read, write, or organize, we've got the tools to empower your content journey.</p>
	<button onclick="document.getElementById('posts').scrollIntoView({ behavior: 'smooth' });">Explore Posts</button>
</header>

<main>
	<section id="posts" class="blog-cards" aria-label="Latest blog posts">
		<?php if($query->num_rows > 0): ?>
			<?php while($row = $query->fetch_assoc()):
				$title = htmlspecialchars($row['title']);
				$slug = $row['slug'];
				$short_description = htmlspecialchars($row['short_description']);
				$image = htmlspecialchars($row['featured_image']);
			?>
				<div class="card">
					<img src="../<?= $image ?>" alt="<?= $title ?>">
					<div class="icon"><i class="fas fa-pencil-alt"></i></div>
					<h2><?= $title ?></h2>
					<p><?= $short_description ?></p>
					<a href="single_blog.php?slug=<?= $slug ?>" class="read-more">Read More</a>
				</div>
			<?php endwhile; ?>
		<?php else: ?>
			<p>No blog posts available.</p>
		<?php endif; ?>
	</section>

	<button class="show-all" onclick="window.location.href='blog.php'">Show All Blogs</button>
</main>

<footer>
	 <b>Samiya's Blog & Management System .</b>
	<b>For any query ,feel free to contact . Email:- samiya.r.cse.2k23@gmail.com</b>
</footer>

</body>
</html>
