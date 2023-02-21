<?php
$title = "Talaba qo'shish";
require "./includes/header.php";
require "./database.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $firstName=$_POST["firstName"];
    $lastName=$_POST["lastName"];
    $date_of_birth=$_POST['date_of_birth'];
    $statement = $pdo -> prepare("INSERT INTO crud (ism,familya,date_of_birth) VALUES (:ism,:familya,:date_of_birth)");
    $statement ->execute([
        "ism"=>$firstName,
        "familya"=>$lastName,
        "date_of_birth"=>$date_of_birth,
    ]);
    $_SESSION['addUser'] = 'Foydalanuvchi qo\'shildi';

    header("location: index.php");
    exit;
}

?>

<div class="container">
    <div class="pt-5 mt-5">
        <div class="card shadow-lg rounded p-5  w-75 mx-auto mt-5">
            <form action="" method="POST">
                <label for="exampleFormControlInput1" class="form-label w-50 mx-auto d-block ps-3">Talaba ismini kiriting: </label>
                <input type="text" required class="form-control mb-4 w-50 mx-auto" name="firstName">
                <label for="exampleFormControlInput1" class="form-label w-50 mx-auto d-block ps-3">Talaba familyasini kiriting: </label>
                <input type="text" required class="form-control mb-4 mb-4 w-50 mx-auto" name="lastName">
                <label for="exampleFormControlInput1" class="form-label w-50 mx-auto d-block ps-3">Talabaning tug'ilgan sanasini kiriting: </label>
                <input type="text" required class="form-control mb-4 mb-4 w-50 mx-auto" name="date_of_birth" placeholder="2022-02-02">
                <button class="btn btn-success text-uppercase w-25 d-block mx-auto" type="submit">Qo'shish</button>
            </form>
            </div>
    </div>
</div>

<?php
require "./includes/footer.php";
?>