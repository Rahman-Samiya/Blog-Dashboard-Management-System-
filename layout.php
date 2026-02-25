<html>
<!-- HEAD -->
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="samiya/css/style.css" />
    <link rel="stylesheet" href="samiya/css/responsive.css" />
</head>

<body>
    <!-- HEADER -->
    <header>
    <div class="logosec">
        <div class="logo">SR</div>
        <img src="samiya/img/menu.png"
            class="icn menuicn" id="menuicn" alt="menu-icon" />
    </div>

    <div class="message">
        <div class="circle"></div>
        <div class="dp">
            <img src="samiya/img/user.png"
                class="dpicn" alt="dp" />
        </div>
    </div>
</header>

    <div class="main-container">
        <!-- SLIDEBAR -->
        <?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<div class="navcontainer">
    <nav class="nav">
        <div class="nav-upper-options">

            <div class="nav-option option1 <?= in_array($current_page, ['index.php', 'create.php', 'edit.php']) ? 'active' : '' ?>">

                <a href="index.php">
                    <img src="samiya/img/home.png" class="nav-img" alt="dashboard" />
                    <h3>Dashboard</h3>
                </a>
            </div>

            <div class="nav-option option2 <?= in_array($current_page, ['category.php', 'categoryCreate.php', 'categoryEdit.php']) ? 'active' : '' ?>">
                <a href="category.php">
                    <img src="samiya/img/category.png" class="nav-img" alt="category" />
                    <h3>Categories</h3>
                </a>
            </div>

            <div class="nav-option option3 <?= in_array($current_page, ['tag.php', 'tagCreate.php', 'tagEdit.php']) ? 'active' : '' ?>">
                <a href="tag.php">
                    <img src="samiya/img/tag.png" class="nav-img" alt="tags" />
                    <h3>Tags</h3>
                </a>
            </div>


             

            <div class="nav-option logout">
                <a href="logout.php">
                    <img src="samiya/img/logout.png" class="nav-img" alt="tags" />
                    <h3>Logout</h3>
                </a>
            </div>

        </div>
    </nav>
</div>

        <div class="main">
        	<?php section();?>
            
        </div>
    </div>
<!-- JS -->
    <script src="samiya/js/script.js"></script>
    
<?php
	if(function_exists('extra_js')) {
	    extra_js();
	}
?>

</body>

</html>