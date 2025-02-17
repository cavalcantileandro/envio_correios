<?php
include 'conexao.php';

if (!isset($_GET['id']) || !isset($_GET['codigo_rastreio'])) {
    echo json_encode(['success' => false, 'error' => 'Parâmetros inválidos.']);
    exit;
}

$id = intval($_GET['id']);
$codigo_rastreio = $_GET['codigo_rastreio'];

// Chamada à API de rastreamento
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.linketrack.com/track/json?user=teste&token=1abcd00b2731640e886fb41a8a9671ad1434c599dbaa0a0de9a5aa619f29a83f&codigo=$codigo_rastreio",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
curl_close($curl);

if (!$response) {
    echo json_encode(['success' => false, 'error' => 'Falha ao conectar à API.']);
    exit;
}

$data = json_decode($response, true);

if (!isset($data['eventos']) || empty($data['eventos'])) {
    echo json_encode(['success' => false, 'error' => 'Nenhuma movimentação encontrada.']);
    exit;
}

// Pegando a última movimentação
$ultimo_evento = $data['eventos'][0]['status'];

// Atualizando o status no banco de dados
$sql_update = "UPDATE envios SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql_update);
$stmt->bind_param('si', $ultimo_evento, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'status' => $ultimo_evento]);
} else {
    echo json_encode(['success' => false, 'error' => 'Erro ao atualizar o banco de dados.']);
}

$stmt->close();
$conn->close();
?>
