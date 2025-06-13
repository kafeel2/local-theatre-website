<?php
include 'components/header.php';
include 'database/config.php';

$userId = $_SESSION['user_id'] ?? 0;

// Fetch user comments on blogs
$comments = $conn->prepare("SELECT 
  c.comment_id, 
  c.comment_text, 
  c.comment_created, 
  b.blog_title
FROM comments c
JOIN blogs b ON c.blog_id = b.blog_id
WHERE c.user_id = ? AND c.status = 'approved'
ORDER BY c.comment_created DESC");

$comments->bind_param("i", $userId);
$comments->execute();
$comments->store_result();
$comments->bind_result($cid, $commentText, $created, $blogTitle);

// Fetch user reviews on shows
$reviews = $conn->prepare("SELECT 
  r.review_id, 
  r.review_text, 
  r.created_at, 
  s.show_name
FROM reviews r
JOIN shows s ON r.show_id = s.show_id
WHERE r.user_id = ?
ORDER BY r.created_at DESC");
$reviews->bind_param("i", $userId);
$reviews->execute();
$reviews->store_result();
$reviews->bind_result($rid, $reviewText, $reviewDate, $showName);
?>


<div class="flex min-h-screen">
  <!-- Sidebar -->
  <div class="hidden md:flex flex-col w-64 bg-gray-800">
    <div class="flex items-center justify-center h-16 bg-[#8B0000]">
      <span class="text-white font-bold uppercase">User Panel</span>
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">
      <nav class="flex-1 px-2 py-4 bg-[#8B0000]">
        <a href="<?= ROOT_DIR ?>user/dashboard" class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700">Dashboard</a>
        <a href="<?= ROOT_DIR ?>shows" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">Browse Shows</a>
        <a href="<?= ROOT_DIR ?>user/settings" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">Account Settings</a>
      </nav>
    </div>
  </div>

  <!-- Main content -->
  <div class="flex-1 p-6 overflow-x-auto">
    <!-- Blog Comments -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Your Blog Comments</h2>
    <table class="min-w-full bg-white mb-10">
      <thead class="bg-gray-100 whitespace-nowrap">
        <tr>
          <th class="p-4 text-left text-sm font-semibold text-slate-900">Blog Title</th>
          <th class="p-4 text-left text-sm font-semibold text-slate-900">Comment</th>
          <th class="p-4 text-left text-sm font-semibold text-slate-900">Date</th>
          <th class="p-4 text-left text-sm font-semibold text-slate-900">Actions</th>
        </tr>
      </thead>
      <tbody class="whitespace-nowrap">
        <?php while ($comments->fetch()) : ?>
          <tr class="hover:bg-gray-50">
            <td class="p-4"><?= htmlspecialchars($blogTitle) ?></td>
            <td class="p-4"><?= htmlspecialchars($commentText) ?></td>
            <td class="p-4"><?= htmlspecialchars($created) ?></td>
            <td class="p-4">
              <a href="edit-comment?cid=<?= $cid ?>" class="text-blue-600 hover:underline">Edit</a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>

    <!-- Show Reviews -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Your Show Reviews</h2>
    <table class="min-w-full bg-white">
      <thead class="bg-gray-100 whitespace-nowrap">
        <tr>
          <th class="p-4 text-left text-sm font-semibold text-slate-900">Show</th>
          <th class="p-4 text-left text-sm font-semibold text-slate-900">Review</th>
          <th class="p-4 text-left text-sm font-semibold text-slate-900">Date</th>
          <th class="p-4 text-left text-sm font-semibold text-slate-900">Actions</th>
        </tr>
      </thead>
      <tbody class="whitespace-nowrap">
        <?php while ($reviews->fetch()) : ?>
          <tr class="hover:bg-gray-50">
            <td class="p-4"><?= htmlspecialchars($showName) ?></td>
            <td class="p-4"><?= htmlspecialchars($reviewText) ?></td>
            <td class="p-4"><?= htmlspecialchars($reviewDate) ?></td>
            <td class="p-4">
              <a href="edit-review?rid=<?= $rid ?>" class="text-blue-600 hover:underline">Edit</a>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
  </div>
</div>
