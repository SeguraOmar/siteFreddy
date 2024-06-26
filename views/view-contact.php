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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="bg-gray-100 p-10 rounded-lg">
            <h1 class="text-2xl font-bold text-center mb-5">Contactez-nous</h1>
            <?php if (!empty($success_message)) { ?>
                <p class="text-green-500"><?php echo $success_message; ?></p>
            <?php } ?>
            <?php if (!empty($error_message)) { ?>
                <p class="text-red-500"><?php echo $error_message; ?></p>
            <?php } ?>
            <div class="mb-5">
                <div class="flex flex-col">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>
            <div class="mb-5">
                <div class="flex flex-col">
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message" rows="4" class="mt-1 p-2 block w-full rounded-md border border-black shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md">Valider</button>
        </form>
    </div>







    <footer class="bg-gray-800 py-4 fixed bottom-0 w-full">
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
    <script src="../script/contact.js"></script>
</body>

</html>