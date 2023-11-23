<?php
    include 'partials/header.php';

    // fetch current user's information from database
    
    if(isset($_SESSION['user-id'])) {
        $current_user_id = $_SESSION['user-id'];
        $query = "SELECT * FROM users WHERE id = $current_user_id";
        $result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result);
    } else {
        header('location: ' . ROOT_URL);
        die();
    }
?>


<section class="form__section">
    <div class="container form__section-container">
        <h2>Editar perfil</h2>
        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" value="<?= $user['id'] ?>" name="id">
            <input type="hidden" name="previous_avatar_name" value="<?= $user['avatar'] ?>">
            <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="Primeiro nome">
            <input type="text" value="<?= $user['lastname'] ?>" name="lastname" placeholder="Sobrenome">
            <div class="form__control">
                <label for="avatar">Mudar Avatar</label>
                <img src="../images/<?= $user['avatar'] ?>">
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Atualizar perfil</button>
        </form>
    </div>
</section>



<?php
    include '../partials/footer.php';
?>