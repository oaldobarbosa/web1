<?php
    function __autoload($class_name){
        require_once $class_name.'.php';
    }
    //require_once 'Alunos.php';
?>

<!DOCTYPE html>
    <head>
        <title>phpOO - tos - WEB I</title>   
    </head>

    <body>
    
                  <!-- Form cadastrar -->
            
                <?php

                    $aluno = new Alunos();
                    
                    // Cadastro de aluno
                    if ( isset($_POST['cadastrar']) ):
                        
                        $nome  = $_POST['nome'];
                        $endereco = $_POST['endereco'];
                        
                        $aluno->setNome($nome);
                        $aluno->setEndereco($endereco);

                        //chamar metodo insert                        
                        if ($aluno->insert()) {
                        
                            echo $aluno->nome . " de " . $aluno->endereco . " incluido com sucesso!!!";
                            //echo "<script type='text/javascript'>alert('Incluído com Sucesso!!!')</script>";

                        
                        } else {
                            echo "Erro ao Incluir";
                        }
                    endif;

                ?>

                <?php

                    //exclusao de aluno
                    if (isset($_POST['excluir'])){ 
                                
                        $id = $_POST['id'];

                        $id = (int)$_POST['id'];

                        $resultado = $aluno->findUnit($id);

                        if ($aluno->delete($id)) {

                            echo $resultado->nome. " excluido com sucesso";
                            //echo "<script type='text/javascript'>alert('Excluido com Sucesso!!!')</script>";
                        } else{
                            echo "Erro ao Excluir";
                        }
                            
                    } 

                ?>

                <?php 
                    //update aluno
                    if (isset($_POST['editar-confirm'])) {

                        $id = (int)$_POST['id'];
                        $nome = $_POST['nome'];
                        $endereco = $_POST['endereco'];

                        $aluno->setNome($nome);
                        $aluno->setEndereco($endereco);

                        if ($aluno->update($id)) {
                            echo "Os dados de " . $aluno->nome ." foram atualizado com Sucesso";
                            //echo "<script type='text/javascript'>alert('Atualizado com Sucesso!!!')</script>";
                        } else{
                            echo "Erro ao Atualizar";
                        }
                    }

                ?>

                <legend><h1>Formulário Cadastrar</h1></legend>
                <hr>

                <?php
                    //atulizar aluno
                    if (isset($_POST['editar'])){ 

                        $id = (int)$_POST['id'];
                        //var_dump($id);//recebendo o id via post
                        $resultado = $aluno->findUnit($id);//

                ?>
                    <form class="form-inline" method="post">

                        <label>Nome: </label>            
                        <input name="nome" type="text" value="<?php echo $resultado->nome;?>" required="">
                        <label>Endereco: </label>      
                        <input name="endereco" type="endereco" value="<?php echo $resultado->endereco;?>" required="" >
                        <input name="id" type="hidden" value="<?php echo $id;?>"/>
                        <input name="editar-confirm" type="submit" class="btn btn-success" value="confirrmar edição">
                    </form>

                <?php
                    } else {;
                ?> 
                                
                <form class="form-inline" method="post">
                        <label>Nome: </label>            
                        <input name="nome" type="text" required="">
                        <label>Endereco: </label>      
                        <input name="endereco" type="endereco" required="">
                  
                    <input name="cadastrar" type="submit" class="btn btn-success" value="Cadastrar">
                </form>

                <?php 
                    } 
                ?>

            </div>
            <!-- Fim form cadastrar -->

        </div> <!-- fim cantainer -->

       <!-- Inicio da tabela -->
            <table  border="1px">
                <thead>
                    <tr >
                        <th>Nome</th>
                        <th>endereco</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                    <?php foreach ($aluno->findAll() as $key => $value): ?>
                    <tbody>
                    <tr>
                        <td> <?php echo $value->nome;?> </td>
                        <td> <?php echo $value->endereco;?> </td>
                        <td>
                            <form class="form_acao" method="post">
                                <input name="id" type="hidden" value="<?php echo $value->id;?>"/>
                                <button name="excluir" type="submit" >Excluir</button>
                                <button name="editar" type="submit"  >Editar</button>
                            </form>
                        </td>
                    </tr>
                    
                    <?php endforeach; ?>

                </tbody>
            </table>
            <!-- Fim da tabela -->
            </div> <!-- fim container -->
    </body>
</html>
