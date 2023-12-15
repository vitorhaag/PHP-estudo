<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>atividade</title>
     <style>
        *{
            /* margin: 0; */
            box-sizing: border-box;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
    /* form{
            padding: 8px;
            margin: 27px 4px;
            max-width: 20px;
            max-height: 30px; */
            /* width: 0px; */
            /* height: 35px; */
        /* } */
    input{
        width: 100%;
        background-color: #fdcece4d;
        /* box-shadow: 3px 1px 0px 0px; */
        margin: 8px 0px;
        padding: 4px 4px;
        /* text-align: center; */
        /* display: flex; */
        /* flex-direction: row; */
        border: 0.5px solid black;
        border-radius: 4px;
        }
    button{
            color: white;
            background-color: green;
            width: 14vw;
            margin-left: 10px;
            margin-top: 7px;
            margin-bottom: 20px;
            border-radius: 11px;
            height: 29px;
            box-shadow: 1px 1px 6px -2px black;
        }
        .formulario{
            background-color: #a5a1a13b;
            width: 299px;
            border-radius: 10px;
            margin: 22px;
            padding: 12px;
            
        }
        td{
            border: 3px solid #065d0cd9;
            padding: 7px 5px;
            text-align: center;
        }
        table{
            border-collapse: collapse;
            /* border-spacing: 10px; */
            margin-left: 14px;
            /* max-width: 200px; */
            
            /* border-radius: 1110px; */
        }
        /* td#interativo{
            width: 20px;
     
            height: 30px; */
       thead{
        border: 4px #b2db15;
        border-style: solid;
        /* border-collapse: collapse; */
        border-radius: 4px;
             
    }  
    td:last-child, th:last-child{
        padding-right: 20px ;
        padding-left: 20px;
        
    }       

    th{
        border: 1px #b2db15 solid;
    padding: 9px;
    background: darkseagreen;
    }
         
        
       


    </style>
</head>
<body>

    <div class="formulario">
        <form>
            Nome: <input name="nome">
        <br>
        
            Clube: <input name="clube">
        <br>
        
            Posição <input name="posicao">
        <br>
        <button>Cadastrar</button>
        </form>
    </div>
    


    <?php 
    // session_start();
    function conectar(){
    $host = "localhost";
    $porta = 3306;
    $banco = "atividades";
    $usuario = "root";
    $senha = "";

    return $conex = new PDO("mysql:host=$host;porta=$porta;dbname=$banco", $usuario, $senha);
    }

    function select(){
    $sql = "SELECT * FROM futebol";
    $conex = conectar();
    $consulta = $conex->prepare($sql);
    $consulta->execute();
    
    return $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
}
    function insert(){
        $nome = $_GET['nome'];
        $clube = $_GET['clube'];
        $posi = $_GET['posicao'];
    $sql = "INSERT INTO futebol (nome,clube,posicao) VALUES (:nome,:clube,:posicao)";
    $conex = conectar();
    $consulta = $conex->prepare($sql);
    $consulta->bindParam(':nome', $nome);
    $consulta->bindParam(':clube', $clube);
    $consulta->bindParam(':posicao', $posi);
    $consulta->execute();
    }

    
//    function insert(){
    if(isset($_GET['nome'])){
        insert();
    }    

    
    function deletar() {
     $id = $_GET['id'];

  $sql = 'DELETE FROM futebol WHERE id = :id';
  $conex = conectar();
  $consulta = $conex->prepare($sql);
  $consulta->bindParam(':id', $id);
  $consulta->execute();
 }






    if(isset($_GET['acao'])){
        deletar();
    }
            
    

    
    echo '<table><thead><tr><th>ID</th><th>Nome</th><th>Clube</th><th>Posição</th><th>remover</th></tr></thead>';
    foreach(select() as $cadastro){
        $id = $cadastro['id'];
        $nome = $cadastro['nome'];
        $clube = $cadastro['clube'];
        $posi = $cadastro['posicao'];
        ?>
        <tr>
            <td><?=$id?></td>
            <td><?=$nome?></td>
            <td><?=$clube?></td>
            <td><?=$posi?></td>
            <td id="interativo"><a href=atividade-aula2.php?acao=remover&id=<?=$id?>>remover</a></td>
        </tr>
        <?php 
    }
      echo ' </table>';

    ?>
    
    
    
    
    
</body>
</html>