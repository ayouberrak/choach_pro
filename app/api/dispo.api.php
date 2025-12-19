<?php
// 1. Session check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once __DIR__ . '/../models/dispo.models.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Méthode non autorisée"
    ]);
    exit;
}

$id_coach = $_SESSION['user_id'] ?? null;

if (!$id_coach) {
    echo json_encode([
        "status" => "error",
        "message" => "Coach non authentifié"
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$jour         = $data['day']   ?? null;
$heures_debut = $data['start'] ?? null;
$heures_fin   = $data['end']   ?? null;

if (!$jour || !$heures_debut || !$heures_fin) {
    echo json_encode([
        "status" => "error",
        "message" => "Champs manquants"
    ]);
    exit;
}

if ($heures_debut >= $heures_fin) {
    echo json_encode([
        "status" => "error",
        "message" => "Heure de fin invalide"
    ]);
    exit;
}

$res = insertDispo($id_coach, $jour, $heures_debut, $heures_fin);

if ($res) {
    echo json_encode([
        "status" => "success",
        "message" => "Disponibilité ajoutée"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Erreur insertion"
    ]);
}
