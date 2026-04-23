<?php include('header.php'); ?>

<div class="container mt-5">

<?php

// 1. Pega a data do formulário
$data_nascimento = $_POST['data_nascimento'];

// 2. Converte para dia e mês
$data = DateTime::createFromFormat('Y-m-d', $data_nascimento);
$dia = $data->format('d');
$mes = $data->format('m');

// 3. Carrega o XML
$signos = simplexml_load_file("signos.xml");

$signoEncontrado = null;

// 4. Percorre os signos
foreach ($signos->signo as $signo) {

    // separa datas do XML (formato dd/mm)
    list($diaInicio, $mesInicio) = explode('/', $signo->dataInicio);
    list($diaFim, $mesFim) = explode('/', $signo->dataFim);

    // converte tudo para número inteiro
    $inicio = (int)$mesInicio * 100 + (int)$diaInicio;
    $fim    = (int)$mesFim * 100 + (int)$diaFim;
    $nascimento = (int)$mes * 100 + (int)$dia;

    // caso normal (mesmo ano)
    if ($inicio <= $fim) {
        if ($nascimento >= $inicio && $nascimento <= $fim) {
            $signoEncontrado = $signo;
            break;
        }
    } 
    // caso Capricornio (vira o ano)
    else {
        if ($nascimento >= $inicio || $nascimento <= $fim) {
            $signoEncontrado = $signo;
            break;
        }
    }
}

// 5. Mostra resultado
if ($signoEncontrado) {
    echo "<h2>{$signoEncontrado->signoNome}</h2>";
    echo "<p>{$signoEncontrado->descricao}</p>";
} else {
    echo "<h3>Signo não encontrado</h3>";
}
if ($signoEncontrado) {

    echo "<div class='card p-4 text-center'>";

    echo "<h2>{$signoEncontrado->signoNome}</h2>";

    echo "<img src='{$signoEncontrado->imagem}' class='img-fluid' style='max-width:200px; margin: 20px auto;'>";

    echo "<p>{$signoEncontrado->descricao}</p>";

    echo "</div>";

} else {
    echo "<h3>Signo não encontrado</h3>";
}
?>

<br>
<a href="index.php" class="btn btn-primary">Voltar</a>

</div>
