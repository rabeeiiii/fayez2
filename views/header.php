<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fayez</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        <?php include "../public/css/index.css" ?>
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index">
                <img src="../public/photos/fayez logo.png" alt="Egypt Tourism" height="40" style="font-size: 200px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link dropdown" href="index" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products">
                            Products
                        </a>
               
                    <li class="nav-item">
                        <a class="nav-link" href="about us">
                            About Us
                        </a>
                      
                    <li class="nav-item">
                        <a class="nav-link" href="testimonial">Testimonial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact">Contact Us</a>
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="search-icon"><i class="bi bi-search"></i></a>
                        <input type="text" id="search-input" placeholder="Search Products..." onkeyup="liveSearch()">
                        <div id="searchResults"></div>
                    </li>

                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" id="navbarDropdownSignIn" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSignIn">
                            <div class="list-section">
                                <h6 class="dropdown-header">Profile</h6>
                                <?php if (isset($row) && isset($row["guest"]) && $row["guest"] != 1) { ?>

                                    <li><a class="dropdown-item" href="profilesettings">profile settings </a></li>
                                    <li><a class="dropdown-item" href="mybookings">my bookings </a></li>
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
    </nav>

<script>
    <?php include "../public/js/indexSearch.js" ?>
</script>
</body>