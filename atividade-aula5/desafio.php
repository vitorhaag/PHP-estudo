<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
                /* display: flex; */
                /* flex-direction: ; */
                /* float: right; */
                background-color: green;
                width: 110px;
                margin-left: 10px;
                margin-right: 10px;
                margin-top: 15px;
                margin-bottom: 12px;
                border-radius: 11px;
                height: 29px;
                box-shadow: 1px 1px 6px -2px black;
                cursor: pointer;
            }
            .formulario{
                background-color: #a5a1a13b;
                width: 299px;
                height: 210px;
                border-radius: 10px;
                margin: 22px;
                padding: 12px;
    
            }
            select{
                margin-left: 28%;
                width: 40%;
                border: 1px solid black;
                border-radius: 4px;
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
                margin-right: 14px;
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
        /* td:last-child, th:last-child{
            padding-right: 16px ;
            padding-left: 16px;
    
        }
     */
        th{
            border: 1px #b2db15 solid;
        padding: 9px;
        background: darkseagreen;
        }
        #sala{
            padding-right: 20px;
            padding-left: 20px;
        }
        #salvar{
            float: left;

        }
        #exibir{
            float: right;
        }
</style>
<body>
    <div class="formulario">
        <form>
            Nome: <input name="nome">
            <br> Sálario: <input name="salario">
            <br><select name="selecao">
                <option value="funcionario">Funcionário</option>
                <option value="supervisor">Supervisor</option>
                <option value="gerente">Gerente</option>
                <option value="socio">Sócio</option>
            </select>
            <br>
            <button name="acao" value="salva" id="salvar">Salva</button>
            <button name="acao" value="exibe" id="exibir">Exibe</button>
        </form>
    </div>

    <?php 
    
    class Funcionario {
        public $nome;
        public $sal;

        public function __construct($nome, $sal){
            $this->nome = $nome;
            $this->salario = $sal;
        }

        public function bonificacao(){
            return $this->salario * 1.2;
        }

        public function cargo(){
            return "Funcionario";
        }
    }
    
    class Gerente extends Funcionario{
        public function bonificacao(){
            return $this->salario * 2.0;
        }
        public function cargo(){
            return "Gerente";
        }
    }
    class Socio extends Funcionario{
        public function bonificacao(){
            return $this->salario * 2.7;
        }
        public function cargo(){
            return "Sócio";
        }
    }
    class Supervisor extends Funcionario{
        public function bonificacao(){
            return $this->salario * 1.6;
        }
        public function cargo(){
            return "Supervisor";
        }
    }

    class Memoria {
        public $have;

        public function __construct($chave){
            $this->chave = $chave;

        }
        public function salvaDado($dado){
            if(!isset($_SESSION[$this->chave])){
                $_SESSION[$this->chave] = array();
            }
                $_SESSION[$this->chave][] = $dado;
        }

        public function leDado(){
            if(!isset($_SESSION[$this->chave])){
                return array();
            }
            return $_SESSION[$this->chave];
        }
    }
    function recebe($par){
        if (isset($_GET[$par])) return $_GET[$par];
        if (isset($_POST[$par])) return $_POST[$par];
    }

    session_start();
    $memoria1 = new Memoria("desafio");

    if(recebe("acao") == "salva"){
        $nome = recebe("nome");
        $sal = recebe("salario");
        if($nome != ""){
            $pessoa = null;
            if(recebe("selecao") == "funcionario"){
                $pessoa = new Funcionario($nome, $sal);
            } else if(recebe("selecao") == "Supervisor"){
                $pessoa = new Supervisor($nome, $sal);
            } else if(recebe("selecao") == "Gerente"){
                $pessoa = new Gerente($nome, $sal);
            } else{
                $pessoa = new Socio($nome, $sal);
            }
            $memoria1->salvaDado($pessoa);
        }   
    } else if(recebe("acao") == "exibe") {
        $lista = $memoria1->leDado();?>
        <table><thead><tr><th>Cargo</th><th>Nome</th><th id="Sala">Salario</th><th>Salario com bonifiação</th></tr></thead>
        <?php foreach($lista as $pessoa){
            // echo "<br> Bonus do " . $pessoa->cargo() . " " . $pessoa->nome . ": " . $pessoa->bonificacao();
            $nometabela = $pessoa->nome;
            $nometabela = mb_convert_case($nometabela, MB_CASE_TITLE, "UTF-8");
            $tipo = $pessoa->cargo();
            $salario = $pessoa->salario;
            $salario = number_format($salario,2,",",".");
            $bonus = $pessoa->bonificacao();
            $bonus = number_format($bonus,2, ",",".");
            ?>
            <tr>
                <td><?=$tipo?></td>
                <td><?=$nometabela?></td>
                <td id="sala">R$ <?=$salario?></td>
                <td>R$ <?=$bonus?></td>
            </tr>
        <?php 
        }
        }
        ?>
        
    
</body>
</html>