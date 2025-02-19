<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"]);
    $feedback = $_POST["feedback"];

    if (!in_array($feedback, ["positivo", "neutro", "negativo"])) {
        echo json_encode(["success" => false, "message" => "Feedback inválido."]);
        exit;
    }

    $sql = "UPDATE envios SET feedback='$feedback' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Feedback salvo com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao salvar feedback."]);
    }

    $conn->close();
}
?>
