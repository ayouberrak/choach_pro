<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCoach - Votre Partenaire Fitness</title>
    <link rel="stylesheet" href="../../public/includs/header.css">
    <link rel="stylesheet" href="../../public/includs/footer.css">
    <script src="../../public/js/navbar.js" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760; 
            --bg-dark: #0a0a0a; 
            --card-bg: #151515; 
            --text-white: #ffffff;
            --text-gray: #a0a0a0;
        }
        /* --- Hero Section --- */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&q=80&w=1470') center/cover;
            padding: 0 20px;
        }

        .hero-content h1 { font-size: 4rem; font-weight: 800; line-height: 1.1; margin-bottom: 20px; }
        .hero-content h1 span { color: var(--primary); }
        .hero-content p { font-size: 1.2rem; color: var(--text-gray); max-width: 600px; margin: 0 auto 30px; }

        .btn-main {
            padding: 15px 40px;
            background: var(--primary);
            color: #000;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: 0.3s;
            display: inline-block;
        }
        .btn-main:hover { transform: scale(1.05); box-shadow: 0 0 20px rgba(30, 215, 96, 0.4); }

        /* --- Section A Propos --- */
        .section { padding: 100px 8%; }
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }
        .about-text h2 { font-size: 2.5rem; margin-bottom: 20px; }
        .about-text p { color: var(--text-gray); margin-bottom: 20px; font-size: 1.1rem; }
        .about-image img { width: 100%; border-radius: 20px; border-left: 8px solid var(--primary); }

        /* --- Commentaires (Testimonials) --- */
        .testimonials { background: #0f0f0f; text-align: center; }
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        .testi-card {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 20px;
            border-bottom: 4px solid #222;
            transition: 0.3s;
        }
        .testi-card:hover { border-color: var(--primary); transform: translateY(-5px); }
        .testi-card p { font-style: italic; color: var(--text-gray); margin-bottom: 20px; }
        .testi-card h4 { color: var(--primary); font-weight: 600; }

        

        @media (max-width: 768px) {
            .about-grid { grid-template-columns: 1fr; }
            .hero-content h1 { font-size: 2.5rem; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

    <?php include_once __DIR__ . '/../../public/includs/header.php'; ?>

    <section class="hero" id="home">
        <div class="hero-content">
            <h1>DÉPASSEZ VOS <span>LIMITES</span></h1>
            <p>Le meilleur accompagnement fitness personnalisé avec des experts certifiés pour transformer votre corps et votre esprit.</p>
            <a href="coaches.php" class="btn-main">Commencer Maintenant</a>
        </div>
    </section>

    <section class="section container" id="about">
        <div class="about-grid">
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&q=80&w=1470" alt="Entrainement">
            </div>
            <div class="about-text">
                <h2>Pourquoi Choisir <span>FitCoach</span>?</h2>
                <p>Chez FitCoach, nous croyons que chaque individu est unique. Nos programmes ne sont pas génériques, ils sont conçus spécifiquement pour vos objectifs, votre morphologie et votre emploi du temps.</p>
                <p>Avec plus de 500 coachs certifiés, nous vous garantissons un suivi de haute qualité, que ce soit pour une perte de poids, une prise de masse ou une préparation physique.</p>
                <a href="#" style="color: var(--primary); font-weight: 600; text-decoration: none;">En savoir plus →</a>
            </div>
        </div>
    </section>

    <section class="section testimonials">
        <h2>Ce Que Disent <span>Nos Clients</span></h2>
        <div class="testimonials-grid">
            <div class="testi-card">
                <p>"Grâce à mon coach sur FitCoach, j'ai perdu 10kg en 3 mois tout en restant motivé. L'interface est super simple !"</p>
                <h4>- Amine. R</h4>
            </div>
            <div class="testi-card">
                <p>"La qualité des coachs est incroyable. On sent qu'ils sont experts et passionnés par ce qu'ils font."</p>
                <h4>- Sarah. L</h4>
            </div>
            <div class="testi-card">
                <p>"Le système de réservation est fluide. Je peux planifier mes séances en fonction de mon travail sans stress."</p>
                <h4>- Karim. M</h4>
            </div>
        </div>
    </section>

    <?php include_once __DIR__ . '/../../public/includs/footer.php'; ?>


</body>
</html>