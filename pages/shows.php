<?php
include 'database/config.php';
include 'components/header.php';
?>

<div class="py-8 px-4 max-w-6xl mx-auto">
  <!-- Search / Filter like theirs (optional) -->
  <div class="flex flex-wrap items-center gap-4 mb-8">
    <input type="text" placeholder="Search shows" class="flex-1 min-w-[200px] px-4 py-2 border rounded">
    <select class="px-4 py-2 border rounded">
      <option>All</option>
      <option>Musicals</option>
      <option>Plays</option>
      <option>Kids</option>
    </select>
  </div>

  <!-- Show list/table -->
  <div class="space-y-6">
    <!-- Repeat this block per show -->
    <div class="flex flex-col sm:flex-row bg-white rounded shadow hover:shadow-lg transition overflow-hidden">
      <img src="<?= ROOT_DIR?>assets/Chicago.jpg" alt="Show 1" class="w-full sm:w-1/3 h-48 object-cover">
      <div class="p-4 flex-1 flex flex-col justify-between">
        <div>
          <h2 class="text-2xl font-semibold mb-2">Show Title One</h2>
          <p class="text-gray-600">Aug 10 – Sep 5, 2025 • West End Theatre • 2h 15m</p>
          <p class="mt-3 text-gray-700">A bold new musical full of heart and spectacle…</p>
        </div>
        <div class="mt-4">
          <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Book Tickets</button>
        </div>
      </div>
    </div>

    <!-- Another show -->
    <div class="flex flex-col sm:flex-row bg-white rounded shadow hover:shadow-lg transition overflow-hidden">
      <img src="<?= ROOT_DIR?>assets/The Nutcracker.jpg" alt="Show 2" class="w-full sm:w-1/3 h-48 object-cover">
      <div class="p-4 flex-1 flex flex-col justify-between">
        <div>
          <h2 class="text-2xl font-semibold mb-2">Show Title Two</h2>
          <p class="text-gray-600">Sep 15 – Oct 10, 2025 • City Playhouse • 1h 45m</p>
          <p class="mt-3 text-gray-700">An intimate drama exploring family secrets…</p>
        </div>
        <div class="mt-4">
          <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Book Tickets</button>
        </div>
      </div>
    </div>
    <!-- Add more as needed -->
  </div>
</div>

<?php include 'components/footer.php'; ?>