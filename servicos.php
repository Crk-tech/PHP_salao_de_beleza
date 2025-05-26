<?php
include("admin/banco.php");
$servicos = $con->query("SELECT nome_Servico, preco FROM servico")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ic's Hair</title>
    <link href="img/logo.png" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen">
    <style>
        .botao-agendar{
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 12px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="container-fluid"><br>

        <div class="w-75 mx-auto d-flex justify-content-between align-items-center p-3 shadow rounded mb-3" id="menu-inicial">
            <div>
                <img src="img/logo.png" alt="logo" class="menu-logo">
                <strong class="ms-2">Ic's Hair</strong>
            </div>
            <div>
                <a href="index.html" class="me-3 text-dark">Menu</a>
                <a href="carrinho.php" class="me-3 text-dark">Carrinho</a>
                <a href="#" class="me-3 text-dark" data-bs-toggle="modal" data-bs-target="#whatsappModal">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div><br>

        <!-- CARROSSEL -->
        <div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/bannerUm.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/bannerDois.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/bannerTres.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="custom-arrow">
                    <i class="fas fa-chevron-left"></i>
                </span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="custom-arrow">
                    <i class="fas fa-chevron-right"></i>
                </span>
            </button>
        </div><br>
        
        <div class="text-center mb-4">
            <h2 class="fw-bold btn-custom">Serviços disponibilizados</h2>
        </div>

        <div class="container">
            <div class="servico-container">
                <?php foreach ($servicos as $servico): ?>
                    <div class="servico-box">
                        <h4><?= htmlspecialchars($servico['nome_Servico']) ?></h4>
                        <p>Preço: R$ <?= number_format($servico['preco'], 2, ',', '.') ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div><br>
    </div>
    <a href="agendamento.php" class="btn botao-agendar">Agendar</a>

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