<?php
$title="Talaba Ma'lumotlarini o'zgartirish";
require "./includes/header.php";
require "./database.php";

$id=$_GET["id"];
$statement= $pdo ->prepare("SELECT * FROM crud WHERE id=?");
$statement->execute([
    $id
]);
$user=$statement->fetch();

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["PUT"])){
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $data_of_birth=$_POST['date_of_birth'];
    $statement= $pdo -> prepare("UPDATE crud SET ism=:ism,familya=:familya,date_of_birth=:date_of_birth WHERE id=:id");
    $statement->execute([
        "ism" => $firstName,
        "familya" => $lastName,
        "date_of_birth" => $data_of_birth,
        "id"=>$id
    ]);
    $_SESSION["updateUser"]="$id-id ga ega talaba ma'lumotlari o'zgartirili";
    header("Location:index.php");
    exit;
}
?>

<div class="container">
    <div class="pt-5 mt-5">
        <div class="card shadow-lg rounded p-5  w-75 mx-auto mt-5">
            <form action="" method="POST">
                <input type="hidden" name="PUT">
                <label for="exampleFormControlInput1" class="form-label w-50 mx-auto d-block ps-3">Talaba ismini kiriting: </label>
                <input type="text" required class="form-control mb-4 w-50 mx-auto" name="firstName" value="<?= $user['ism'] ?>">
                <label for="exampleFormControlInput1" class="form-label w-50 mx-auto d-block ps-3">Talaba familyasini kiriting: </label>
                <input type="text" required class="form-control mb-4 mb-4 w-50 mx-auto" name="lastName" value="<?= $user['familya'] ?>">
                <label for="exampleFormControlInput1" class="form-label w-50 mx-auto d-block ps-3">Talabaning tug'ilgan sanasini kiriting: </label>
                <input type="text" required class="form-control mb-4 mb-4 w-50 mx-auto" name="date_of_birth" value="<?= $user['date_of_birth'] ?>" placeholder="2022-02-02">
                <button class="btn btn-success text-uppercase w-25 d-block mx-auto" type="submit">Qo'shish</button>
            </form>
            </div>
    </div>
</div>

<?php 
require "./includes/footer.php";
?>