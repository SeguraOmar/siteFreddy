<?php
require_once '../models/Formation.php';
$formations = Formation::getFormationIA();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Formations IA</title>
</head>

<body class="bg-gray-200">
    <nav class="flex items-center justify-between bg-gray-800 p-4">
        <div class="flex items-center space-x-2">
            <span id="logo" class="text-white text-5xl my-2 lg:my-0 lg:ml-36 transition-all duration-300">MFB</span>
            <span class="text-white text-4xl"> | </span>
            <a href="../controllers/controller-home.php" class="text-white text-xl my-2 hover:underline">Formation aux métiers<br> du Cloud et de l'IA</a>
        </div>
        <div class="flex items-center space-x-16 mr-6 lg:mr-36">
            <a href="../controllers/controller-panier.php">
                <button class="text-white font-bold hidden lg:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </button>
            </a>
        </div>
    </nav>

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Formations en Intelligence Artificielle</h1>
        <?php if (!empty($formations)) : ?>
            <ul class="space-y-4">
                <?php foreach ($formations as $index => $formation) : ?>
                    <li class="rounded ">
                        <div class="p-4">
                            <h2 class="text-2xl font-bold"><?= htmlspecialchars($formation['Titre']) ?></h2>
                            <p class="text-gray-700"><?= htmlspecialchars($formation['Description']) ?></p>
                            <p class="text-gray-700"><?= htmlspecialchars($formation['Durée']) ?> heures</p>
                            <p class="text-gray-700"><?= htmlspecialchars($formation['Prix']) ?> €</p>
                        </div>
                        <button class="btnAjouterPanier bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-id-formation="<?= htmlspecialchars($formation['ID_formation']) ?>">Ajouter au panier</button>
                    </li>
                    <?php if ($index < count($formations) - 1) : ?>
                        <hr class="my-4 border-gray-300">
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="text-gray-700">Aucune formation disponible pour le moment.</p>
        <?php endif; ?>
    </div>




    <script src="../script/IA.js"></script>
</body>

</html>