<?php
session_start();
$equipoLogeado = $_SESSION['equipo'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WINNERS LEAGUE </title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <div class="logo">WINNERS LEAGUE ⚽🔥</div>
        <nav>
            <a href="#noticias">Noticias</a>
            <a href="#sobre-nosotros">Sobre Nosotros</a>
            <a href="buscar.html">BUSCA TUS RIVAL</a>
            <?php if ($equipoLogeado): ?>
                <a href="perfil.php" class="btn">Perfil (<?php echo htmlspecialchars($equipoLogeado); ?>)</a>
                <a href="logout.php" class="btn">Cerrar Sesión</a>
            <?php else: ?>
                <?php if ($equipoLogeado): ?>
                  <a href="buscar.html" class="btn-main">Busca a tu rival</a>
                <?php else: ?>
                <a href="registro.php" class="btn-main">Registrate</a>
                <?php endif; ?>

                <a href="login.html" class="btn">Iniciar Sesión</a>
            <?php endif; ?>
        </nav>
    </header>
    
    <section class="hero">
    <h1>Reta, Compite, Pichanguea</h1>
    <h4>Encuentra partidos, arma tu equipo y súmate al mejor ranking de pichangas.</h4>
    
    <?php if ($equipoLogeado): ?>
        <a href="buscar.html" class="btn-main">Busca a tu rival</a>
    <?php else: ?>
        <a href="registro.php" class="btn-main">Únete Ahora</a>
    <?php endif; ?>
</section>
    <section id="noticias" class="ranking">
  <h2>📰 Noticias de Fútbol</h2>
  <div class="slider-container">
    <div class="slider-track">
      <a href="https://www.conmebol.com/sudamericana/" target="_blank">
        <img src="https://tvperu.gob.pe/sites/default/files/styles/note/public/copa_sudamericana_peru.jpg?itok=KBYj1cnl" alt="Sudamericana">
      </a>
      <a href="https://es.uefa.com/uefachampionsleague/" target="_blank">
        <img src="https://corporate.televisaunivision.com/wp-content/uploads/sites/5/2025/02/UEFA-Champions-League-2025.jpg" alt="Champions League">
      </a>
      <a href="https://www.conmebol.com/libertadores/" target="_blank">
        <img src="https://meridianbetsport.pe/wp-content/uploads/2025/03/copa-libertadores-2025-fase-de-grupos-meridianbet.png" alt="Libertadores">
      </a>
    </div>
  </div>
  <p style="margin-top: 30px; font-size: 1rem;">Entérate de las últimas noticias de los torneos más importantes de este año 2025.</p>
</section>



    
<section id="sobre-nosotros" class="info-futbolmatch">
    <h2>🌟 Sobre WINNERS LEAGUE</h2>
    <p class="intro">
       WINNERS LEAGUE es tu espacio digital para organizar partidos, encontrar equipos rivales y competir en el ranking de pichangas. Nuestra misión es conectar a los amantes del fútbol en una comunidad activa y competitiva donde cada partido cuenta.
    </p>
    <div class="info-boxes">
        <a href="buscar.html" class="info-box">
            <h3>🔍 Encuentra Rivales</h3>
            <p>Explora equipos por distrito y arma partidos emocionantes. ¡Nunca fue tan fácil buscar un contrincante!</p>
        </a>
        <a href="ranking.html" class="info-box">
            <h3>📊 Sube en el Ranking</h3>
            <p>Gana partidos, suma puntos y asciende en la tabla. Tu equipo merece estar en la cima.</p>
        </a>
        <a href="buscar.html" class="info-box">
            <h3>💬 Chatea y Conecta</h3>
            <p>Comunícate directamente con otros equipos. Organiza los detalles del partido sin salir de la plataforma.</p>
        </a>
    </div>
</section>

    <footer>
        <p>&copy; 2025 Futbol Match. Todos los derechos reservados.</p>
    </footer>
<script>
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slider-track a');
  const track = document.querySelector('.slider-track');

  setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    track.style.transform = `translateX(-${currentSlide * 100}%)`;
  }, 5000);
</script>


</body>
</html>
