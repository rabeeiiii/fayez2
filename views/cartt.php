<?php
session_start();
require '../includes/config.php';
require '../includes/Dbh.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="../public/css/cart.css">
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>

    <div class="cart-wrap">
        <div class="container">
            <h1>My Cart</h1>
            <?php if (!empty($_SESSION['flights'])): ?>
                <div class="cart-items">
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION['flights'] as $flight): ?>
                        <?php $total += $flight['price']; ?>
                        <div class="cart-item">
                            <p><strong>Flight:</strong> <?php echo $flight['dep'] . ' to ' . $flight['arr']; ?></p>
                            <p><strong>Price:</strong> <?php echo number_format($flight['price'], 0, '', ',') . " EGP"; ?></p>
                            <a href="cartt.php?remove=<?php echo $flight['id']; ?>">Remove</a>
                        </div>
                    <?php endforeach; ?>
                    <h3>Total: <?php echo number_format($total, 0, '', ',') . " EGP"; ?></h3>
                    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                </div>
            <?php else: ?>
                <p>Your cart is empty.</p>
                <a href="flights.php" class="btn btn-primary">Discover More Flights</a>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>
