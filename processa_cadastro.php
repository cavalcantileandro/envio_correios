<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar os dados do formulário
    $tipo = $_POST['tipo'];
    $modalidade = $_POST['modalidade']; // Captura o valor da modalidade
    $codigo_rastreio = $_POST['codigo_rastreio'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    
    // Remover caracteres especiais do telefone antes de salvar no banco
    $telefone = preg_replace("/[^0-9]/", "", $telefone); 

    // Converter data do formato dd/mm/aaaa para aaaa-mm-dd (formato MySQL)
    $data_envio = DateTime::createFromFormat('d/m/Y', $_POST['data_envio']);
    $data_envio = $data_envio ? $data_envio->format('Y-m-d') : null;

    $estado = $_POST['estado'];
    $pais = $_POST['pais'];
    $peso = $_POST['peso'];
    $valor = $_POST['valor'];
    $observacao = $_POST['observacao'];

    // Query para inserir os dados no banco
    $sql = "INSERT INTO envios (tipo, modalidade, codigo_rastreio, nome, telefone, data_envio, estado, pais, peso, valor, observacao) 
            VALUES ('$tipo', '$modalidade', '$codigo_rastreio', '$nome', '$telefone', '$data_envio', '$estado', '$pais', '$peso', '$valor', '$observacao')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}

$conn->close();
?>