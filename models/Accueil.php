<?php
function updateAccueilMessage($bdd, $msg_accueil, $id_msg)
{
    $sql = "UPDATE accueil SET msg_accueil = ? WHERE id_msg_accueil = ?";
    $stmt = $bdd->prepare($sql);
    return $stmt->execute([$msg_accueil, $id_msg]);
}

function updateAProposDeNous($bdd, $paragraphe_un, $paragraphe_deux, $paragraphe_trois, $paragraphe_quatre, $id_msg)
{
    $sql = "UPDATE a_propos_de_nous SET paragraphe_un = ?, paragraphe_deux = ?, paragraphe_trois = ?, paragraphe_quatre = ? WHERE id_msg_accueil = ?";
    $stmt = $bdd->prepare($sql);
    return $stmt->execute([$paragraphe_un, $paragraphe_deux, $paragraphe_trois, $paragraphe_quatre, $id_msg]);
}

function updateHoraireOuverture($bdd, $horaire_matin, $horaire_apres_midi, $i)
{
    $sql = "UPDATE horaire_ouverture SET horaire_matin = ?, horaire_apres_midi = ? WHERE id_horaire_ouverture = ?";
    $stmt = $bdd->prepare($sql);
    return $stmt->execute([$horaire_matin, $horaire_apres_midi, $i]);
}