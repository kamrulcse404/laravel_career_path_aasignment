<?php

session_start();

if (isset($_SESSION['loginSuccess'])) {
    header("Location: http://localhost:8000/views/dashboard.php");
    exit;
}

$errors = [];
$registerSuccess = [];
$loginError = [];

if (isset($_SESSION['loginError'])) {
    $loginError = $_SESSION['loginError'];
}

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

if (isset($_SESSION['registerSuccess'])) {
    $registerSuccess = $_SESSION['registerSuccess'];
}

require_once(__DIR__ . '/partials/header.php');
?>

<main class="">
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="./images/beams.jpg" alt="" class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
        <div class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
            <div class="mx-auto max-w-xl">
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">

                    <?php if ($registerSuccess['success']) : ?>
                        <p class="text-base text-green-600 mt-2 text-center"><?php echo $registerSuccess['success'] ?></p>
                    <?php elseif ($loginError['not_reg']) : ?>
                        <p class="text-base text-red-600 mt-2 text-center"><?php echo $loginError['not_reg'] ?></p>
                    <?php elseif ($loginError['email_not_found']) : ?>
                        <p class="text-base text-red-600 mt-2 text-center"><?php echo $loginError['email_not_found'] ?></p>
                    <?php endif; ?>


                    <div class="mx-auto w-full max-w-xl text-center px-24">
                        <h1 class="block text-center font-bold text-2xl bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">TruthWhisper</h1>
                    </div>

                    <div class="mt-10 mx-auto w-full max-w-xl">
                        <form class="space-y-6" action="../app/controllers/LoginController.php" method="POST">
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <?php if ($errors['email']) : ?>
                                    <p class="text-xs text-red-600 mt-2"><?php echo $errors['email'] ?></p>
                                <?php elseif ($loginError['login_error']) : ?>
                                    <p class="text-xs text-red-600 mt-2"><?php echo $loginError['login_error'] ?></p>
                                <?php endif; ?>


                            </div>

                            <div>
                                <div class="flex items-center justify-between">
                                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    <div class="text-sm">
                                        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input id="password" name="password" type="password" autocomplete="current-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <?php if ($errors['password']) : ?>
                                    <p class="text-xs text-red-600 mt-2"><?php echo $errors['password'] ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                            </div>
                        </form>

                        <p class="mt-10 text-center text-sm text-gray-500">
                            Not a member?
                            <a href="./register.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register now!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once(__DIR__ . '/partials/footer.php');
session_destroy();
?>