<?php

    include("../banco.php");

    $id_Profissional = @$_POST["id_Profissional"];
    $nome_Profissional = @$_POST["nome_Profissional"];

    $sql = "UPDATE profissionais
                SET nome_Profissional='$nome_Profissional'
                WHERE id_Profissional='$id_Profissional'";

    $con->query($sql);

    header("location:/salao-de-beleza/admin/consulta/admin_consulta_profissional.php");

?>