<?php
include("../banco.php");

$id = $_GET['id_Servico'];

$result = mysqli_query($con, "SELECT id_AgendaCliente FROM agendamento WHERE id_Servico = $id");

// Armazena os ids em um array
$clientesParaExcluir = [];
while ($row = mysqli_fetch_assoc($result)) {
    $clientesParaExcluir[] = $row['id_AgendaCliente'];
}

//tabela agendamento
mysqli_query($con, "DELETE FROM agendamento WHERE id_Servico = $id");

//serviço
mysqli_query($con, "DELETE FROM servico WHERE id_Servico = $id");

//agenda_cliente
foreach ($clientesParaExcluir as $idCliente) {
    mysqli_query($con, "DELETE FROM agenda_cliente WHERE id_AgendaCliente = $idCliente");
}

header("Location: /salao-de-beleza/admin/consulta/admin_consulta_servicos.php");
exit();
?>

