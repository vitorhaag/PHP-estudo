<?php 

    function conectar(){
    
        $host = "localhost";
        $porta = 3306;
        $banco = "atividades";
        $usuario = "root";
        $senha = "";
        try{
            $conex = new PDO("mysql:host=$host;porta=$porta;dbname=$banco", $usuario, $senha);
        } catch(PDOException $e){
            die("erro na conexão com o banco de dados");
        }
        return $conex;
    }

    function select(){
        $conex = conectar();
        $sql = "SELECT id,nome,clube,posicao FROM futebol";
        $consulta = $conex->prepare($sql);
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }

    function obterdadosId($id){
            $conex = conectar();
            $sql = "SELECT id,nome,clube,posicao FROM futebol WHERE id = :id";
            $consulta = $conex->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $dados;

    }

    function insert($nome, $clube, $posi){
        $conex = conectar();
        $sql = "INSERT INTO futebol (nome, clube, posicao) VALUES (:nome, :clube, :posicao)";
        $consulta = $conex->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":clube", $clube);
        $consulta->bindParam(':posicao', $posi);
        $consulta->execute();

    }

    function deletar($id){
        $conex = conectar();
        $sql = "DELETE FROM futebol WHERE id = :id";
        $consulta = $conex->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
    }

    function editar($id,$nome,$clube,$posi){
        $conex = conectar();
        $sql = "UPDATE futebol SET nome=:nome, clube=:clube, posicao=:posicao WHERE id = :id";
        $consulta = $conex->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":clube", $clube);
        $consulta->bindParam(":posicao", $posi);
        $consulta->execute();
    }


?>