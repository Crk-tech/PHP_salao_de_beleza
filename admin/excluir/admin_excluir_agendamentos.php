<?php
include("../banco.php");

$id_Agendamento = $_GET["id_Agendamento"] ?? null;

if ($id_Agendamento) {
    // id_AgendaCliente do agendamento
    $stmt = $con->prepare("SELECT id_AgendaCliente FROM agendamento WHERE id_Agendamento = ?");
    $stmt->bind_param("i", $id_Agendamento);
    $stmt->execute();
    $result = $stmt->get_result();
    $agendamento = $result->fetch_assoc();

    if ($agendamento) {
        $id_AgendaCliente = $agendamento["id_AgendaCliente"];

        // agendamento
        $stmt = $con->prepare("DELETE FROM agendamento WHERE id_Agendamento = ?");
        $stmt->bind_param("i", $id_Agendamento);
        $stmt->execute();

        // agenda_cliente
        $stmt = $con->prepare("DELETE FROM agenda_cliente WHERE id_AgendaCliente = ?");
        $stmt->bind_param("i", $id_AgendaCliente);
        $stmt->execute();

        header("Location: /salao-de-beleza/admin/consulta/admin_consulta_agendamentos.php");
        exit;
    } 
    
    else {
        echo "Agendamento não encontrado.";
    }
} 
else {
    echo "ID inválido!";
}
?>