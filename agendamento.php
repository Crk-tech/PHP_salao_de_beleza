<?php

session_start();
include("admin/banco.php");

if (!isset($_SESSION["carrinho"])) {
    $_SESSION["carrinho"] = [];
}

$erro = "";
$nome_Cliente = $_POST["nome_Cliente"] ?? "";
$nome_Profissional = $_POST["nome_Profissional"] ?? "";
$nome_Servico = $_POST["nome_Servico"] ?? "";
$data_Agenda = $_POST["data_Agenda"] ?? "";
$hora = $_POST["hora"] ?? "";

$profissionais = $con->query("SELECT DISTINCT nome_Profissional FROM profissionais")->fetch_all(MYSQLI_ASSOC);
$servicos = [];
if (!empty($nome_Profissional)) {
    $stmt = $con->prepare("SELECT id_Profissional FROM profissionais WHERE nome_Profissional = ?");
    if (!$stmt) {
        die("Erro no prepare (profissionais): " . $con->error);
    }
    $stmt->bind_param("s", $nome_Profissional);
    $stmt->execute();
    $result = $stmt->get_result();
    $profData = $result->fetch_assoc();
    $idProf = $profData["id_Profissional"] ?? null;

    if ($idProf) {
        $stmt = $con->prepare("SELECT nome_Servico, preco FROM servico WHERE id_Profissional = ?");
        if (!$stmt) {
            die("Erro no prepare (servico): " . $con->error);
        }
        $stmt->bind_param("i", $idProf);
        $stmt->execute();
        $servicos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["adicionar"])) {
    $diaSemana = date("w", strtotime($data_Agenda));
    if ($diaSemana == 0 || $diaSemana == 6) {
        $erro = "Agendamentos só de segunda a sexta.";
    } else {
        $_SESSION["carrinho"][] = [
            "nome_Cliente" => $nome_Cliente,
            "nome_Profissional" => $nome_Profissional,
            "nome_Servico" => $nome_Servico,
            "data_Agenda" => $data_Agenda,
            "hora" => $hora
        ];
        header("Location: carrinho.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ic's Hair - Agendamento</title>
    <link href="img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen">
</head>
<body>
    <div class="container-fluid"><br>

        <div class="w-75 mx-auto d-flex justify-content-between align-items-center p-3 shadow rounded mb-3 " id="menu-inicial">
            <div>
                <img src="img/logo.png" alt="logo" class="menu-logo">
                <strong class="ms-2">Ic's Hair</strong>
            </div>
            <div>
                    <a href="index.html" class="me-3 text-dark">Menu</a>
                    <a href="servicos.php" class="me-3 text-dark">Serviços</a>
                    <a href="profissionais.php" class="me-3 text-dark">Funcionarios</a>
                    <a href="carrinho.php" class="me-3 text-dark">Carrinho</a>
                    <a href="#" class="me-3 text-dark" data-bs-toggle="modal" data-bs-target="#whatsappModal">
                        <i class="fab fa-whatsapp"></i>
                    </a>
            </div>
        </div>
        <div class="d-flex justify-content-start align-items-start agendamento-container">
            
            <form method="post" action="">
                <?php if ($erro): ?><p style="color:red;"><?= $erro ?></p><?php endif; ?>
                <div class="agendamento-box">
                    <div class="agendamento-header d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold">Agendar Atendimento</h2>
                        <i class="fa-solid fa-calendar fa-2x"></i>
                    </div>
                    
                    <input type="text" class="form-control form-selecoes" name="nome_Cliente" placeholder="Nome e Sobrenome" value="<?= $nome_Cliente ?>" required>

                    <select class="form-select" name="nome_Profissional" onchange="this.form.submit()" required>
                        <option value="">Selecione Profissional</option>
                        <?php foreach ($profissionais as $p): ?>
                            <option <?= $nome_Profissional == $p["nome_Profissional"] ? "selected" : "" ?>>
                                <?= $p["nome_Profissional"] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select class="form-select" name="nome_Servico" required>
                        <option value="">Selecione Serviço</option>
                        <?php foreach ($servicos as $s): ?>
                            <option value="<?= $s["nome_Servico"] ?>" <?= $nome_Servico == $s["nome_Servico"] ? "selected" : "" ?>>
                                <?= $s["nome_Servico"] ?> - R$<?= number_format($s["preco"], 2, ',', '.') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <input class="form-control form-selecoes" type="date" name="data_Agenda" value="<?= $data_Agenda ?>" required>
                    
                    <select class="form-select" name="hora" required>
                        <option value="">Selecione Horário</option>
                        <?php foreach (["08:00","09:00","10:00","11:00","13:00","14:00","15:00","16:00"] as $h): ?>
                            <option <?= $hora == $h ? "selected" : "" ?>><?= $h ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input type="submit" name="adicionar" value="CARRINHO" class="btn btn-warning"><br>
                    <a href="index.html" class="btn btn-warning">VOLTAR</a>
                </div>
            </form>

            <div class="banner-lateral">
            <img src="img/bannerLateral.png" alt="Banner Lateral" class="img-fluid">
            </div>
        </div>
    </div><br><br>

    <!-- WHATSAPP -->
    <div class="modal fade" id="whatsappModal" tabindex="-1" aria-labelledby="whatsappModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <div class="modal-header bg-purple text-white">
            <h5 class="modal-title" id="whatsappModalLabel">Entre em Contato:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>

        <div class="modal-body text-center">
            <img src="img/whatsapp.png" alt="QRcode WhatsApp" class="img-fluid mb-3" style="max-height: 250px;">
            <div class="mb-3">
            <a href="https://wa.me/5514982015014" target="_blank" class="btn btn-success w-100">
                <i class="fab fa-whatsapp me-2"></i>Clique aqui e fale conosco!
            </a>
            </div>
            <p class="mb-0">Via WhatsApp</p>
        </div>

        </div>
    </div>
    </div>

    <footer class="text-white py-4 rodape">
        <div class="container">
            <div class="row">
                <!-- primeira divisão -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase">Ic's Hair</h5>
                    <p style="font-family: Arial, sans-serif;">
                        Transformamos beleza em arte. Agende seu horário e descubra uma nova versão de você.
                    </p>
                </div>

                <!-- segunda divisão -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase">Contato</h5>
                    <p><i class="fa-solid fa-phone me-2"></i>(14) 93352-0916</p>
                    <p><i class="fa-brands fa-whatsapp me-2"></i>WhatsApp: (14) 93352-0916</p>
                    <p><i class="fa-solid fa-envelope me-2"></i>contato@icshair.com</p>
                </div>

                <!-- terceira divisão -->
                <div class="col-md-4 mb-3">
                    <h5 class="text-uppercase">Redes Sociais</h5>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-tiktok fa-lg"></i></a>
                </div>
            </div>

            <hr class="border-light">

            <div class="text-center small">
                &copy; 2025 Ic's Hair. Todos os direitos reservados.
            </div>
        </div>
    </footer>
</body>
</html>