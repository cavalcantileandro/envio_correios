<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $modalidade = $_POST['modalidade'];
    $codigo_rastreio = $_POST['codigo_rastreio'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $data_envio = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data_envio'])));
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];
    $peso = $_POST['peso'];
    $valor = $_POST['valor'];
    $observacao = $_POST['observacao'];

    $sql = "UPDATE envios SET 
                tipo = ?, 
                modalidade = ?, 
                codigo_rastreio = ?, 
                nome = ?, 
                telefone = ?, 
                data_envio = ?, 
                estado = ?, 
                pais = ?, 
                peso = ?, 
                valor = ?, 
                observacao = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssddsi", $tipo, $modalidade, $codigo_rastreio, $nome, $telefone, $data_envio, $estado, $pais, $peso, $valor, $observacao, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Registro atualizado com sucesso!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar registro!'); window.history.back();</script>";
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Requisição inválida!'); window.history.back();</script>";
}
?>
