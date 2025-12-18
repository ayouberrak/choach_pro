<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver votre séance - FitCoach</title>
    <link rel="stylesheet" href="../../public/includs/header.css">
    <link rel="stylesheet" href="../../public/includs/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760; 
            --bg-dark: #0a0a0a; 
            --card-bg: #151515; 
            --input-bg: #222;
            --text-white: #ffffff;
            --text-gray: #a0a0a0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-white);
            line-height: 1.6;
            padding-top: 100px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 40px;
        }

        /* --- Section Coach Info --- */
        .coach-preview {
            background: var(--card-bg);
            border-radius: 25px;
            padding: 30px;
            text-align: center;
            border: 1px solid #222;
            height: fit-content;
        }

        .coach-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary);
            margin-bottom: 20px;
        }

        .coach-preview h2 { font-size: 1.8rem; margin-bottom: 10px; }
        .coach-tag {
            background: rgba(30, 215, 96, 0.1);
            color: var(--primary);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 20px;
        }
        .coach-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #222;
        }
        .stat-item span { display: block; color: var(--text-gray); font-size: 0.8rem; }
        .stat-item strong { font-size: 1.1rem; color: var(--primary); }

        /* --- Formulaire Style --- */
        .reservation-form {
            background: var(--card-bg);
            border-radius: 25px;
            padding: 40px;
            border: 1px solid #222;
        }

        .reservation-form h3 {
            font-size: 1.5rem;
            margin-bottom: 25px;
            border-left: 4px solid var(--primary);
            padding-left: 15px;
        }

        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: var(--input-bg);
            border: 1px solid #333;
            border-radius: 10px;
            color: #fff;
            font-family: inherit;
            transition: 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(30, 215, 96, 0.2);
        }

        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .btn-submit {
            width: 100%;
            background: var(--primary);
            color: #000;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(30, 215, 96, 0.3);
        }

        @media (max-width: 850px) {
            .container { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <?php require_once __DIR__ .'/../../public/includs/header.php'; ?>

    <main class="container">
        <aside class="coach-preview">
            <?php 
                $pathPhoto = (!empty($coach_d['photo']) && file_exists('../../public/uploadss/' .$coach_d['photo']))
                ? '../../public/uploadss/' . basename($coach_d['photo'])
                :'../../public/uploadss/default.jpeg'; 
            ?>
            <img src="<?= $pathPhoto ?>" alt="Coach" class="coach-avatar">
            <h2><?= htmlspecialchars($coach_d['nom']).' '. htmlspecialchars($coach_d['prenom']) ?></h2>
            <span class="coach-tag"><?= htmlspecialchars($coach_d['annees_experiance']) ?> Ans d'Expérience</span>
            <p style="color: var(--text-gray); font-size: 0.9rem; margin-bottom: 10px;">
                <?= htmlspecialchars($coach_d['biographie']) ?>
            </p>
            <p style="color: var(--primary); font-size: 0.85rem; font-weight: 600;">
                🏅 <?= htmlspecialchars($coach_d['certification']) ?>
            </p>
            <div class="coach-stats">
                <div class="stat-item">
                    <strong>8+</strong>
                    <span>Expérience</span>
                </div>
                <div class="stat-item">
                    <strong>150+</strong>
                    <span>Clients</span>
                </div>
            </div>
        </aside>

        <section class="reservation-form">
            <h3>Réserver votre séance</h3>
            <form action="" method="POST">
                
                <div class="row">
                    <div class="form-group">
                        <label>Date de début</label>
                        <input type="date" class="form-control" name="date_debut" required>
                    </div>
                    <div class="form-group">
                        <label>Heure de début</label>
                        <input type="time" class="form-control" name="heure_debut" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label>Durée de la séance</label>
                        <select class="form-control" name="duree" required>
                            <option value="30">30 min</option>
                            <option value="60" selected>1 heure</option>
                            <option value="90">1h 30 min</option>
                            <option value="120">2 heures</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type d'entrainement</label>
                        <select class="form-control" name="type_sport">
                            <option value="" disabled selected>choisi le sport</option>
                            <?php foreach($sport as $sp): ?>    
                                <option value="<?= $sp['sport_id'] ?>"><?= $sp['type'] ?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Objectif principal</label>
                    <textarea class="form-control" rows="4" name="objectif_principal" placeholder="Décrivez vos objectifs pour cette séance (Ex: Focus fessiers, amélioration endurance...)"></textarea>
                </div>

                <div style="background: rgba(30, 215, 96, 0.05); padding: 18px; border-radius: 15px; border: 1px solid rgba(30, 215, 96, 0.2); margin-bottom: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.95rem; font-weight: 500;">Total à régler :</span>
                        <strong style="color: var(--primary); font-size: 1.3rem;">200 MAD</strong>
                    </div>
                    <p style="color: #666; font-size: 0.75rem; margin-top: 5px;">* Séance individuelle soumise à validation du coach.</p>
                </div>

                <button type="submit" class="btn-submit">Confirmer la Réservation</button>
            </form>
        </section>
    </main>

    <?php require_once __DIR__ .'/../../public/includs/footer.php'; ?>
    <script src="../../public/js/navbar.js"></script>

</body>
</html>