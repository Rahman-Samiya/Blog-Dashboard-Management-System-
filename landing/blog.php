<?php
include '../connection.php';

// Fetch all blogs
$result = mysqli_query($conn, "SELECT * FROM blogs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Simple Blog</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        @keyframes fadeSlideDown {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        header {
            background: #ffffff;
            color: #21867a;
            padding: 40px 0 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
            animation: fadeSlideDown 1s ease-in-out;
        }

        header p {
            margin: 10px 0 0;
            font-size: 1.2em;
            animation: fadeSlideUp 1.2s ease-in-out;
        }

        h2 {
            color: #35424a;
            text-align: center;
            margin: 20px 0;
        }

        .blog-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .blog-item {
            background: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            margin: 10px;
            padding: 15px;
            width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .blog-item:hover {
            transform: scale(1.05);
        }

        .blog-image {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .read-more {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background: #21867a;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .read-more:hover {
            background: #e76f51;
        }

        footer {
            text-align: center;
            padding: 20px 0;
            background: #35424a;
            color: #ffffff;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Blog that Thinks with You</h1>
        <p>Where every click brings a lesson, a story, or a spark of inspiration.</p>
    </header>

    <main>
        <h2>All Blogs</h2>
        <div class="blog-list">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="blog-item">
                    <?php if (!empty($row['featured_image'])): ?>
                        <img src="../<?php echo htmlspecialchars($row['featured_image']); ?>" class="blog-image" alt="">
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['short_description']); ?></p>
                    <a href="single_blog.php?slug=<?php echo urlencode($row['slug']); ?>" class="read-more">Read More</a>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

   
</body>
</html>
