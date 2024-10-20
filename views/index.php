<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../model/fetchModle.php';
require_once '../controller/usercontroller.php';
$usercontroller = new usercontroller();
$fetchModle = new fetchModle();
$conn = $usercontroller->getConn();
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    $result = mysqli_query($conn, " SELECT p.*, u.* FROM permissions p JOIN users u ON p.user_id = u.id WHERE p.guest = '1' ");
    $row = mysqli_fetch_assoc($result);
    $_SESSION["login"] = true;
    $_SESSION["id"] = $row["id"];
} else if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login");
}

// if (!empty($_SESSION['products']) && $row['guest'] == 1) {
//   header("Location: login");
// }

if ($row["deactivated"] == 1) {
    header("Location: deactivated");
}

include "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egypt Tourism</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        <?php include "../public/css/index.css" ?>
    </style>

</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://egymonuments.gov.eg/Style%20Library/images/new-logo_web.png" alt="Egypt Tourism"
                    height="40" style="font-size: 200px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Where to go
                        </a>
                        <ul class="dropdown-menu dropdown-menu-large" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <h6 class="dropdown-header fs-5 fw-bold">Choose your destination</h6>
                                <p class="ms-2 text-muted">Sea, mountains, cities and national parks: in Egypt every
                                    destination is a unique experience to be fully enjoyed.</p>
                            </li>
                            <div class="d-flex column-dropdown">
                                <div class="list-section">
                                    <h6 class="dropdown-header">Cities</h6>
                                    <a class="dropdown-item" href="#">Cairo</a>
                                    <a class="dropdown-item" href="#">Alexandria</a>
                                    <a class="dropdown-item" href="#">Luxor</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="list-section">
                                    <h6 class="dropdown-header">Regions</h6>
                                    <a class="dropdown-item" href="#">Nile Delta</a>
                                    <a class="dropdown-item" href="#">Sinai Peninsula</a>
                                    <a class="dropdown-item" href="#">Red Sea Coast</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="list-section">
                                    <h6 class="dropdown-header">Tourist Destinations</h6>
                                    <a class="dropdown-item" href="#">Pyramids of Giza</a>
                                    <a class="dropdown-item" href="#">Karnak Temple</a>
                                    <a class="dropdown-item" href="#">Valley of the Kings</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="container my-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <img src="https://images.memphistours.com/large/528001641d46401fd0294117d7849411.jpg"
                                                    class="card-img-top" alt="Villages">
                                                <div class="card-body text-center">
                                                    <p class="card-text">Mountains</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <img src="https://lp-cms-production.imgix.net/2019-06/GettyImages-465987354_high.jpg?auto=format&w=1920&h=640&fit=crop&crop=faces,edges&q=75"
                                                    class="card-img-top" alt="UNESCO sites">
                                                <div class="card-body text-center">
                                                    <p class="card-text">National parks</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">What to do</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Plan your trip</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Information</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-search"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-heart"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" id="navbarDropdownSignIn" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSignIn">
                            <div class="list-section">
                                <h6 class="dropdown-header">Profile</h6>
                                <?php if (isset($row) && isset($row["guest"]) && $row["guest"] != 1) { ?>

                                    <li><a class="dropdown-item" href="profilesettings">profile settings </a></li>
                                    <?php if ($row["admin"] == 1) {
                                        echo ' <li><a class="dropdown-item" href="admindashboard">Admin dashboard </a></li> ';
                                    } ?>
                                    <li><a class="dropdown-item" href="logout">Log out </a></li>
                                <?php } else if ($row["guest"] == 1) {
                                    echo ' <li><a class="dropdown-item" href="login">Log in </a></li> ';
                                    echo ' <li><a class="dropdown-item" href="signup">Register  </a></li> ';
                                }
                                ?>
                            </div>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->



    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <video id="myVideo" width="100%" autoplay loop muted>
                    <source src="../public/photos/y2mate.is - This is Egypt-mfxQy5A_tHs-720p-1714078248.mp4" type="video/mp4">
                </video>
            </div>


            <div class="carousel-item">
                <img src="../public/photos/slider4.jpg" class="d-block custom-size mx-auto" alt="Egypt" width="100%">
                <div class="carousel-caption1">

                </div>
            </div>
            <div class="carousel-item">
                <img src="../public/photos/fayez roster.jpeg" class="d-block w-100" alt="..." width="100%">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container-simple-text with-background-image" style="background-image: url('https://tourismmedia.italia.it/is/image/mitur/landscape_1-100-1?wid=2880&amp;hei=1280&amp;fit=constrain,1&amp;fmt=webp'); background-size: cover; height: 300px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="container-simple-text__container-text container-simple-text__container-text--desktop-center container-simple-text__container-text--mobile-center text-center">
                        <div class="container-simple-text__container-text__fs-28-38">
                            <h2 class="container-simple-text__title mb-0" style="margin-top: 100px; color: #13315C;">
                                Landscapes that will take your breath away, rich <br> history, and delicious food, your
                                trip to Egypt will be <br>nothing short of unforgettable.
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="featured-destinations py-5">
        <div class="container">
            <h6 class="text-center mb-4" style="font-weight: normal;">BOOK NOW</h6>
            <h1 class="text-center mb-4" style="color:#13315C; font-family: Georgia, 'Times New Roman', Times, serif;">
                NEW EL ALAMEIN CITY</h1>
            <div class="row">
                <div class="position-relative text-center" style="height : 300;">
                    <a href="#" id="centered-anchor" class="d-block" style="height : 300;">
                        <img src="https://cityedgedevelopments.com/uploads/destinations/destination_4/cover_image03e4e8bd-0f1d-4a40-8dbe-fc350a64da36.jpg" alt="Clickable Image" class="img-fluid mx-auto" height="300px">
                        <button class="btn mitur btn-lg position-absolute bottom-0 start-50 translate-middle-x rounded-pill" style="bottom: -20px; background-color: #0B2545; color: white; margin-bottom: -60PX;" id="shopnow">
                            BOOK NOW
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Trips -->

    <div class="viewproduct" style="margin-top: 350px;">
        <div class="row">
            <div class="col-md text-center" style="margin-top: 100px;">
                <h6 class="text-center mb-4" style="font-weight: normal;">EVENTS</h6>
                <h1>Top Hotels to Visit in Egypt</h1>
            </div>
        </div>

        <div class="container products-carousel">
            <div class="row">
                <div class="slider">
                    <?php

                    $result = $fetchModle->allhotels();

                    if (mysqli_num_rows($result) > 0) {
                        $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    }
                    ?>

                    <?php if (!empty($hotels)) : ?>
                        <?php foreach ($hotels as $hotel) : ?>
                            <div class="col-md-3">
                                <a href="hotel-details?id=<?php echo $hotel['ID']; ?>">
                                    <div class="products">
                                        <div class="product-image">
                                            <a href="hotel-details?id=<?php echo $hotel['ID']; ?>" class="images">
                                                <img src="<?php echo $hotel['photo']; ?>" alt="<?php echo $hotel['name']; ?>" class="pic-1" width="500px">
                                                <img src="<?php echo $hotel['photo']; ?>" alt="<?php echo $hotel['name']; ?>" class="pic-2" width="500px">
                                            </a>
                                            <div class="links">
                                                <div class="Icon">
                                                    <a href="#" class="add-to-cart" data-id="<?php echo $hotel['ID']; ?>" data-name="<?php echo $hotel['name']; ?>" data-price="<?php echo $hotel['price']; ?>" data-image="<?php echo $hotel['photo']; ?>"><i class="bi bi-cart3"></i></a>
                                                    <span class="tooltiptext">Add to cart</span>
                                                </div>
                                                <div class="Icon">
                                                    <a href="#"><i class="bi bi-heart"></i></a>
                                                    <span class="tooltiptext">Move to wishlist</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a style="text-decoration: none;" href="hotel-details?id=<?php echo $hotel['ID']; ?>">
                                            <div class="Content">
                                                <h3 style="color: #000;"><?php echo $hotel['name']; ?></h3>
                                                <p class="detailsinfo">
                                                    <span class="typetrip"><?php echo $hotel['location']; ?></span> <span class="separate"></span> <span class="nofdays">Egypt</span>
                                                </p>
                                                <div class="cost">
                                                    <p class="lower-price">
                                                        From <span class="price"><?php echo number_format($hotel['price'], 2) . ' LE'; ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No products found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- map -->
    <div>
        <section class="featured-destinations py-5">
            <div class="container">
                <h6 class="text-center mb-4" style="font-weight: normal;">EGYPT</h6>
                <h1 class="text-center mb-4">Discover Egypt</h1>
                <div class="row">
                    <div id="map">
                        <iframe src="map.php" frameborder="0" width="100%" height="700px"></iframe>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="row">
        <div class="col-md text-center">
            <h6 class="text-center mb-4" style="font-weight: normal;">Products</h6>
            <h1>Our Organic Products</h1>
        </div>
       
    </div>
    <div class="container products-carousel" style="margin-top: 5px;">
        <div class="row">
            <div class="slider">

                <?php
                $result = $fetchModle->allflights();
                if (mysqli_num_rows($result) > 0) {
                    $flights = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($flights as $flight) : ?>
                        <div class="col-md-4">
                            <div class="flight-card">
                                <div class="Content">
                                    <h3 class="product-title"><?php echo htmlspecialchars($flight['flight_dep']); ?> to <?php echo htmlspecialchars($flight['flight_arr']); ?></h3>
                                    <p class="detailsinfo">
                                        Depart: <?php echo htmlspecialchars($flight['dept_time']); ?>
                                        <span class="arrow"><i class='bx bx-transfer-alt'></i></span>
                                        Arrive: <?php echo htmlspecialchars($flight['arr_time']); ?>
                                    </p>
                                    <p class="price">Economy: <?php echo number_format($flight['eco_price'], 2) . ' EGP'; ?><br>
                                        Business: <?php echo number_format($flight['bus_price'], 2) . ' EGP'; ?></p>
                                    <div class="links">
                                        <a href="#" class="btn btn-primary btn-book-now">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach;
                } else {
                    echo '<p>No flights found.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- social wall -->
    <div class="social-wall-section" style="margin-bottom: 100px;">
        <h5>SOCIAL WALL</h5>
        <h1>Egypt seen by you</h1>
        <p>Join the <a href="https://www.instagram.com/thisisegypt/" target="_blank">#Thisisegypt</a> community and post
            your experiences</p>
        <button class="btn btn-primary">Find out more</button>
    </div>

    <!-- stay with us -->
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="height: 400px; width: 750px; margin-left: -100px;">
                <img src="../public/photos/slider1.jpg" class="custom-img img-fluid" alt="Your Image">
            </div>
            <div class="col-md-6">
                <div class="image-container position-relative text-center">
                    <div class="background-image" style="background-image: url('https://tourismmedia.italia.it/is/image/mitur/landscape_1-100-1?wid=2880&amp;hei=1280&amp;fit=constrain,1&amp;fmt=webp'); height: 435px; width: 900px;">
                        <div class="overlay d-flex flex-column justify-content-center align-items-center">
                            <div class="quote mt-2 text-center align-items-center " style="margin-left: 30px;">
                                <h4 class="custom-about-us">STAY WITH US</h4>
                                <p class="custom-quote">Continue living like an Egyptian</p>
                                <h5 class="custom-caption">Subscribe to the Newsletter so as not to miss places,
                                    events and experiences for experiencing the best side of Egypt: the authentic one.
                                </h5>
                            </div>
                            <!-- newsettler Form -->
                            <form id="ContactFooter" class="footer-form">
                                <div class="d-flex">
                                    <div class="form-floating me-2">
                                        <input type="email" name="email" class="form-control border-0" id="email" placeholder=" " style="background:#F0F0F0		; color: #000;">
                                        <label for="email">Enter your email address</label>
                                    </div>
                                    <button type="button" id="submitMailButton" class="btn-About-us btn-dark">Sign
                                        Up</button>
                                </div>
                                <div id="message"></div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


<script>
    <?php include "../public/js/index.js" ?>
    <?php include "../public/js/ajaxHandlers.js" ?>
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cartButtons = document.querySelectorAll(".add-to-cart");

        cartButtons.forEach(button => {
            button.addEventListener("click", function(e) {
                e.preventDefault();
                const id = this.getAttribute("data-id");
                const name = this.getAttribute("data-name");
                const price = this.getAttribute("data-price");
                const image = this.getAttribute("data-image");

                fetch("add_to_cart.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            id,
                            name,
                            price,
                            image
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // alert("Added to cart!");
                        } else {
                            // alert("Failed to add to cart.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    });
</script>

</html>