<?php 
include "/xampp/htdocs/exercicios/PHP-estudo/atividade-aula4/model.php";

    function recebePar($par){
        return $_GET[$par];
    }
    function existePar($par){
        return isset($_GET[$par]);
    }

    function testePar($par, $valor){
        if (!existePar($par)) return false;
        return recebePar($par) == $valor;
    }

    $id = "";
    $nome = "";
    $clube = "";
    $posi = "";
    $acao = "Cadastrar";

    if(testePar('acao', 'Cadastrar')){
        insert(recebePar('nome'), recebePar('clube'), recebePar('posicao'));
    }
    else if(testePar('acao', 'Remover')){
        deletar(recebePar('id'));
    } else if(testePar('acao', 'Editar')){
        editar(recebePar('id'), recebePar('nome'), recebePar('clube'), recebePar('posicao'));
    } else if(testePar('acao', 'Consultar')){
        $dados = obterDadosId(recebePar('id'));
        $id = $dados[0]['id'];
        $nome = $dados[0]['nome'];
        $clube = $dados[0]['clube'];
        $posi = $dados[0]['posicao'];
        $acao = "Editar";
    }

    $arrayCadastro = select();

    include "/xampp/htdocs/exercicios/PHP-estudo/atividade-aula4/view.php";
?>