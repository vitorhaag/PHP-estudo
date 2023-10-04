<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calculo de IMC</title>
</head>
<body>
    <p>Vamos calcular seu IMC:</p>
    <form>
       seu peso <input name="peso">
        <br>
        sua altura <input name="altura">
        <br>
        <button>Calcular IMC</button>
        <br>
    </form>

    <?php
    if (isset($_GET['peso']) and ($_GET['altura'])) {
        $peso = $_GET['peso'];
        $altura = $_GET['altura'];
        $multiplicar = $altura * $altura;
        $imc = $peso/$multiplicar ;
        echo "<p> seu IMC é $imc</p>";
        if ($imc <= 16.9) {
            echo "<p>Voce está muito abaixo do peso</p>";
        } else if ($imc < 18.4) {
            echo "<p> Voce está ABAIXO DO PESO</p>";
        } else if ($imc < 24.9) {
            echo "<p> Voce está com seu PESO NORMAL </p>";
        } else if ($imc < 29.9) {
            echo "<p> voce está ACIMA DO PESO </p>";

        } else if ($imc < 34.9) {
            echo "<p> voce está com OBESIDADE GRAU 1</p>";
        } else if ($imc < 40) {
            echo "<p> voce está com OBESIDADE GRAU 2 </p>";
        } else {
            echo "<p> voce está com OBESIDADE GRAU 3 </p>";
        }


    }
        
    
    
    
    ?>
    
</body>
</html>