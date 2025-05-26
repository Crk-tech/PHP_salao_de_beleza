<?php
include("../banco.php");

$id_Profissional = $_POST['id_Profissional'];
$id_Servico = $_POST['id_Servico'];

$query = "UPDATE servico SET id_Profissional = '$id_Profissional' WHERE id_Servico = '$id_Servico'";
$resultado = mysqli_query($con, $query);

if ($resultado) {
    echo "Erro ao atualizar serviço: " . mysqli_error($con);
}
    header("Location:/salao-de-beleza/admin/consulta/admin_consulta_servicos_profissionais.php");
?>
