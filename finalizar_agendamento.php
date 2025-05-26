<?php

session_start();
include("admin/banco.php");

$carrinho = $_SESSION["carrinho"] ?? [];

foreach ($carrinho as $item) {
    $stmt = $con->prepare("SELECT id_Profissional FROM profissionais WHERE nome_Profissional = ?");
    $stmt->bind_param("s", $item["nome_Profissional"]);
    $stmt->execute();
    $profData = $stmt->get_result()->fetch_assoc();
    $idProf = $profData["id_Profissional"] ?? null;

    if (!$idProf) continue;

    // Valida se já tiver agendamentos
    $stmt = $con->prepare("SELECT 1 FROM agendamento a
        JOIN servico s ON a.id_Servico = s.id_Servico
        WHERE s.id_Profissional = ? AND a.id_AgendaCliente IN (
            SELECT id_AgendaCliente FROM agenda_cliente
            WHERE data_Agenda = ? AND hora = ?
        )");
    $stmt->bind_param("iss", $idProf, $item["data_Agenda"], $item["hora"]);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<p style='color:red'>Horário indisponível para o profissional {$item["nome_Profissional"]} às {$item["hora"]} em {$item["data_Agenda"]}.</p>";
        continue;
    }

    $stmt = $con->prepare("INSERT INTO agenda_cliente (nome_Cliente, data_Agenda, hora) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $item["nome_Cliente"], $item["data_Agenda"], $item["hora"]);
    $stmt->execute();
    $id_AgendaCliente = $con->insert_id;

    $stmt = $con->prepare("SELECT id_Servico FROM servico WHERE nome_Servico = ? AND id_Profissional = ?");
    $stmt->bind_param("si", $item["nome_Servico"], $idProf);
    $stmt->execute();
    $result = $stmt->get_result();
    $servico = $result->fetch_assoc();

    if ($servico) {
        $id_Servico = $servico["id_Servico"];
        $stmt = $con->prepare("INSERT INTO agendamento (id_AgendaCliente, id_Servico) VALUES (?, ?)");
        $stmt->bind_param("ii", $id_AgendaCliente, $id_Servico);
        $stmt->execute();
    }
}

unset($_SESSION["carrinho"]);
?>
<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Agendamento realizado com sucesso!</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link href="/salao-de-beleza/img/logo.png" rel="icon">
    </head>
<body class="bg-light">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="alert alert-success text-center w-75" role="alert">
            <?php
                echo "<strong>🎉Agendamento realizado com sucesso!🎉</strong><br>"; 
            ?>
            <a href="agendamento.php" class="btn btn-outline-success mt-3">Novo agendamento</a>
        </div>
    </div>
</body>
</html>