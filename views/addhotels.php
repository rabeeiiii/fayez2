<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../controller/AdminFunctions.php';
$AdminFunctions = new AdminFunctions();

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $conn = $AdminFunctions->getConn();
    $result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login");
}

if ($row["admin"] != 1) {
    header("Location: index");

}

if ($row["guest"] == 1) {
    header("Location: login");

}

if (isset($_POST["addhotel"])) {
    $AdminFunctions->addhotel();
}
$dbh = new Dbh();
$sql = "SELECT * FROM cities";
$result = mysqli_query($conn, $sql);
$cities = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cities[] = $row['city_name'];
    }
}
include "adminnav.php";


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <title>Admin panel</title>
    <style>
        <?php include "../public/CSS/adminDasboard.css" ?>
    </style>

</head>


<div class="container">



    <!-- Add product  -->
    <div class="main" id="addproduct">
        <div class="formcards">
            <div class="formcard">
                <div class="card-content form-container">

                    <h1>ADD HOTEL</h1>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock">Select a Governorate:</label>
                            <select class="form-control" name="governorate" required>
                            <option value="" disabled selected> </option>
                            <?php
                                foreach ($cities as $city) {
                                    echo "<option value='" . $city . "'>" . $city . "</option>";
                                }?>
                            </select>  


                        </div>



                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" required>
                        </div>
                     
                        <div class="mb-3">
                            <label class="form-label">duration in nights</label>
                            <input type="text" class="form-control" name="duration" required>
                        </div>
                     
                        <div class="mb-3">
                            <label for="newProductImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="newProductImage"
                                accept="image/png, image/gif, image/jpeg , image/webp" name="file" required>
                        </div>
                    
                        <div class="mb-3">
                            <input type="submit" name="addhotel" value="ADD Hotel"
                                style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>