<?php 
include 'conexao.php';

// Definição de paginação
$itens_por_pagina = 10;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// Consulta total de produtos
$sql_total = "SELECT COUNT(*) as total FROM envios";
$result_total = $conn->query($sql_total);
$total_produtos = $result_total->fetch_assoc()['total'];
$total_paginas = ceil($total_produtos / $itens_por_pagina);

// Consulta paginada
$sql = "SELECT * FROM envios ORDER BY data_envio DESC LIMIT $itens_por_pagina OFFSET $offset";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Envios</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilo para os botões de paginação */
        .paginacao {
            margin-top: 20px;
            text-align: center;
        }
        .paginacao a {
            display: inline-block;
            padding: 10px 15px;
            margin: 0 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .paginacao a:hover {
            background-color: #0056b3;
        }
        .paginacao a:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .total-envios {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
    </style>
    <script>
        function atualizarStatus(button, id, codigoRastreio) {
            button.textContent = "...";
            button.disabled = true;

            fetch(`atualizar_status.php?id=${id}&codigo_rastreio=${codigoRastreio}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let linha = button.closest('tr');
                        linha.querySelector("[data-campo='status']").textContent = data.status;
                        button.textContent = "S";
                        button.disabled = false;
                    } else {
                        alert("Erro ao atualizar o status.");
                        button.textContent = "S";
                        button.disabled = false;
                    }
                })
                .catch(error => {
                    console.error("Erro na requisição: ", error);
                    alert("Erro ao atualizar o status.");
                    button.textContent = "S";
                    button.disabled = false;
                });
        }
        
        function filtrarTabela() {
            let inputs = document.querySelectorAll(".filtro");
            let linhas = document.querySelectorAll("tbody tr");
            
            linhas.forEach(linha => {
                let mostrar = true;
                inputs.forEach(input => {
                    let valor = input.value.toLowerCase();
                    let coluna = linha.querySelector(`[data-campo='${input.dataset.campo}']`);
                    if (coluna && !coluna.textContent.toLowerCase().includes(valor)) {
                        mostrar = false;
                    }
                });
                linha.style.display = mostrar ? "" : "none";
            });
        }
    </script>
</head>
<body>
    <a href="cadastro.php" class="btn-cadastrar">+ Cadastrar</a>
    
    <div class="filtros">
        <input type="text" class="filtro" data-campo="tipo" placeholder="Filtrar por Tipo" onkeyup="filtrarTabela()">
        <input type="text" class="filtro" data-campo="modalidade" placeholder="Filtrar por Modalidade" onkeyup="filtrarTabela()">
        <input type="text" class="filtro" data-campo="codigo_rastreio" placeholder="Filtrar por Código de Rastreio" onkeyup="filtrarTabela()">
        <input type="text" class="filtro" data-campo="nome" placeholder="Filtrar por Nome" onkeyup="filtrarTabela()">
        <input type="text" class="filtro" data-campo="telefone" placeholder="Filtrar por Telefone" onkeyup="filtrarTabela()">
        <input type="text" class="filtro" data-campo="estado" placeholder="Filtrar por Estado" onkeyup="filtrarTabela()">
        <input type="text" class="filtro" data-campo="pais" placeholder="Filtrar por País" onkeyup="filtrarTabela()">
        <input type="text" class="filtro" data-campo="peso" placeholder="Filtrar por Peso" onkeyup="filtrarTabela()">
        <input type="text" class="filtro" data-campo="valor" placeholder="Filtrar por Valor" onkeyup="filtrarTabela()">
        <input type="text" class="filtro" data-campo="observacao" placeholder="Filtrar por Observação" onkeyup="filtrarTabela()">
        <input type="text" class="filtro" data-campo="status" placeholder="Filtrar por Status" onkeyup="filtrarTabela()">
    </div>
    
    <div class="total-envios">
        Total de Envios: <?= $total_produtos ?>
    </div>
    
    <table class="styled-table">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Modalidade</th>
                <th>Código de Rastreio</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Data de Envio</th>
                <th>Estado</th>
                <th>País</th>
                <th>Peso (kg)</th>
                <th>Valor (R$)</th>
                <th>Observação</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td data-campo='tipo'><?= $row['tipo'] ?></td>
                    <td data-campo='modalidade'><?= $row['modalidade'] ?></td>
                    <td data-campo='codigo_rastreio'><?= $row['codigo_rastreio'] ?></td>
                    <td data-campo='nome'><?= $row['nome'] ?></td>
                    <td data-campo='telefone'><?= preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $row['telefone']) ?></td>
                    <td><?= date('d/m/Y', strtotime($row['data_envio'])) ?></td>
                    <td data-campo='estado'><?= $row['estado'] ?></td>
                    <td data-campo='pais'><?= $row['pais'] ?></td>
                    <td data-campo='peso'><?= $row['peso'] ?></td>
                    <td data-campo='valor'><?= $row['valor'] ?></td>
                    <td data-campo='observacao'><?= $row['observacao'] ?></td>
                    <td data-campo='status'><?= $row['status'] ?></td>
                    <td>
                        <a href='editar.php?id=<?= $row['id'] ?>' class='btn-editar'>E</a>
                        <button onclick='copiarDados(this)' class='btn-copiar'>C</button>
                        <button onclick='atualizarStatus(this, <?= $row['id'] ?>, "<?= $row['codigo_rastreio'] ?>")' class='btn-status'>S</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <div class="paginacao">
        <?php if ($pagina_atual > 1) { ?>
            <a href="?pagina=<?= $pagina_atual - 1 ?>" class="btn-voltar">Voltar Página</a>
        <?php } ?>
        
        <?php if ($pagina_atual < $total_paginas) { ?>
            <a href="?pagina=<?= $pagina_atual + 1 ?>" class="btn-proxima">Próxima Página</a>
        <?php } ?>
    </div>
</body>
</html>