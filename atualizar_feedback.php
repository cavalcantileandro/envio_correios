<?php
include 'conexao.php';

if (!isset($_POST['id']) || !isset($_POST['feedback'])) {
    echo json_encode(['success' => false, 'error' => 'Parâmetros inválidos.']);
    exit;
}

$id = intval($_POST['id']);
$feedback = $_POST['feedback'];

$sql_update = "UPDATE envios SET feedback = ? WHERE id = ?";
$stmt = $conn->prepare($sql_update);
$stmt->bind_param('si', $feedback, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Erro ao atualizar no banco.']);
}

$stmt->close();
$conn->close();
?>
