<?php
include 'components/header.php';
include 'database/config.php';

if (isset($_SESSION['status_message'])) : ?>
  <div class="max-w-6xl mx-auto px-4 pt-4">
    <div class="rounded bg-emerald-100 text-emerald-800 px-4 py-3 text-sm font-medium">
      <?= $_SESSION['status_message'] ?>
    </div>
  </div>
  <?php unset($_SESSION['status_message']); ?>
<?php endif;

$reviews = $conn->prepare("SELECT
    r.review_id,
    r.review_text,
    r.created_at,
    r.status,
    u.username,
    s.show_name
FROM reviews r
INNER JOIN users u ON r.user_id = u.user_id
INNER JOIN shows s ON r.show_id = s.show_id
ORDER BY r.created_at DESC");

$reviews->execute();
$reviews->store_result();
$reviews->bind_result($rid, $reviewText, $created, $status, $username, $showTitle);
?>

<div class="flex min-h-screen">
  <div class="hidden md:flex flex-col w-64 bg-[#8B0000]">
    <div class="flex items-center justify-center h-16 bg-[#8B0000]">
      <span class="text-white font-bold uppercase">Admin Panel</span>
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">
      <nav class="flex-1 px-2 py-4 bg-[#8B0000]">
        <a href="<?= ROOT_DIR ?>admin/dashboard" class="flex items-center px-4 py-2 text-white hover:bg-red-900">Dashboard</a>
        <a href="<?= ROOT_DIR ?>admin/comments" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Manage Comments</a>
        <a href="<?= ROOT_DIR ?>admin/manage-blogs" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Manage Blogs</a>
        <a href="<?= ROOT_DIR ?>admin/manage-reviews" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Manage Reviews</a>
      </nav>
    </div>
  </div>

  <div class="flex-1 p-6 overflow-x-auto">
    <table class="min-w-full bg-white">
      <thead class="bg-gray-100 whitespace-nowrap">
        <tr>
          <th class="p-4 text-left">Review ID</th>
          <th class="p-4 text-left">User</th>
          <th class="p-4 text-left">Show</th>
          <th class="p-4 text-left">Review</th>
          <th class="p-4 text-left">Status</th>
          <th class="p-4 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($reviews->fetch()) : ?>
          <tr class="hover:bg-gray-50">
            <td class="p-4"><?= htmlspecialchars($rid) ?></td>
            <td class="p-4"><?= htmlspecialchars($username) ?></td>
            <td class="p-4"><?= htmlspecialchars($showTitle) ?></td>
            <td class="p-4"><?= htmlspecialchars($reviewText) ?></td>
            <td class="p-4"><?= htmlspecialchars($status) ?></td>
            <td class="p-4">
              <div class="flex space-x-2">
                <?php if ($status === 'pending' || $status === 'rejected') : ?>
                  <a href="approveReviewController?rid=<?= urlencode($rid) ?>" class="bg-green-500 hover:bg-green-600 text-white text-sm py-1 px-2 rounded">Approve</a>
                <?php endif; ?>
                <?php if ($status === 'pending' || $status === 'approved') : ?>
                  <a href="rejectReviewController?rid=<?= urlencode($rid) ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm py-1 px-2 rounded">Reject</a>
                <?php endif; ?>
                <button class="modal-show bg-red-500 hover:bg-red-600 text-white text-sm py-1 px-2 rounded" data-review-id="<?= $rid ?>">Delete</button>
              </div>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

    <div id="modal" class="hidden fixed inset-0 p-4 flex justify-center items-center z-[1000] before:fixed before:inset-0 before:bg-black before:opacity-50">
      <div class="bg-white shadow-lg rounded-lg p-6 relative max-w-md w-full">
        <h3 class="text-lg font-bold mb-4">Delete Review</h3>
        <p class="text-sm text-gray-600">Are you sure you want to delete review ID <span id="modal_review_id"></span>?</p>
        <div class="mt-6 flex justify-end gap-3">
          <button id="close" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Cancel</button>
          <button id="delete_button" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('.modal-show').forEach(button => {
    button.addEventListener("click", function () {
      const reviewId = this.getAttribute('data-review-id');
      document.getElementById('modal').classList.remove('hidden');
      document.getElementById('modal_review_id').textContent = reviewId;
      document.getElementById('delete_button').onclick = function () {
        window.location.href = `deleteReviewController?rid=${encodeURIComponent(reviewId)}`;
      };
    });
  });

  document.getElementById('close').addEventListener("click", function () {
    document.getElementById('modal').classList.add('hidden');
  });
</script>
