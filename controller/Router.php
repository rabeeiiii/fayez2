<?php
class Routere
{
    public static function handle($path = '/')
    {
        /*for just testing
        $currentMethod = $_SERVER['REQUEST_METHOD'];
        $currentUri = $_SERVER['REQUEST_URI'];
         echo $currentUri;*/

        $path = '/' . ltrim($path, '/');
        $root = '/fayez2/views/index';
        $id = null; // Initialize $id here

        if (strpos($path, '/fayez2/views/cart_display?remove=') !== false) {
            $pattern = '/\/fayez2\/views\/(cart_display(?:\?remove=)?)(\d*)/';
        } else {

            $pattern = '/\/fayez2\/views\/(deleteflight|edithotels|deletehotel|edituser|deleteuser|makeuser|makeadmin|hotel-details|editflight|deletetrip|edittrip|editbooking|deletebooking)\?id=(\d+)/';
        }
        if (preg_match($pattern, $path, $matches)) {
            // Extract the 'id' value from the matched URL
            $action = $matches[1];
            $id = $matches[2];

            // echo "id = " . $id;
        }
        //  echo $path;
        //  echo "id = " .$id;
        session_start();




        if ($path === $root) {
            require '../views/index.php';
            exit();
        } elseif ($path === '/fayez2/views/index') {
            require '../views/index.php';
            exit();
        } elseif ($path === '/fayez2/views/flights') {
            require '../views/flights.php';
            exit();
        }
        elseif ($path === '/fayez2/views/checkout') {
            require '../views/checkout.php';
            exit();
        }
        elseif ($path === '/fayez2/views/about%20us') {
            require '../views/about.php';
            exit();
        }
        elseif ($path === '/fayez2/views/cart') {
            require '../views/cart.php';
            exit();
        }
        elseif ($path === '/fayez2/views/mybookings') {
            require '../views/mybookings.php';
            exit();
        }
        elseif ($path === '/fayez2/views/login') {
            require '../views/login.php';
            exit();
        }
        elseif ($path === '/fayez2/views/bookings') {
            require '../views/bookings.php';
            exit();
        }
        elseif ($path === '/fayez2/views/addbooking') {
            require '../views/addbooking.php';
            exit();
        }
        elseif ($path === '/fayez2/views/signup') {
            require '../views/signup.php';
            exit();
        }
        elseif ($path === '/fayez2/views/forgetpassword') {
            require '../views/forgetpassword.php';
            exit();
        }
        elseif ($path === '/fayez2/views/otp') {
            require '../views/otp.php';
            exit();
        } elseif ($path === '/fayez2/views/resetpassword') {
            require '../views/resetpassword.php';
            exit();
        }
        elseif ($path === '/fayez2/views/logout') {
            require '../views/logout.php';
            exit();
        }
        elseif ($path === '/fayez2/views/profilesettings') {
            require '../views/profilesettings.php';
            exit();
        }
        elseif ($path === '/fayez2/views/hotels') {
            require '../views/hotels.php';
            exit();
        }
        elseif ($path === '/fayez2/views/trips') {
            require '../views/trips.php';
            exit();
        }
        elseif ($path === '/fayez2/views/users') {
            require '../views/users.php';
            exit();
        }
        elseif ($path === '/fayez2/views/admindashboard') {
            require '../views/admindashboard.php';
            exit();
        }
        elseif ($path === '/fayez2/views/admintrips') {
            require '../views/admintrips.php';
            exit();
        }
        elseif ($path === '/fayez2/views/adduser') {
            require '../views/adduser.php';
            exit();
        }
        elseif ($path === '/fayez2/views/adminflights') {
            require '../views/adminflights.php';
            exit();
        }
        elseif ($path === '/fayez2/views/adminhotels') {
            require '../views/adminhotels.php';
            exit();
        }   elseif ($path === '/fayez2/views/addhotels') {
            require '../views/addhotels.php';
            exit();
        }elseif ($path === '/fayez2/views/cart') {
            require '../views/cart.php';
            exit();
        }
        elseif ($path === '/fayez2/views/addflight') {
            require '../views/addflight.php';
            exit();
        }
        elseif ($path === '/fayez2/views/addtripbooking') {
            require '../views/addtripbooking.php';
            exit();
        }
        elseif ($path === '/fayez2/views/Adminphotos?id=' . $id) {
            require '../views/Adminphotos.php';
            exit();
        }
        elseif ($path === '/fayez2/views/hotel-details?id=' . $id) {
            require '../views/hotel-details.php';
            exit();
        } elseif ($path === '/fayez2/views/cart_display?remove=' . $id) {
            require '../views/cart_display.php';
            exit();
        }elseif ($path === '/fayez2/views/cancelorder?id=' . $id) {
            require '../views/cancelorder.php';
            exit();
        }elseif ($path === '/fayez2/views/editreview?id=' . $id) {
            require '../views/editreview.php';
            exit();
        }elseif ($path === '/fayez2/views/edittrip?id=' . $id) {
            require '../views/edittrip.php';
            exit();
        }elseif ($path === '/fayez2/views/deletetrip?id=' . $id) {
            require '../views/deletetrip.php';
            exit();
        }elseif ($path === '/fayez2/views/editbooking?id=' . $id) {
            require '../views/editbooking.php';
            exit();
        }elseif ($path === '/fayez2/views/deletebooking?id=' . $id) {
            require '../views/deletebooking.php';
            exit();
        } elseif ($path === '/fayez2/views/changepictures?id=' . $id) {
            require '../views/changepictures.php';
            exit();
        }  elseif ($path === '/fayez2/views/edithotels?id=' . $id) {
            require '../views/edithotels.php';
            exit();
        }  elseif ($path === '/fayez2/views/vieworder?id=' . $id) {
            require '../views/vieworder.php';
            exit();
        } elseif ($path === '/fayez2/views/editflight?id=' . $id) {
            require '../views/editflight.php';
            exit();
        } elseif ($path === '/fayez2/views/product?id=' . $id) {
            require '../views/product.php';
            exit();
        } elseif ($path === '/fayez2/views/deleteflight?id=' . $id) {
            require '../views/deleteflight.php';
            exit();
        }elseif ($path === '/fayez2/views/deletehotel?id=' . $id) {
            require '../views/deletehotel.php';
            exit();
        } elseif ($path === '/fayez2/views/edituser?id=' . $id) {
            require '../views/edituser.php';
            exit();
        } elseif ($path === '/fayez2/views/deleteuser?id=' . $id) {
            require '../views/deleteuser.php';
            exit();
        } elseif ($path === '/fayez2/views/makeuser?id=' . $id) {
            require '../views/makeuser.php';
            exit();
        } elseif ($path === '/fayez2/views/makeadmin?id=' . $id) {
            require '../views/makeadmin.php';
            exit();
        }
        else {

            require '../views/404.php';
            exit();
        }
    }
}
