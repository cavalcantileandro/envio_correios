<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Envio</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function formatarData(input) {
            var value = input.value.replace(/\D/g, "");
            if (value.length > 2) value = value.substring(0, 2) + '/' + value.substring(2);
            if (value.length > 5) value = value.substring(0, 5) + '/' + value.substring(5, 9);
            input.value = value;
        }

        function formatarTelefone(input) {
            let value = input.value.replace(/\D/g, ""); // Remove tudo que não for número
            
            if (value.length > 2) {
                value = `(${value.substring(0, 2)})${value.substring(2)}`;
            }
            if (value.length > 8) {
                value = `${value.substring(0, 9)}.${value.substring(9)}`;
            }
            if (value.length > 14) {
                value = value.substring(0, 14);
            }

            input.value = value;
        }
    </script>
</head>
<body>
    <a href="index.php" class="btn-voltar">Voltar</a>
    <form action="processa_cadastro.php" method="post" class="form-cadastro">
        <label>Tipo:</label>
        <select name="tipo">
            <option value="Nacional">Nacional</option>
            <option value="Internacional">Internacional</option>
        </select>

        <!-- Novo campo: Modalidade -->
        <label>Modalidade:</label>
        <select name="modalidade">
            <option value="Impresso Registrado">Impresso Registrado</option>
            <option value="Carta Registrada">Carta Registrada</option>
            <option value="PAC">PAC</option>
            <option value="Sedex">Sedex</option>
            <option value="Outros">Outros</option>
        </select>

        <label>Código de Rastreio:</label>
        <input type="text" name="codigo_rastreio" required>

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Telefone:</label>
        <input type="text" name="telefone" maxlength="14" oninput="formatarTelefone(this)" required>

        <label>Data de Envio:</label>
        <input type="text" name="data_envio" maxlength="10" oninput="formatarData(this)" required>

        <label>Estado:</label>
        <input type="text" name="estado" required>

        <label>País:</label>
        <input type="text" name="pais" required>

        <label>Peso (kg):</label>
        <input type="number" name="peso" step="0.001" required>

        <label>Valor (R$):</label>
        <input type="number" name="valor" step="0.01" required>

        <label>Observação:</label>
        <textarea name="observacao"></textarea>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>