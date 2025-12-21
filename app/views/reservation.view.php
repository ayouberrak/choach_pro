<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver votre séance - FitCoach Elite</title>
    <link rel="stylesheet" href="../../public/includs/header.css">
    <link rel="stylesheet" href="../../public/includs/footer.css">
        <script src="../../public/js/navbar.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760; 
            --primary-glow: rgba(30, 215, 96, 0.4);
            --bg-dark: #050505; 
            --card-bg: rgba(18, 18, 18, 0.9); 
            --input-bg: #1a1a1a;
            --text-white: #ffffff;
            --text-gray: #b0b0b0;
            --border: rgba(255, 255, 255, 0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); padding-top: 110px; }

        .container { max-width: 1200px; margin: 0 auto; padding: 20px; display: grid; grid-template-columns: 380px 1fr; gap: 40px; }

        /* --- Sidebar Coach --- */
        .coach-preview {
            background: var(--card-bg); border-radius: 35px; padding: 40px 30px; text-align: center;
            border: 1px solid var(--border); height: fit-content; position: sticky; top: 120px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        .coach-avatar { width: 160px; height: 160px; border-radius: 50%; object-fit: cover; border: 4px solid var(--primary); margin-bottom: 25px; box-shadow: 0 0 20px var(--primary-glow); }
        .coach-tag { background: rgba(30, 215, 96, 0.1); color: var(--primary); padding: 6px 18px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; margin-bottom: 20px; display: inline-block; }

        /* --- Reservation Form --- */
        .reservation-card { background: var(--card-bg); border-radius: 35px; padding: 45px; border: 1px solid var(--border); box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
        .reservation-card h3 { font-size: 1.8rem; font-weight: 800; margin-bottom: 30px; letter-spacing: -1px; }
        .reservation-card h3 span { color: var(--primary); }

        /* --- slots Section --- */
        .availability-section { margin-bottom: 35px; background: rgba(255,255,255,0.03); padding: 25px; border-radius: 20px; border: 1px solid var(--border); }
        .availability-section h4 { font-size: 1rem; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; color: var(--primary); }
        
        .slots-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 12px; max-height: 250px; overflow-y: auto; padding-right: 10px; }
        .slot-card {
            background: #111; border: 1px solid var(--border); padding: 12px; border-radius: 15px;
            text-align: center; cursor: pointer; transition: 0.3s;
        }
        .slot-card:hover { border-color: var(--primary); background: rgba(30, 215, 96, 0.05); }
        .slot-card.selected { background: var(--primary); border-color: var(--primary); }
        .slot-card.selected * { color: #000 !important; }
        .slot-card .date { display: block; font-size: 0.75rem; color: var(--text-gray); font-weight: 600; }
        .slot-card .time { display: block; font-size: 0.95rem; font-weight: 700; color: #fff; margin-top: 2px; }

        /* --- Form Elements --- */
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 10px; color: var(--text-gray); font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .form-control {
            width: 100%; padding: 15px 20px; background: var(--input-bg); border: 1px solid var(--border);
            border-radius: 15px; color: #fff; font-family: inherit; transition: 0.3s; font-size: 1rem;
        }
        .form-control:focus { outline: none; border-color: var(--primary); background: #222; }
        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .btn-submit {
            width: 100%; background: var(--primary); color: #000; border: none; padding: 20px;
            border-radius: 18px; font-weight: 800; font-size: 1.1rem; cursor: pointer;
            transition: 0.4s; text-transform: uppercase; letter-spacing: 1px;
            box-shadow: 0 10px 30px var(--primary-glow);
        }
        .btn-submit:hover { transform: translateY(-5px); box-shadow: 0 15px 40px var(--primary-glow); }

        /* Custom Scrollbar */
        .slots-grid::-webkit-scrollbar { width: 6px; }
        .slots-grid::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }

        @media (max-width: 950px) { .container { grid-template-columns: 1fr; } .coach-preview { position: relative; top: 0; } }
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
            <span class="coach-tag">Coach Elite Certifié</span>
            <p style="color: var(--text-gray); font-size: 0.9rem; margin-bottom: 20px;"><?= htmlspecialchars($coach_d['biographie']) ?></p>
            
            <div style="text-align: left; background: rgba(255,255,255,0.03); padding: 20px; border-radius: 20px; border: 1px solid var(--border);">
                <p style="font-size: 0.8rem; margin-bottom: 8px;">🏅 <strong>Expertise:</strong> <?= htmlspecialchars($coach_d['certification']) ?></p>
                <p style="font-size: 0.8rem;">⚡ <strong>Expérience:</strong> <?= htmlspecialchars($coach_d['annees_experiance']) ?> ans</p>
            </div>
        </aside>

        <section class="reservation-card">
            <h3>Réserver votre <span>Session</span></h3>
            
            <form action="" method="POST">
                
                <div class="availability-section">
                    <h4>📅 Créneaux disponibles</h4>
                    <div class="slots-grid">
                        <?php if(!empty($diaponibilites)): ?>
                            <?php foreach($diaponibilites as $dispo): ?>
                                <label class="slot-card" onclick="selectSlot(this)">
                                    <input type="radio" name="id_dispo" value="<?= $dispo['id_dispo'] ?>" style="display:none;" required>
                                    <span class="date"><?= date('d M', strtotime($dispo['jour'])) ?></span>
                                    <span class="time"><?= date('H:i', strtotime($dispo['heures_debut'])) ?></span>
                                </label>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="color: var(--text-gray); font-size: 0.8rem;">Aucun créneau disponible pour le moment.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label>Date souhaitée (Vérification)</label>
                        <input type="date" class="form-control" name="date_debut" required id="selected_date">
                    </div>
                    <div class="form-group">
                        <label>Heure</label>
                        <input type="time" class="form-control" name="heure_debut" required id="selected_time">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label>Durée</label>
                        <select class="form-control" name="duree" required>
                            <option value="60">1 Heure (Standard)</option>
                            <option value="90">1h 30min</option>
                            <option value="120">2 Heures</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Discipline</label>
                        <select class="form-control" name="type_sport" required>
                            <?php foreach($sport as $sp): ?>    
                                <option value="<?= $sp['sport_id'] ?>"><?= $sp['type'] ?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Notes ou Objectifs</label>
                    <textarea class="form-control" rows="3" name="objectif_principal" placeholder="Ex: Focus cardio, rééducation genou..."></textarea>
                </div>

                <div style="background: rgba(30, 215, 96, 0.05); padding: 25px; border-radius: 20px; border: 1px solid rgba(30, 215, 96, 0.2); margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <span style="display:block; font-size: 0.8rem; color: var(--text-gray); text-transform: uppercase;">Prix de la séance</span>
                        <strong style="color: var(--primary); font-size: 1.8rem;">200 MAD</strong>
                    </div>
                    <button type="submit" class="btn-submit" style="width: auto; padding: 15px 40px; margin: 0;">Réserver</button>
                </div>
            </form>
        </section>
    </main>

    <?php require_once __DIR__ .'/../../public/includs/footer.php'; ?>

    <script>
        function selectSlot(element) {
=            document.querySelectorAll('.slot-card').forEach(slot => {
                slot.classList.remove('selected');
            });
            
            element.classList.add('selected');
            

        }
    </script>
</body>
</html>