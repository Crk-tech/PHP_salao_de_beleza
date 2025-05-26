<?php
include("../banco.php");

$id_servico = $_GET['id_Servico']; 


$query = "UPDATE servico SET id_Profissional = NULL WHERE id_Servico = '$id_servico'";
$resultado = mysqli_query($con, $query);

if ($resultado) {
    echo "Erro ao remover associação: " . mysqli_error($con);
}
 header("Location:/salao-de-beleza/admin/consulta/admin_consulta_servicos_profissionais.php");
?>
