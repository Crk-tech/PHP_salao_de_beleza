<?php

    include("../banco.php");

    $id_Servico = @$_POST["id_Servico"];
    $nome_Servico = @$_POST["nome_Servico"];
    $preco = @$_POST["preco"];

    $sql = "UPDATE servico
                SET nome_Servico='$nome_Servico',
                    preco='$preco'
                WHERE id_Servico='$id_Servico'";

    $con->query($sql);

    header("location:/salao-de-beleza/admin/consulta/admin_consulta_servicos.php");

?>