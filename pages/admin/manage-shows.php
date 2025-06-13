<?php
include 'components/header.php';
include 'database/config.php';

$shows = $conn->prepare("SELECT
    s.show_id,
    s.show_name,
    s.date_shown,
    s.show_type
  FROM shows s
  ORDER BY s.date_shown");

$shows->execute();
$shows->store_result();
$shows->bind_result($sid, $showName, $dateShown, $showType);
?>

<div class="flex min-h-screen">
  <!-- Sidebar -->
  <div class="hidden md:flex flex-col w-64 bg-[#8B0000]">
    <div class="flex items-center justify-center h-16 bg-[#8B0000]">
      <span class="text-white font-bold uppercase">Admin Panel</span>
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">
      <nav class="flex-1 px-2 py-4 bg-[#8B0000]">
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a href="<?= ROOT_DIR ?>admin/dashboard" class="flex items-center px-4 py-2 text-white hover:bg-red-900">Dashboard</a>
        <?php endif; ?>
        <a href="<?= ROOT_DIR ?>admin/comments" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Manage Comments</a>
        <a href="<?= ROOT_DIR ?>admin/manage-blogs" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Manage Blogs</a>
        <a href="<?= ROOT_DIR ?>admin/manage-reviews" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Manage Reviews</a>
        <a href="<?= ROOT_DIR ?>admin/messages" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Messages</a>
        <a href="<?= ROOT_DIR ?>admin/settings" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Settings</a>
      </nav>
    </div>
  </div>

  <!-- Main content -->
  <div class="flex-1 p-6 overflow-x-auto">
  
    <!-- Add Show Button -->
    <div class="flex justify-end mb-4">
      <button type="button"
        onclick="window.location.href='add-show?sid=new'"
        class="text-sm bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        title="Add Show">
        + Add Show
      </button>
    </div>

    <table class="min-w-full bg-white">
      <thead class="bg-gray-100 whitespace-nowrap">
        <tr>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">Show ID</th>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">Show Title</th>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">Show Type</th>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">Date Shown</th>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">Actions</th>
        </tr>
      </thead>
      <tbody class="whitespace-nowrap">
        <?php while ($shows->fetch()) : ?>
          <tr class="hover:bg-gray-50">
            <td class="p-4 text-[15px] text-slate-900 font-medium"><?= htmlspecialchars($sid) ?></td>
            <td class="p-4 text-[15px] text-slate-600 font-medium"><?= htmlspecialchars($showName) ?></td>
            <td class="p-4 text-[15px] text-slate-600 font-medium"><?= htmlspecialchars($showType) ?></td>
            <td class="p-4 text-[15px] text-slate-600 font-medium"><?= htmlspecialchars($dateShown) ?></td>
            <td class="p-4">
              <div class="flex items-center space-x-2">
                <button type="button"
                  onclick="window.location.href='edit-show?sid=<?= urlencode($sid) ?>'"
                  class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                  title="Edit">
                  Edit
                </button>
                <button class="modal-show" data-show-id="<?= $sid ?>" title="Delete">Delete</button>
              </div>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

    <!-- Delete Modal -->
    <div id="modal" class="hidden fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
      <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-6 relative">
        <div class="flex items-center pb-3 border-b border-gray-300">
          <h3 class="text-gray-800 text-xl font-bold flex-1">Delete?</h3>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500" viewBox="0 0 320.591 320.591">
            <path d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"/>
            <path d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"/>
          </svg>
        </div>
        <div class="my-6">
          <p class="text-gray-600 text-sm leading-relaxed">
            Are you sure you want to delete the show with ID <span id="modal_show_id"></span>?
          </p>
        </div>
        <div class="border-t border-gray-300 pt-6 flex justify-end gap-4">
          <button type="button" id="close" class="px-4 py-2 rounded-lg text-gray-800 text-sm bg-gray-200 hover:bg-gray-300">Close</button>
          <button type="button" id="delete_button" class="px-4 py-2 rounded-lg text-white text-sm bg-blue-600 hover:bg-blue-700">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('.modal-show').forEach(button => {
    button.addEventListener("click", function () {
      const showId = this.getAttribute('data-show-id');
      document.getElementById('modal').classList.remove('hidden');
      document.getElementById('modal_show_id').textContent = showId;
      document.getElementById('delete_button').onclick = function () {
        window.location.href = `deleteShowController?sid=${encodeURIComponent(showId)}`;
      };
    });
  });

  document.getElementById('close').addEventListener("click", function () {
    document.getElementById('modal').classList.add('hidden');
  });
</script>
