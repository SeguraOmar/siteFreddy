<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>

    <nav class="flex items-center justify-between bg-gray-800 p-4">
        <div class="flex items-center space-x-2">
            <span id="logo" class="text-white text-5xl my-2 lg:my-0 lg:ml-36 transition-all duration-300">Freddy</span>
            <span class="text-white text-4xl"> | </span>
            <a href="../controllers/controller-home.php"><span class="text-white text-xl my-2">Formation aux métiers<br> du Cloud et de l'IA</span></a>
        </div>

        <div class="flex items-center space-x-16 mr-6 lg:mr-36">
            <!-- Menu pour les grands écrans -->
            <button class="text-white font-bold hidden lg:flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <a href="../controllers/controller-contact.php"><span class="ml-2 hover:underline">Nous contacter</span></a>
            </button>

            <a href="../controllers/controller-panier.php"><button class="text-white font-bold hidden lg:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </button></a>

            <div class="relative" id="clientContainer">
                <button class="text-white font-bold hidden lg:flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="ml-2 hover:underline">Espace client</span>
                </button>
                <div class="absolute hidden bg-gray-800 p-4 top-10 right-0" id="clientMenu">
                    <a href="../controllers/controller-signin.php"><button class="text-white font-bold block mt-3 hover:underline">
                            Connexion
                        </button></a>
                    <a href="../controllers/controller-signup.php"><button class="text-white font-bold block mt-3 hover:underline">
                            Inscription
                        </button></a>
                </div>
            </div>




            <!-- Menu burger pour les petits écrans -->
            <div class="lg:hidden menu-burger">
                <button id="menuToggle" class="text-white font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <div id="menu" class="hidden bg-gray-800 p-4 absolute top-16 left-0 w-full mt-16">
                    <button class="text-white font-bold block mb-2">
                        Nous contacter
                    </button>
                    <button class="text-white font-bold block mb-2">
                        Espace client
                    </button>
                    <!-- Panier -->
                    <button class="text-white font-bold block mb-2">
                        Panier
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex items-center justify-center h-screen bg-gray-200">
        <form id="signup-form" action="../controllers/controller-signup.php" method="post" class="bg-white p-10 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-10 text-center">Inscription</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="Nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="Nom" id="Nom" class="form-input rounded-md border border-black" value="<?= isset($_POST['Nom']) ? htmlspecialchars($_POST['Nom']) : '' ?>">
                    <span class="text-red-500">
                        <?= isset($errors['Nom']) ? $errors['Nom'] : '' ?>
                    </span>
                </div>
                <div>
                    <label for="Prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" name="Prenom" id="Prenom" class="form-input rounded-md border border-black" value="<?= isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : '' ?>">
                    <span class="text-red-500">
                        <?= isset($errors['Prenom']) ? $errors['Prenom'] : '' ?>
                    </span>
                </div>
                <div>
                    <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="Email" id="Email" class="form-input rounded-md border border-black" value="<?= isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : '' ?>">
                    <span class="text-red-500">
                        <?= isset($errors['Email']) ? $errors['Email'] : '' ?>
                    </span>
                </div>
                <div>
                    <label for="Mot_de_passe" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="Mot_de_passe" id="Mot_de_passe" class="form-input rounded-md border border-black">
                    <span class="text-red-500">
                        <?= isset($errors['Mot_de_passe']) ? $errors['Mot_de_passe'] : '' ?>
                    </span>
                </div>
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-input rounded-md border border-black">
                    <span class="text-red-500">
                        <?= isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?>
                    </span>
                </div>
                <!-- Affichage du message de succès -->
                <?php if (isset($success_message)) : ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Inscription réussie !</strong>
                        <span class="block sm:inline"><?= $success_message ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-5">S'inscrire</button>
            <a href="../controllers/controller-signin.php"><button type="submit" name="login_submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-5">Connexion</button></a>


        </form>
    </div>




    <footer class="bg-gray-800 py-4 w-full">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <div class="text-white">
                    &copy; 2024 Freddy. Tous droits réservés.
                </div>
                <div class="text-white">
                    Suivez-nous sur les réseaux sociaux:
                    <a href="#" class="text-blue-500 ml-2">Facebook</a>
                    <a href="#" class="text-blue-500 ml-2">Twitter</a>
                    <a href="#" class="text-blue-500 ml-2">Instagram</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="../script/navbar.js"></script>

</body>

</html>