<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELITE COACH - Login & Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/signUp.css">
    <script src="../../public/js/formSignup.js" defer></script> 
</head>
<body>
    <div class="container">
        <!-- Left Side - Branding -->
        <div class="brand-section">
            <div class="brand-content">
                <div class="logo">
                    <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="20" r="18" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 20L18 26L28 14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>ELITE COACH</span>
                </div>
                <h1>Transformez votre <span class="highlight">potentiel</span> en performance</h1>
                <p>Rejoignez les meilleurs coachs sportifs et atteignez vos objectifs avec un accompagnement personnalisé de classe mondiale.</p>
                
                <div class="stats">
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Coachs Certifiés</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">15K+</span>
                        <span class="stat-label">Athlètes Formés</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label">Satisfaction</span>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-avatar">
                        <img src="../../public/assests/profiles.jpeg" alt="Client">
                    </div>
                    <div class="testimonial-content">
                        <p>"Le meilleur investissement que j'ai fait pour ma carrière sportive."</p>
                        <span class="testimonial-author">— Marc D., Athlète Professionnel</span>
                    </div>
                </div>
            </div>
            <div class="brand-bg-image">
                <img src="../../public/assests/imageback.jpeg" alt="Athlete">
            </div>
        </div>

        <!-- Right Side - Forms -->
        <div class="form-section">
            <div class="form-container">
                <!-- Tab Switcher -->
                <div class="tab-switcher">
                    <button class="tab-btn active" data-tab="login">Connexion</button>
                    <button class="tab-btn" data-tab="register">Inscription</button>
                    <div class="tab-indicator"></div>
                </div>

                <?php require_once '../controllers/loginContoleur.php';?>
                <!-- Register Form -->
                <?php require_once '../controllers/signupControllers.php';?>


            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal" id="success-modal">
        <div class="modal-content">
            <div class="modal-icon success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <h3>Succès!</h3>
            <p id="modal-message">Votre compte a été créé avec succès.</p>
            <button class="modal-btn" onclick="closeModal()">Continuer</button>
        </div>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>
