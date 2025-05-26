<?php
include("../banco.php");

$id = $_GET['id_Profissional'];

$result_servicos = mysqli_query($con, "SELECT id_Servico FROM servico WHERE id_Profissional = $id");

$servicos = [];
while ($row = mysqli_fetch_assoc($result_servicos)) {
    $servicos[] = $row['id_Servico'];
}

// Armazena os ids em um array
$clientesParaExcluir = [];
foreach ($servicos as $id_servico) {
    $result_agendamentos = mysqli_query($con, "SELECT id_AgendaCliente FROM agendamento WHERE id_Servico = $id_servico");
    
    while ($row = mysqli_fetch_assoc($result_agendamentos)) {
        $clientesParaExcluir[] = $row['id_AgendaCliente'];
    }

    // agendamento
    mysqli_query($con, "DELETE FROM agendamento WHERE id_Servico = $id_servico");
}

// agenda_cliente
foreach ($clientesParaExcluir as $idCliente) {
    mysqli_query($con, "DELETE FROM agenda_cliente WHERE id_AgendaCliente = $idCliente");
}

//SET null
mysqli_query($con, "UPDATE servico SET id_Profissional = NULL WHERE id_Profissional = $id");

//profissional
mysqli_query($con, "DELETE FROM profissionais WHERE id_Profissional = $id");

header("Location: /salao-de-beleza/admin/consulta/admin_consulta_profissional.php");
exit();
?>