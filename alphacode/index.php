<?php
include "db_conn.php";



$errorMessage = "";

if(isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $profissao = $_POST['profissao'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];


    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $profissao = filter_input(INPUT_POST, "profissao", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    do {
        if(empty($nome) || empty($data_nascimento) || empty($email) || empty($profissao) || empty($telefone) || empty($celular)){
            $errorMessage = "Por favor preencha todos os campos!";
             break;
    
        } else {
            $sql = "INSERT INTO `contatos`(`id`, `nome`, `data_nascimento`, `email`, `profissao`, `telefone`, `celular`) VALUES (NULL,'$nome','$data_nascimento','$email','$profissao','$telefone','$celular')";
    
            $result = mysqli_query($conn, $sql);
    
            if($result) {
                header("Location: index.php?msg=Cadastro realizado com sucesso");
            }
            else {
                echo "Failed: " . mysqli_error($conn);
            }
        }
    } while (false);

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de contatos</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <header class="header">
        <img src="./assets/logo_alphacode.png" alt="Logo Alphacode">
        <h1 class="header__title">Cadastro de contatos</h1>
    </header>
    <main>
        
    <?php 
    if(isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        '.$msg.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    if (!empty($errorMessage) ) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
        ";
    }


    ?>



        <form action="" class="form" method="post" style="margin-top: 100px;">
            <fieldset>
                <div class="container text-center">
                    <div class="row row-cols-2">
                      <div class="col">
                          <div class="form__margin">
                              <label>Nome completo</label><br>
                              <input type="text" name="nome" placeholder="Ex: Letícia Pacheco dos Santos"><br>
                          </div>
                      </div> 
                          <div class="col">
                          <div class="form__margin">
                              <label>Data de nascimento</label><br>
                              <input type="text" name="data_nascimento" placeholder="Ex: yyyy/mm/dd"><br>
                          </div>
                      </div>
                          <div class="col">
                          <div class="form__margin">
                              <label>E-mail</label><br>
                              <input type="email" name="email" placeholder="Ex: leticia@gmail.com"><br>
                          </div>
                      </div>
                          <div class="col">
                          <div class="form__margin">
                              <label>Profissão</label><br>
                              <input type="text" name="profissao" placeholder="Ex: Desenvolvedora Web"><br>
                          </div>
                      </div>
                          <div class="col">
                          <div class="form__margin">
                              <label>Telefone para contato</label><br>
                              <input type="text" name="telefone" placeholder="Ex: (11) 4033-2019"><br>
                          </div>
                      </div>
                          <div class="col">
                          <div class="form__margin">
                              <label>Celular para contato</label><br>
                              <input type="text" name="celular" placeholder="Ex: (11) 98493-2039"><br>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="container text-center">
                    <div class="row row-cols-2">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Número de celular possui WhatsApp
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Enviar notificações por e-mail
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Enviar notificações por SMS
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-margin">
                        <button class="btn btn-primary" type="submit" name="submit" >Cadastrar contato</button>
                </div>
            </fieldset>  
         </form>
    </main>

    

    <hr>
    <div class="table-margin">
        <table class="content-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data de nascimento</th>
                    <th>E-mail</th> 
                    <th>Profissao</th>
                    <th>Telefone para contato</th>
                    <th>Celular para contato</th>
                    <th>Ações</th>      
                </tr>
            </thead>
            <tbody>
                <?php 
                include "db_conn.php";
                    $sql = "SELECT * FROM `contatos`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            
                            <td><?php echo $row['nome'] ?></td>
                            <td><?php echo $row['data_nascimento'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['profissao'] ?></td>
                            <td><?php echo $row['telefone'] ?></td>
                            <td><?php echo $row['celular'] ?></td>
                            <td>
                            <a href="./editar.php?id=<?php echo $row['id'] ?>">
                                <button type="button-editar"> <img src="./assets/editar.png"  /></button>
                            </a>
                            <a href="./excluir.php?id=<?php echo $row['id'] ?>">
                                <button type="button-excluir"> <img src="./assets/excluir.png"  /></button>
                            </a>
                            </td>
                        </tr>
                        <?php
                        
                    }

                    ?>
               
            </tbody>
        </table>
    </div>
    <footer>
        <p class="footer__text">Termos | Políticas</p>
        <div class="footer__midle">
            <p>© Copyright 2022 | Desenvolvido por</p> <img class="imgfooter" src="./assets/logo_rodape_alphacode.png" alt="Logo Alphacode">
        </div>
        <p class="footer__text">©Alphacode IT Solutions 2022</p>
    </footer>
</body>
</html>