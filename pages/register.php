<?php
include 'database/config.php';
include 'components/header.php';
?>

<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css">
<link href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css" rel="stylesheet">

<style>
  body {
    color: #1f2937; /* Tailwind's text-gray-800 */
  }
</style>

<!-- Register Page Layout -->
<div class="min-w-screen min-h-screen bg-gray-900 flex items-center justify-center px-5 py-5" class="min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('<?= ROOT_DIR?>assets/theatre-hall.jpg');">
  <div class="bg-white text-gray-700 rounded-3xl shadow-xl w-full overflow-hidden" style="max-width:1000px">

    <div class="md:flex w-full">
      <!-- Illustration Side -->
      <div class="hidden md:block w-1/2 bg-[#8B0000] py-10 px-10">
        <!-- SVG Illustration (shortened for brevity) -->
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="auto" viewBox="0 0 744.84799 747.07702"></svg>
      </div>

      <!-- Form Side -->
      <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
        <div class="text-center mb-10">
          <h1 class="font-bold text-3xl text-gray-900">REGISTER</h1>
          <p>Enter your information to register</p>
        </div>

        <!-- Status Message -->
        <?php if (isset($_SESSION['status_message'])) : ?>
          <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            <?= $_SESSION['status_message'] ?>
          </div>
          <?php unset($_SESSION['status_message']) ?>
        <?php endif ?>

        <form method="POST" action="registerController">
          <!-- Username -->
          <div class="flex -mx-3">
            <div class="w-full px-3 mb-5">
              <!-- <label class="text-xs font-semibold px-1">Username</label> -->
              <div class="flex">
                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                  <i class="mdi mdi-account-outline text-gray-400 text-lg"></i>
                </div>
                <input name="username" type="text" required class="w-full -ml-10 pl-10 pr-3 py-2 bg-[#ffe5e5] rounded-3xl outline-none " placeholder="Enter username">
              </div>
            </div>
          </div>

          <!-- Email -->
          <div class="flex -mx-3">
            <div class="w-full px-3 mb-5">
              <!-- <label class="text-xs font-semibold px-1">Email</label> -->
              <div class="flex">
                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                  <i class="mdi mdi-email-outline text-gray-400 text-lg"></i>
                </div>
                <input name="email" type="email" required class="w-full -ml-10 pl-10 pr-3 py-2 rounded-3xl border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="email@example.com">
              </div>
            </div>
          </div>

          <!-- Password -->
          <div class="flex -mx-3">
            <div class="w-full px-3 mb-5">
              <!-- <label class="text-xs font-semibold px-1">Password</label> -->
              <div class="flex">
                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                  <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                </div>
                <input name="password" type="password" required class="w-full -ml-10 pl-10 pr-3 py-2 rounded-3xl border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Password">
              </div>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="flex -mx-3">
            <div class="w-full px-3 mb-8">
              <!-- <label class="text-xs font-semibold px-1">Confirm Password</label> -->
              <div class="flex">
                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                  <i class="mdi mdi-lock-outline text-gray-400 text-lg"></i>
                </div>
                <input name="cpassword" type="password" required class="w-full -ml-10 pl-10 pr-3 py-2 rounded-3xl border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Confirm Password">
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="flex -mx-3">
            <div class="w-full px-3 mb-5">
              <button type="submit" name="register" class="block w-full max-w-xs mx-auto bg-[#8B0000] hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-3xl px-3 py-3 font-semibold ">
                SIGN UP
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include 'components/footer.php';
?>
