<?php
include 'components/header.php';
include 'database/config.php';

$uid = isset($_GET['uid']) ? (int) $_GET['uid'] : 0;

// Fetch user data
$user = $conn->prepare("SELECT u.user_id, u.username, u.email, u.role, u.created_on FROM users u WHERE u.user_id = ?");
$user->bind_param("i", $uid);
$user->execute();
$user->store_result();
$user->bind_result($userID, $userName, $email, $role, $createdOn);
$user->fetch();
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
        <a href="<?= ROOT_DIR ?>admin/reviews" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Manage Reviews</a>
        <a href="<?= ROOT_DIR ?>admin/messages" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Messages</a>
        <a href="<?= ROOT_DIR ?>admin/settings" class="flex items-center px-4 py-2 mt-2 text-white hover:bg-red-900">Settings</a>
      </nav>
    </div>
  </div>

  <!-- Main content -->
  <div class="flex-1 p-6">
    <h1 class="text-2xl font-bold mb-6">Edit User: <?= htmlspecialchars($userID) ?></h1>

    <form class="space-y-4 max-w-xl mx-auto font-[sans-serif]" action="editUserController?uid=<?= $userID ?>" method="post">
      <label class="block text-sm font-medium">Username</label>
      <input type="text" name="username" value="<?= htmlspecialchars($userName) ?>" required
        class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" />

      <label class="block text-sm font-medium">Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required
        class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" />

      <label class="block text-sm font-medium">Role</label>
      <select name="role" class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" required>
        <option value="user" <?= $role === 'user' ? 'selected' : '' ?>>User</option>
        <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
      </select>

      <button type="submit"
        class="!mt-8 w-full px-4 py-2.5 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">Update User</button>
    </form>
  </div>
</div>

<!-- <?php include 'components/footer.php'; ?> -->
