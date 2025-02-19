<?php
include 'conexao.php';

// Verifica se o ID foi passado na URL
if (!isset($_GET['id'])) {
    die("ID do envio não especificado.");
}
$id = $_GET['id'];

// Busca os dados do envio
$sql = "SELECT * FROM envios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Envio não encontrado.");
}
$envio = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Envio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php" class="btn-voltar">Voltar</a>
    <form action="processa_edicao.php" method="post" class="form-cadastro">
        <input type="hidden" name="id" value="<?= $id ?>">
        
        <label>Tipo:</label>
        <select name="tipo">
            <option value="Nacional" <?= $envio['tipo'] == 'Nacional' ? 'selected' : '' ?>>Nacional</option>
            <option value="Internacional" <?= $envio['tipo'] == 'Internacional' ? 'selected' : '' ?>>Internacional</option>
        </select>

        <label>Modalidade:</label>
        <select name="modalidade">
            <option value="Impresso Registrado" <?= $envio['modalidade'] == 'Impresso Registrado' ? 'selected' : '' ?>>Impresso Registrado</option>
            <option value="Carta Registrada" <?= $envio['modalidade'] == 'Carta Registrada' ? 'selected' : '' ?>>Carta Registrada</option>
            <option value="PAC" <?= $envio['modalidade'] == 'PAC' ? 'selected' : '' ?>>PAC</option>
            <option value="Sedex" <?= $envio['modalidade'] == 'Sedex' ? 'selected' : '' ?>>Sedex</option>
            <option value="Outros" <?= $envio['modalidade'] == 'Outros' ? 'selected' : '' ?>>Outros</option>
        </select>

        <label>Código de Rastreio:</label>
        <input type="text" name="codigo_rastreio" value="<?= $envio['codigo_rastreio'] ?>" required>

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $envio['nome'] ?>" required>

        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= $envio['telefone'] ?>" maxlength="14" required>

        <label>Data de Envio:</label>
        <input type="text" name="data_envio" value="<?= $envio['data_envio'] ?>" maxlength="10" required>

        <label>Estado:</label>
        <input type="text" name="estado" value="<?= $envio['estado'] ?>" required>

        <label>País:</label>
        <input type="text" name="pais" value="<?= $envio['pais'] ?>" required>

        <label>Peso (kg):</label>
        <input type="number" name="peso" value="<?= $envio['peso'] ?>" step="0.001" required>

        <label>Valor (R$):</label>
        <input type="number" name="valor" value="<?= $envio['valor'] ?>" step="0.01" required>

        <label>Observação:</label>
        <textarea name="observacao"><?= $envio['observacao'] ?></textarea>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
