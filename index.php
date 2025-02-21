<?php 
include 'conexao.php';

// Definição de paginação
$itens_por_pagina = 100;
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
        .acoes {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
        .acoes button, .acoes a {
            padding: 5px 10px;
            font-size: 14px;
            text-align: center;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }
        .btn-editar {
            background-color: #ffc107;
            color: #000;
        }
        .btn-copiar {
            background-color: #17a2b8;
            color: white;
        }
        .btn-status {
            background-color: #28a745;
            color: white;
        }
        .btn-cadastrar, #btn-limpar {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 10px;
			border: none; /* Remove a borda padrão do botão */
            cursor: pointer; /* Adiciona o cursor de ponteiro */
        }
        .btn-cadastrar:hover, #btn-limpar :hover {
            background-color: #0056b3;
        }
        .search-box {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }
        .search-box input {
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 180px;
        }
    </style>
</head>
<body>

<a href="cadastro.php" class="btn-cadastrar">Cadastrar Novo Envio</a>
<p>Total de envios cadastrados: <strong><?= $total_produtos ?></strong></p>

<!-- Campos de busca -->
<div class="search-box">
    <input type="text" id="search-tipo" placeholder="Buscar por Tipo">
    <input type="text" id="search-modalidade" placeholder="Buscar por Modalidade">
    <input type="text" id="search-codigo" placeholder="Buscar por Código de Rastreio">
    <input type="text" id="search-nome" placeholder="Buscar por Nome">
    <input type="text" id="search-telefone" placeholder="Buscar por Telefone">
	<input type="text" id="search-data_envio" placeholder="Buscar Data">
    <input type="text" id="search-estado" placeholder="Buscar por Estado">
    <input type="text" id="search-pais" placeholder="Buscar por País">
    <input type="text" id="search-peso" placeholder="Buscar por Peso">
    <input type="text" id="search-valor" placeholder="Buscar por Valor">
    <input type="text" id="search-status" placeholder="Buscar por Status">
	
	<!-- Botão limpar -->
    <button id="btn-limpar">Limpar Filtros</button>
	
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
            <th>Feedback</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody id="tabela-envios">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['tipo'] ?></td>
                <td><?= $row['modalidade'] ?></td>
                <td><?= $row['codigo_rastreio'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td><?= preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $row['telefone']) ?></td>
                <td><?= date('d/m/Y', strtotime($row['data_envio'])) ?></td>
                <td><?= $row['estado'] ?></td>
                <td><?= $row['pais'] ?></td>
                <td><?= $row['peso'] ?></td>
                <td><?= $row['valor'] ?></td>
                <td><?= $row['observacao'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <div class="feedback-container">
                        <label>
                            <input type="radio" name="feedback_<?= $row['id'] ?>" value="positivo" <?= $row['feedback'] == 'positivo' ? 'checked' : '' ?>>
                            <img src="images/positivo.png" alt="Positivo">
                        </label>
                        <label>
                            <input type="radio" name="feedback_<?= $row['id'] ?>" value="neutro" <?= $row['feedback'] == 'neutro' ? 'checked' : '' ?>>
                            <img src="images/neutro.png" alt="Neutro">
                        </label>
                        <label>
                            <input type="radio" name="feedback_<?= $row['id'] ?>" value="negativo" <?= $row['feedback'] == 'negativo' ? 'checked' : '' ?>>
                            <img src="images/negativo.png" alt="Negativo">
                        </label>
                    </div>
                </td>
                <td>
                    <div class="acoes">
                        <a href='editar.php?id=<?= $row['id'] ?>' class='btn-editar'>E</a>
                        <button onclick='copiarDados(this)' class='btn-copiar'>C</button>
                        <button onclick='atualizarStatus(this, <?= $row['id'] ?>, "<?= $row['codigo_rastreio'] ?>")' class='btn-status'>S</button>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>

	// Evento para os botoes feedback 
	document.querySelectorAll('.feedback-container input[type="radio"]').forEach(input => {
		input.addEventListener('change', function() {
			let id = this.name.split('_')[1]; // Obtém o ID do registro
			let feedback = this.value;

			fetch('atualizar_feedback.php', {
				method: 'POST',
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				body: `id=${encodeURIComponent(id)}&feedback=${encodeURIComponent(feedback)}`
			})
			.then(response => response.json())
			.then(data => {
				if (!data.success) {
					alert('Erro ao atualizar feedback.');
					console.error(data.error);
				}
			})
			.catch(error => console.error('Erro:', error));
		});
	});

	//Função para copiar os dados do botao copiar 
	function copiarDados(botao) {
        let linha = botao.closest("tr");
        let modalidade = linha.cells[1].textContent.trim();
        let nome = linha.cells[3].textContent.trim();
        let codigo = linha.cells[2].textContent.trim();
		let status = linha.cells[11].textContent.trim();
        let link = `https://linketrack.com/track?codigo=${codigo}`;

        let texto = `${modalidade}\n${nome}\n${codigo}\n${status}\n${link}`;

        navigator.clipboard.writeText(texto).then(() => {
            alert('Dados copiados para a área de transferência.');
        }).catch(err => {
            console.error('Erro ao copiar: ', err);
        });
    }

	//Função para atualizar o status com efeito de processamento
    function atualizarStatus(botao, id, codigo) {
    // Exibe "..." no botão enquanto o status está sendo processado
		botao.textContent = "...";
		botao.disabled = true; // Desabilita o botão para evitar múltiplos cliques

		fetch('atualizar_status.php', {
			method: 'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			body: `id=${id}&codigo_rastreio=${codigo}`
		})
		.then(response => response.json())
		.then(data => {
			if (data.success) {
				let linha = botao.closest("tr");
				let colunaStatus = linha.cells[11]; // Ajustar caso a ordem mude
				colunaStatus.textContent = data.novo_status;
			} else {
				alert('Erro ao atualizar status: ' + (data.error || 'Erro desconhecido.'));
			}
		})
		.catch(error => {
			console.error('Erro:', error);
			alert('Erro ao atualizar status.');
		})
		.finally(() => {
			// Restaura o texto original do botão e o reabilita
			botao.textContent = "S";
			botao.disabled = false;
		});
	}


    // Adiciona evento para filtrar dinamicamente
    document.querySelectorAll('.search-box input').forEach(input => {
		input.addEventListener('input', function () {
			let termoBusca = this.value.trim().toLowerCase();
			let colunaIndex = obterIndiceColuna(this.id.replace("search-", ""));

			document.querySelectorAll("#tabela-envios tr").forEach(linha => {
				let coluna = linha.cells[colunaIndex];

				if (coluna) {
					// Se houver um <a> dentro da célula, pega o texto dele
					let colunaTexto = coluna.querySelector('a') ? coluna.querySelector('a').textContent.trim() : coluna.textContent.trim();

					// Normaliza para evitar problemas com acentos e caracteres invisíveis
					colunaTexto = colunaTexto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
					termoBusca = termoBusca.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();

					// Exibe ou oculta a linha com base na busca
					linha.style.display = colunaTexto.includes(termoBusca) ? "" : "none";
				}
			});
		});
	});

    // Botão para limpar filtros e exibir todas as linhas novamente
	document.getElementById("btn-limpar").addEventListener("click", function () {
		document.querySelectorAll('.search-box input').forEach(input => input.value = "");
		document.querySelectorAll("#tabela-envios tr").forEach(linha => linha.style.display = "");
	});

    // Mapeia os índices das colunas para os campos de busca
    function obterIndiceColuna(coluna) {
		let colunas = [
			"tipo", "modalidade", "codigo_rastreio", "nome", "telefone",
			"data_envio", "estado", "pais", "peso", "valor", "observacao", "status"
		];
		return colunas.indexOf(coluna);
	}
</script>

</body>
</html>
