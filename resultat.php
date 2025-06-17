<?php
// Vérification si la session n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Classe abstraite
abstract class Animal {
    private string $nom;
    private int $age;
    private float $poids;

    // CONSTRUCTEUR
    public function __construct(string $nom, int $age, float $poids) {
        $this->nom = $nom;
        $this->age = $age;
        $this->poids = $poids;
    }

    // GETTERS
    public function getNom(): string {
        return $this->nom;
    }

    public function getAge(): int {
        return $this->age;
    }

    public function getPoids(): float {
        return $this->poids;
    }

    // SETTERS
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setAge(int $age): void {
        $this->age = $age;
    }

    public function setPoids(float $poids): void {
        $this->poids = $poids;
    }

    // METHODES
    public function getType(): string {
        return get_class($this);
    }

    abstract public function crier(): string;
}

// Classe enfants
class Chien extends Animal {
    const ESPECE = "Canidé";

    public function crier(): string {
        return "Wouf Wouf";
    }
}

class Chat extends Animal {
    const ESPECE = "Félin";

    public function crier(): string {
        return "Miaou";
    }
}

class Perroquet extends Animal {
    const ESPECE = "Oiseau";

    public function crier(): string {
        return "Cui Cui";
    }
}

// Gestion des formulaires de modification et de suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'modifier':
            if (isset($_SESSION['animal']) && isset($_POST['age']) && isset($_POST['poids'])) {
                $_SESSION['animal']->setAge((int)$_POST['age']);
                $_SESSION['animal']->setPoids((float)$_POST['poids']);
            }
            break;
        case 'supprimer':
            unset($_SESSION['animal']);
            break;
    }
}

// Si on est sur la page résultat.php, on affiche l'HTML
if (basename($_SERVER['PHP_SELF']) === 'resultat.php') {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Animaux</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .info-animal {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input, button {
            margin: 5px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Animaux</h1>

    <?php if (isset($_SESSION['animal'])): ?>
        <div class="info-animal">
            <h2>Informations de l'animal</h2>
            <p>Type : <?php echo $_SESSION['animal']->getType(); ?></p>
            <p>Nom : <?php echo $_SESSION['animal']->getNom(); ?></p>
            <p>Age : <?php echo $_SESSION['animal']->getAge(); ?></p>
            <p>Poids : <?php echo $_SESSION['animal']->getPoids(); ?> kg</p>
            <p>Espèce : <?php echo constant($_SESSION['animal']->getType() . '::ESPECE'); ?></p>
            <p>Cri : <?php echo $_SESSION['animal']->crier(); ?></p>
        </div>

        <!-- Formulaire de modification -->
        <form method="POST">
            <h3>Modifier l'animal</h3>
            <input type="hidden" name="action" value="modifier">
            <label>Age: <input type="number" name="age" value="<?php echo $_SESSION['animal']->getAge(); ?>" required></label>
            <label>Poids: <input type="number" step="0.1" name="poids" value="<?php echo $_SESSION['animal']->getPoids(); ?>" required></label>
            <button type="submit">Modifier</button>
        </form>

        <!-- Formulaire de suppression -->
        <form method="POST">
            <input type="hidden" name="action" value="supprimer">
            <button type="submit">Supprimer l'animal</button>
        </form>
    <?php else: ?>
        <p>Aucun animal</p>
        <p><a href="formulaire.php">Ajouter un animal</a></p>
    <?php endif; ?>
</body>
</html>
<?php
}
?>