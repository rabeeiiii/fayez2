<?php


// Include necessary files
require '../includes/config.php';
require '../includes/Dbh.php';
require_once '../controller/usercontroller.php';
require_once '../model/fetchModle.php';

$usercontroller = new usercontroller();

// Check if user is logged in
$conn = $usercontroller->getConn();
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    // Redirect to login page if not logged in
    header("Location: login");
    exit;
}

// Fetch hotels from the database
$fetchModle = new fetchModle();
$result = $fetchModle->allhotels();
$hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch flights from the database
$dbh = new Dbh();
$result = $dbh->query("SELECT * FROM flights");
$flights = $result->fetch_all(MYSQLI_ASSOC);

// Handle form submission for selecting hotel and flight
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["select_hotel"])) {
        // Process hotel selection
        $_SESSION['selected_hotel'] = $_POST['hotel_id']; // Store selected hotel ID in session
    } elseif (isset($_POST["select_flight"])) {
        // Process flight selection
        $_SESSION['selected_flight'] = $_POST['flight_id']; // Store selected flight ID in session
    } elseif (isset($_POST["checkout"])) {
        // Proceed to checkout
        // Redirect to checkout page
        header("Location: checkout.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Your Trip</title>
    <!-- Include any necessary stylesheets -->
    <link rel="stylesheet" href="../public/css/trip.css">
</head>

<body>
    <header>
        <!-- Include header content -->
        <?php include "header.php"; ?>
    </header>

    <div class="hotel-container">
        <h1>Plan Your Trip</h1>

        <!-- Hotel selection form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Select a Hotel</h2>
            <select name="hotel_id">
                <?php foreach ($hotels as $hotel) : ?>
                    <option value="<?php echo $hotel['ID']; ?>"><?php echo $hotel['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="select_hotel">Select Hotel</button>
        </form>
    </div>

    <div class="flight-container">
        <!-- Flight selection form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Select a Flight</h2>
            <select name="flight_id">
                <?php foreach ($flights as $flight) : ?>
                    <option value="<?php echo $flight['id']; ?>"><?php echo $flight['flight_dep'] . ' to ' . $flight['flight_arr']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="select_flight">Select Flight</button>
        </form>
    </div>

    <!-- Checkout button -->
    <?php if (isset($_SESSION['selected_hotel']) && isset($_SESSION['selected_flight'])) : ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <button type="submit" name="checkout">Proceed to Checkout</button>
        </form>
    <?php endif; ?>

    <footer>
        <!-- Include footer content -->
        <?php include "footer.php"; ?>
    </footer>
</body>

</html>

