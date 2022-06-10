<!DOCTYPE html>
<html lang="pt-BR" style="height: 100%;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>New User</title>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100%;" class="text-bg-dark">
    <?php 
        require_once "./includes/login.php";
        require_once "./includes/banco.php";
        require_once "./includes/funcoes.php";
    ?>


    <div id="body" style="border-radius: 27px 27px 7px 7px; background-color: white; color: black;" class="shadow-lg p-2 mb-5 bg-body">
        <?php 
            if(!is_admin()){
                msg_error_no_X("Você não é Administrador!");
            } else {
                if(!$_POST['user'] && !$_POST['username'] && !$_POST['password_1'] && !$_POST['password_2'] && !$_POST['type']){
                    require "./user-new-form.php";
                } else {
                    $user = $_POST['user'] ?? null;
                    $username = $_POST['username'] ?? null;
                    $passwd_1 = $_POST['password_1'] ?? null;
                    $passwd_2 = $_POST['password_2'] ?? null;
                    $type = $_POST['type'] ?? null;


                    if($passwd_1 === $passwd_2){
                        if(empty($user) || empty($username) || empty($passwd_1) || empty($passwd_2) || empty($type)){
                            msg_error_no_X("Todos os dados devem ser preenchidos!!");
                        } else{
                            $password = GenerateHash($passwd_1);

                            if($banco->query("INSERT INTO usuarios (usuario, nome, senha, tipo) VALUES ('$user', '$username', '$password', '$type')")){
                                header("Location: ./index.php");
                            } else{
                                msg_error_no_X("Erro ao cadastrar o usuário");
                            }
                        }

                    } else{
                        msg_error_no_X("Senhas não conferem!!");
                    }
                }
            }


            btn_back("ms-3 mb-4");
        ?>
    </div>




    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/fa113f9619.js" crossorigin="anonymous"></script>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>