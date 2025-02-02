<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['useremail'])) {
  header("Location:login.php");
  exit;
}

include_once 'ProductController.php';

$controller = new ProductController();
$controller->getAllProds(); // Ensure products are fetched from the repository
$products = $controller->getProducts();
$errorMsg = $controller->getErrorMessage();
$succeedMsg = $controller->getSucceedMessage();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/Shop.css">
</head>
<body>

    <!-- Fillimi i seksionit Header -->
    <header class="header">
        <a href="home.php" class="logo"><i class="ri-store-line"></i>Furnitia</a>
        <form action="#" class="search-form">
            <input type="search" placeholder="search here..." id="search-box">
            <label for="search-box" class="ri-search-line"></label>
        </form>

        <div class="icons">
            <div id="menu-btn" class="ri-menu-line"></div>
            <div id="search-btn" class="ri-search-line"></div>
            <div id="cart-btn" class="ri-shopping-cart-line"></div>
            <a href="login.php"><div id="login-btn" class="ri-user-line"></div></a>
        </div>
    </header>
    <!-- Mbarimi i seksionit Header -->

    <!-- Closer Butoni -->
    <div id="closer" class="ri-close-line"></div>

    <!-- Fillimi i Navbar -->
    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="about.php">About Us</a>
        <a href="team.php">Team</a>
        <a href="blog.php">Blog</a>
        <a href="contact.php">Contact Us</a>
    </nav>
    <!-- Mbarimi i Navbar -->

    <!-- Fillimi i Shopping Cart -->
    <div class="shopping-cart">

<div class="box">
    <i class="ri-close-line close-icon"></i>
    <img src="image/product-1.png" alt="">
    <div class="content">
        <h3>Modern Chair</h3>
        <span class="quantity"> 1 </span>
        <span class="multiply"> x </span>
        <span class="price"> 120.00€ </span>
    </div>
</div>

<div class="box">
    <i class="ri-close-line close-icon"></i>
    <img src="image/product-2.png" alt="">
    <div class="content">
        <h3>Modern Chair</h3>
        <span class="quantity"> 1 </span>
        <span class="multiply"> x </span>
        <span class="price"> 120.00€ </span>
    </div>
</div>

<div class="box">
    <i class="ri-close-line close-icon"></i>
    <img src="image/product-3.png" alt="">
    <div class="content">
        <h3>Modern Chair</h3>
        <span class="quantity"> 1 </span>
        <span class="multiply"> x </span>
        <span class="price"> 120.00€ </span>
    </div>
</div>

<h3 class="total">total : <span>360.00€</span></h3>
<a href="#" class="btn">checkout cart</a>

</div>

    <!-- Mbarimi i Shopping Cart -->

    
    <!-- Fillimi i seksionit te heading -->
    <section class="heading">
        <h3>Our Shop</h3>
        <p><a href="home.php">Home</a> / <span>Shop</span></p>
    </section>
    <!-- Mbarimi i seksionit te heading -->


 <!-- Fillimi i seksionit te kategorive  -->

 <section class="category">
        <h1 class="title"> <span>Our Categories</span> <a href="#">View All >></a></h1>

        <div class="box-contanier">
            <a href="#" class="box">
                <img src="image/icon-1.png" alt="">
                <h3>House Sofa</h3>
            </a>

            <a href="#" class="box">
                <img src="image/icon-2.png" alt="">
                <h3>Working Table</h3>
            </a>

            <a href="#" class="box">
                <img src="image/icon-3.png" alt="">
                <h3>Corner Table</h3>
            </a>

            <a href="#" class="box">
                <img src="image/icon-4.png" alt="">
                <h3>Office Chair</h3>
            </a>

            <a href="#" class="box">
                <img src="image/icon-5.png" alt="">
                <h3>New Wardrobe</h3>
            </a>
        </div>
    </section>

    <!-- Mbarimi i seksionit te kategorive  -->

    <!-- Fillimi i seksionit te Produkteve -->
    <section class="products">
        <h1 class="title"><span>Our Products</span> <a href="#">View All >></a></h1>

        <div class="box-contanier">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="box">
                        <div class="icons">
                            <a href="" class="ri-shopping-cart-line" name="BuyNow"></a>
                            <a href="#" class="ri-heart-line"></a>
                            <a href="#" class="ri-eye-line"></a>
                        </div>
                        <div class="image">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="">
                        </div>
                        <div class="content">
                            <div class="price"><?php echo htmlspecialchars($product['price']); ?>€</div>
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span> (50) </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products available at the moment.</p>
            <?php endif; ?>
        </div>
    </section>
    <!-- Mbarimi i seksionit te Produkteve -->

    <!-- Fillimi i seksionit te footer -->

    <footer>
        <div class="newsletter">
            <div class="newsletter-form">
                <h3><i class="ri-mail-line"></i><span>Subscribe To Newsletter</span></h3>
                <div>
                    <form action="#">
                        <input type="text" id="name" name="name" placeholder="Enter Your Name">
                        <input type="email" id="email" name="email" placeholder="Enter Your Email">
                        <button><i class="ri-send-plane-line"></i></button>
                    </form>
                </div>
            </div>
            <div class="newsletter-img">
                <img src="image/sofa.png" alt="">
            </div>
        </div>
        <div class="footer-main">
            <h3>Furnitia</h3>
            <div class="footer-lists">
                <div class="footer-main-info">
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                    </p>
                    <div class="footer-icons">
                        <i class="ri-facebook-line"></i>
                        <i class="ri-instagram-line"></i>
                        <i class="ri-twitter-line"></i>
                        <i class="ri-linkedin-box-line"></i>
                    </div>
                </div>
                <div class="links">
                    <div class="links1">
                        <ul>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="team.php">Team</a></li>
                            <li><a href="blog.php">Blog</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                    <div class="links2">
                        <ul>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Knowledge Base</a></li>
                            <li><a href="#">Live Chat</a></li>
                        </ul>
                    </div>
                    <div class="links3">
                        <ul>
                            <li><a href="#">Jobs</a></li>
                            <li><a href="#">Our Team</a></li>
                            <li><a href="#">Leadership</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="links4">
                        <ul>
                            <li><a href="#">Nordic Chair</a></li>
                            <li><a href="#">Kruzo Aero</a></li>
                            <li><a href="#">Ergonomic Chair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>
                Copyright ©2024. All Rights Reserved. Meris Gashi, Leonis Vorfaj.
            </p>
            <div>
                <a href="#" class="a1">Terms & Conditions</a>
                <a href="#" class="a2">Privacy & Policy</a>
            </div>
        </div>
    </footer>

    <!-- Mbarimi i seksionit te footer  -->


    <script src="js/shop.js"></script>
    
</body>
</html>