<?php
// session_start(); ← leave this commented out if it's already in header.php
include 'components/header.php';
include 'database/config.php';

// ✅ FLASH MESSAGE BLOCK
if (isset($_SESSION['status_message'])) : ?>
  <div class="max-w-6xl mx-auto px-4 pt-4">
    <div class="rounded bg-emerald-100 text-emerald-800 px-4 py-3 text-sm font-medium">
      <?= $_SESSION['status_message'] ?>
    </div>
  </div>
  <?php unset($_SESSION['status_message']); ?>
<?php endif;

// Fetch comments with user and blog info
$comments = $conn->prepare("SELECT
    c.comment_id,
    c.comment_text,
    c.comment_created,
    c.status,
    u.username,
    b.blog_title
FROM comments c
INNER JOIN users u ON c.user_id = u.user_id
INNER JOIN blogs b ON c.blog_id = b.blog_id
ORDER BY c.comment_created DESC");

$comments->execute();
$comments->store_result();
$comments->bind_result($cid, $commentText, $created, $status, $username, $blogTitle);
?>

<!-- Start layout with sidebar -->
<div class="flex min-h-screen">
  <!-- Sidebar -->
  <div class="hidden md:flex flex-col w-64 bg-[#8B0000]">
    <div class="flex items-center justify-center h-16 bg-[#8B0000]">
      <span class="text-white font-bold uppercase">Admin Panel</span>
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">
      <nav class="flex-1 px-2 py-4 bg-[#8B0000]">
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a href="<?= ROOT_DIR ?>admin/dashboard" class="flex items-center px-4 py-2 text-white hover:bg-red-900">
            Dashboard
          </a>
        <?php endif; ?>

        <a href="<?= ROOT_DIR ?>admin/comments" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">
          Manage Comments
        </a>

        <a href="<?= ROOT_DIR ?>admin/manage-blogs" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">
          Manage Blogs
        </a>

        <a href="<?= ROOT_DIR ?>admin/reviews" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">
          Manage Reviews
        </a>

        <a href="<?= ROOT_DIR ?>admin/messages" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">
          Messages
        </a>

        <a href="<?= ROOT_DIR ?>admin/settings" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">
          Settings
        </a>
      </nav>
    </div>
  </div>

  <!-- Main content -->
  <div class="flex-1 p-6 overflow-x-auto">
    <table class="min-w-full bg-white">
      <thead class="bg-gray-100 whitespace-nowrap">
        <tr>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">Comment ID</th>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">User</th>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">Blog Title</th>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">Comment</th>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">Status</th>
          <th class="p-4 text-left text-[13px] font-semibold text-slate-900">Actions</th>
        </tr>
      </thead>
      <tbody class="whitespace-nowrap">
        <?php while ($comments->fetch()) : ?>
          <tr class="hover:bg-gray-50">
            <td class="p-4 text-[15px] text-slate-900 font-medium"><?= htmlspecialchars($cid) ?></td>
            <td class="p-4 text-[15px] text-slate-600 font-medium"><?= htmlspecialchars($username) ?></td>
            <td class="p-4 text-[15px] text-slate-600 font-medium"><?= htmlspecialchars($blogTitle) ?></td>
            <td class="p-4 text-[15px] text-slate-600 font-medium"><?= htmlspecialchars($commentText) ?></td>
            <td class="p-4 text-[15px] text-slate-600 font-medium"><?= htmlspecialchars($status) ?></td>
            <td class="p-4">
              <div class="flex items-center space-x-2">
                <?php if ($status === 'pending' || $status === 'rejected') : ?>
                  <button type="button"
                    onclick="window.location.href='approveController?cid=<?= urlencode($cid) ?>'"
                    class="bg-green-500 hover:bg-green-600 text-white text-sm py-1 px-2 rounded">Approve</button>
                <?php endif; ?>
                <?php if ($status === 'pending' || $status === 'approved') : ?>
                  <button type="button"
                    onclick="window.location.href='rejectController?cid=<?= urlencode($cid) ?>'"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm py-1 px-2 rounded">Reject</button>
                <?php endif; ?>
                <button class="modal-show bg-red-500 hover:bg-red-600 text-white text-sm py-1 px-2 rounded"
                  data-comment-id="<?= $cid ?>">Delete</button>
              </div>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

    <!-- Delete modal -->
    <div id="modal" class="hidden fixed inset-0 p-4 flex justify-center items-center z-[1000] before:fixed before:inset-0 before:bg-black before:opacity-50">
      <div class="bg-white shadow-lg rounded-lg p-6 relative max-w-md w-full">
        <h3 class="text-lg font-bold mb-4">Delete Comment</h3>
        <p class="text-sm text-gray-600">Are you sure you want to delete comment ID <span id="modal_comment_id"></span>?</p>
        <div class="mt-6 flex justify-end gap-3">
          <button id="close" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Cancel</button>
          <button id="delete_button" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
        </div>
      </div>
    </div>
  </div> <!-- End main content -->
</div> <!-- End layout -->

<script>
  document.querySelectorAll('.modal-show').forEach(button => {
    button.addEventListener("click", function () {
      const commentId = this.getAttribute('data-comment-id');
      document.getElementById('modal').classList.remove('hidden');
      document.getElementById('modal_comment_id').textContent = commentId;
      document.getElementById('delete_button').onclick = function () {
        window.location.href = `deleteCommentController?cid=${encodeURIComponent(commentId)}`;
      };
    });
  });

  document.getElementById('close').addEventListener("click", function () {
    document.getElementById('modal').classList.add('hidden');
  });
</script>

<!-- <?php include 'components/footer.php'; ?> -->
