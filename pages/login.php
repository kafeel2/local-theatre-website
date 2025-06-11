<?php
include 'database/config.php';
include 'components/header.php';
?>
<body class="min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('<?= ROOT_DIR?>assets/theatre-hall.jpg');">
  <div class="min-h-screen font-[sans-serif] flex items-center justify-center p-4">
    <div class="shadow-[0_2px_16px_-3px_rgba(6,81,237,0.3)] max-w-6xl max-md:max-w-lg rounded-3xl p-6 bg-white">
     
      <div class="grid md:grid-cols-2 items-center gap-8 rounded-3xl">
        <div class="bg-[#8B0000] text-white font-[Cabin_Condensed] text-3xl font-semibold p-6 text-center leading-tight">
          Experience the<br>Magic of Live<br>Theatre
        </div>

        <?php if (isset($_SESSION['status_message'])) : ?>
        <div class="status-message"><?= $_SESSION['status_message'] ?></div>
        <?php unset($_SESSION['status_message']) ?> <?php endif ?>

        <form action="loginController" method="POST" class="md:max-w-md w-full mx-auto">
        <div class="mb-12 relative flex items-center justify-center gap-16">
            <h3 class="cursor-default text-4xl font-bold text-black">Login</h3>
            <img src="<?= ROOT_DIR?>assets/logo.png" alt="logo" class="w-12 cursor-default">
        </div>


          <div>
            <div class="relative flex items-center">
             <input name="email" type="email" required class="px-4 py-3 text-slate-900 bg-[#ffe5e5] w-full text-sm outline-none border-b-2 border-transparent rounded-3xl"  placeholder="Enter Email"/>
              <!-- SVG omitted for brevity -->
            </div>
          </div>

          <div class="mt-8">
            <div class="relative flex items-center">
              <input name="password" type="password" required class="px-4 py-3 text-slate-900 bg-[#ffe5e5] w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded-3xl" placeholder="Enter password" />
              <!-- SVG omitted for brevity -->
            </div>
          </div>

          <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
            <div class="flex items-center">
              <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
              <label for="remember-me" class="text-black-800 ml-3 block text-sm">Remember me</label>
            </div>
            <div>
              <a href="javascript:void(0);" class="text-black-600 text-sm hover:underline">Forgot Password?</a>
            </div>
          </div>

          <div class="mt-12">
            <button type="submit" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold tracking-wide rounded-3xl text-white bg-[#8B0000] hover:bg-red-700 focus:outline-none">
              Login
            </button>
            <p class="text-gray-800 text-sm text-center mt-6">Don't have an account 
              <a href="javascript:void(0);" class="text-[#8B0000] font-semibold hover:underline ml-1 whitespace-nowrap">Register here</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<?php include 'components/footer.php'; ?>
