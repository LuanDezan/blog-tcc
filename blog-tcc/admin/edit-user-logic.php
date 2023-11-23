<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
    // get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_avatar_name = filter_var($_POST['previous_avatar_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    // check for valid input
    if(!$firstname || !$lastname) {
        $_SESSION['edit-user'] = "Entrada de formulário inválida na página de edição.";
    } else {
        // delete existing avatar if new avatar is available
        if($avatar['name']) {
            $previous_avatar_path = '../images/' . $previous_avatar_name;
            if($previous_avatar_path) {
                unlink($previous_avatar_path);
            }

            // WORK ON NEW AVATAR
            // rename image
            $time = time(); // make each image name upload unique using current timestamp
            $avatar_name = $time . $avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination_path = '../images/' . $avatar_name;

            // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $avatar_name);
            $extension = end($extension);
            if(in_array($extension, $allowed_files)) {
                // make sure avatar is not too large (2mb+)
                if ($avatar['size'] < 2000000) {
                    // upload avatar
                    move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                } else {
                    $_SESSION['edit-user'] = "Não foi possível atualizar o usuário. O tamanho do avatar deve ser inferior a 2 MB";
                }
            } else {
                $_SESSION['edit-user'] = "Não foi possível atualizar o usuário. O avatar deve ser png, jpg ou jpeg";
            }
        }

        // set avatar name if a new one was uploaded, else keep old avatar
        $avatar_to_insert = $avatar_name ?? $previous_avatar_name;

        // update user
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', avatar='$avatar_to_insert', is_admin=$is_admin WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Falha ao atualizar o usuário.";
        } else {
            $_SESSION['edit-user-success'] = "Usuário $firstname $lastname atualizado com sucesso";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die(); 