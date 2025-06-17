<?php
session_start();

// Inclusion des classes avant session_start
require_once 'resultat.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = (string)$_POST['animal'];
    $nom = (string)$_POST['nom'];
    $age = (int)$_POST['age'];
    $poids = (float)$_POST['poids'];

    // Création de l'animal en fonction du type sélectionné
    switch ($type) {
        case 'chien':
            $_SESSION['animal'] = new Chien($nom, $age, $poids);
            break;
        case 'chat':
            $_SESSION['animal'] = new Chat($nom, $age, $poids);
            break;
        case 'perroquet':
            $_SESSION['animal'] = new Perroquet($nom, $age, $poids);
            break;
    }
    
    // Redirection vers resultat.php
    header('Location: resultat.php');
    exit();
}
?>


<!-- Formulaire récupéré sur internet, et modifier pour matché avec ce qui était demandé -->
<style>
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    h2 {
        text-align: center;
    }

    label {
        display: block;
        padding-bottom: 0.2em;
        padding-top: 1em;
    }

    label strong {
        display: block;
        font-size: 0.9rem;
        color: #BB5879;
    }

    input,
    textarea {
        padding: 0.4em 0.3em;
        font-size: 1.5em;
        border: 1px solid #BBB;
        min-width: 100%;
        max-width: 90%;
    }

    input[type="submit"] {
        min-width: 0;
        background-color: #BB5879;
        border: 0;
        border-radius: 0.2em;
        padding: 13px 30px;
        margin-top: 10px;
        font-size: 1em;
        text-transform: uppercase;
        font-weight: bold;
        color: white;
        transition: background-color 0.2s ease;
    }

    input[type="submit"]:hover {
        cursor: pointer;
        background-color: #555;
    }
</style>

<section id="contact" class="contact-me container">
    <div class="container-content">
        <h2>Ajouter un animal</h2>
        <div class="content">
            <form action="formulaire.php" method="post">
                <select name="animal" size="3" required>
                    <option value="chien">Chien</option>
                    <option value="chat">Chat</option>
                    <option value="perroquet">Perroquet</option>
                </select>
                <p>
                    <label for="name">Nom</label>
                    <input id="name" type="text" name="nom" placeholder="Nom" required>
                </p>
                <p>
                    <label for="age">Age</label>
                    <input id="age" type="number" name="age" placeholder="Age" required>
                </p>
                <p>
                    <label for="poids">Poids</label>
                    <input id="poids" type="number" name="poids" placeholder="Poids" required>
                </p>
                <p>
                    <input type="submit" value="Valider" />
                </p>
            </form>
        </div>
    </div>
</section>
