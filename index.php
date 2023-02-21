<?php
$title="Talabalar ro'yxati";
require "./includes/header.php";
require "./database.php";

$statement = $pdo ->prepare("SELECT * FROM crud");
$statement -> execute();

$crud = $statement ->fetchAll();

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["DELETE"])){
    $id=$_POST["id"];
    $statement= $pdo ->prepare("DELETE FROM crud WHERE id=?");
    $statement->execute([
        $id
    ]);
    $_SESSION['deleteUser']="$id id raqamiga ega talaba ma'lumotlari o'chirildi";
    header("location: index.php");
    exit;
}   
?>

<header class="bg-success py-3">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="text-white text-uppercase ms-2">Talabalar ro'yxati</h1>
            <a href="./addUser.php" class="btn btn-primary py-2">Foydalanuvchi qo'shish</a>
        </div>
    </div>
</header>
<main class="mt-5">
    <div class="container">
    <!-- <?php if (isset($_SESSION["addUser"])) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $_SESSION["addUser"] ?>
                    <?php unset($_SESSION["addUser"]) ?>
                </div>
            <?php endif ?> -->
            <div class="w-75 mx-auto alert alert-<?php if($_SESSION['addUser']){echo "success";} 
             if($_SESSION['deleteUser']){echo "danger";}
             if($_SESSION['updateUser']){echo "primary";}
            ?>" role="alert">
                 <?php if($_SESSION["addUser"]){
                    echo $_SESSION["addUser"];
                    unset($_SESSION["addUser"]); 
                }  
                if($_SESSION["deleteUser"]){
                    echo $_SESSION["deleteUser"];
                    unset($_SESSION["deleteUser"]); 
                } 
                if($_SESSION["updateUser"]){
                    echo $_SESSION["updateUser"];
                    unset($_SESSION["updateUser"]); 
                } 
                 ?>
            </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-uppercase">
                            <th>ID</th>
                            <th>UserName</th>
                            <th>Date of birth</th>
                            <th>Created at</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($crud as $c): ?>
                            <tr>
                                <td><?= $c['id']; ?></td>
                                <td><?= $c["familya"] . " " . $c["ism"]; ?></td>
                                <td><?= $c['date_of_birth']; ?></td>
                                <td><?= $c['created_at']; ?></td>
                                <td><a href="./updateUser.php?id=<?= $c['id'] ?>" class="btn btn-warning">UPDATE</a></td>
                                <td>
                                    <form action="" method="POST" onSubmit="return confirm('Rostdan ham o\'chirmoqchisiz?')">
                                        <input type="hidden" name="DELETE">
                                        <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                        <button class="btn btn-danger" type="submit">DELETE</button>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; ?>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
require "./includes/footer.php";
?>