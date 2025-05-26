<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: /salao-de-beleza/admin/consulta/admin_consulta_agendamentos.php");
    exit;
}
?>