<?php
include 'components/header.php';
include 'database/config.php';

$users = $conn->prepare("SELECT
    u.user_id,
    u.username,
    u.email,
    u.role,
    u.created_on,
    COUNT(c.comment_id) AS total_comments
  FROM users u
  LEFT JOIN comments c ON c.user_id = u.user_id
  GROUP BY u.user_id, u.username, u.email, u.role, u.created_on
  ORDER BY u.created_on");

$users->execute();               // Execute the query
$users->store_result();          // Store the result
$users->bind_result($uid, $username, $email, $role, $created, $total_comments);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Status Message -->
    <?php if (isset($_SESSION['status_message'])) : ?>
        <div class="fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg animate-pulse">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <?= $_SESSION['status_message'] ?>
            </div>
        </div>
        <?php unset($_SESSION['status_message']) ?>
    <?php endif ?>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-red-900 shadow-xl border-r border-red-800">
            <!-- Logo/Brand -->
            <div class="p-6 border-b border-red-800">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-red-700 rounded-lg flex items-center justify-center">
                        <i class="fas fa-theater-masks text-white text-lg"></i>
                    </div>
                    <h1 class="ml-3 text-xl font-bold text-white">Admin Panel</h1>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <a href="#" class="tab-link active flex items-center px-4 py-3 text-white bg-red-800 border-r-4 border-red-600 rounded-l-lg transition-all duration-200" data-tab="users">
                        <i class="fas fa-users mr-3 text-red-300"></i>
                        <span class="font-medium">All Users</span>
                        <span class="ml-auto bg-red-700 text-red-200 text-xs px-2 py-1 rounded-full">Active</span>
                    </a>
                    <a href="#" class="tab-link flex items-center px-4 py-3 text-red-200 hover:bg-red-800 hover:text-white rounded-l-lg transition-all duration-200" data-tab="analytics">
                        <i class="fas fa-chart-line mr-3"></i>
                        <span class="font-medium">Analytics</span>
                    </a>
                    <a href="#" class="tab-link flex items-center px-4 py-3 text-red-200 hover:bg-red-800 hover:text-white rounded-l-lg transition-all duration-200" data-tab="comments">
                        <i class="fas fa-comments mr-3"></i>
                        <span class="font-medium">Comments</span>
                    </a>
                    <a href="#" class="tab-link flex items-center px-4 py-3 text-red-200 hover:bg-red-800 hover:text-white rounded-l-lg transition-all duration-200" data-tab="settings">
                        <i class="fas fa-cog mr-3"></i>
                        <span class="font-medium">Settings</span>
                    </a>
                </div>

                <!-- User Profile -->
                <div class="absolute bottom-0 w-64 p-4 border-t border-red-800 bg-red-900">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-red-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div class="ml-3">
                        <p class="text-sm font-medium text-white">
                           <?= htmlspecialchars($_SESSION['username'] ?? 'kafeel') ?>
                        </p>
                        <p class="text-xs text-red-300">
                            <?= htmlspecialchars($_SESSION['email'] ?? 'unknown@example.com') ?>
                        </p>

                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-hidden" style="background-image: url('<?= ROOT_DIR?>assets/theatre-hall.jpg');">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">User Management</h2>
                            <p class="text-gray-600 mt-1">Manage and monitor all registered users</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <input type="text" placeholder="Search users..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            <button class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                <i class="fas fa-plus mr-2"></i>
                                Add User
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Tab Content -->
            <div class="flex-1 overflow-auto" >
                <!-- Users Tab -->
                <div id="users-tab"  class="tab-content active p-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-red-700 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                                    <p class="text-2xl font-bold text-gray-900">1,247</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-user-plus text-red-700 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">New Today</p>
                                    <p class="text-2xl font-bold text-gray-900">12</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-comments text-red-700 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Comments</p>
                                    <p class="text-2xl font-bold text-gray-900">5,891</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-chart-line text-red-700 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Active Rate</p>
                                    <p class="text-2xl font-bold text-gray-900">89%</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" >
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-800">All Users</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <div class="flex items-center">
                                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                                <span class="ml-3">User</span>
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Joined
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Comments
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php while ($users->fetch()) : ?>
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                                    <div class="ml-4 flex items-center">
                                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                                                            <span class="text-white font-medium text-sm">
                                                                <?= strtoupper(substr(htmlspecialchars($username), 0, 1)) ?>
                                                            </span>
                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                <?= htmlspecialchars($username) ?>
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                ID: <?= $uid ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"><?= $email ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"><?= $created ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-900"><?= $total_comments ?></span>
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <i class="fas fa-comments mr-1"></i>
                                                        comments
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></div>
                                                    Active
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <button onclick="window.location.href='edit-user?uid=<?= urlencode($uid) ?>'"
                                                        class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-medium rounded-lg transition-colors duration-200"
                                                        title="Edit User">
                                                        <i class="fas fa-edit mr-1"></i>
                                                        Edit
                                                    </button>
                                                    <button class="modal-show inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium rounded-lg transition-colors duration-200"
                                                        data-user-id="<?= $uid ?>"
                                                        data-username="<?= htmlspecialchars($username) ?>"
                                                        title="Delete User">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="bg-white px-6 py-4 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-700">
                                    Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">97</span> results
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                                        Previous
                                    </button>
                                    <button class="px-3 py-2 text-sm bg-blue-600 text-white rounded-lg">1</button>
                                    <button class="px-3 py-2 text-sm text-gray-700 hover:text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                                    <button class="px-3 py-2 text-sm text-gray-700 hover:text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                                    <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Analytics Tab -->
                <div id="analytics-tab" class="tab-content hidden p-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                        <div class="text-center">
                            <i class="fas fa-chart-bar text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Analytics Dashboard</h3>
                            <p class="text-gray-600">User analytics and insights will be displayed here.</p>
                        </div>
                    </div>
                </div>

                <!-- Comments Tab -->
                <div id="comments-tab" class="tab-content hidden p-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                        <div class="text-center">
                            <i class="fas fa-comments text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Comments Management</h3>
                            <p class="text-gray-600">Manage and moderate user comments here.</p>
                        </div>
                    </div>
                </div>

                <!-- Settings Tab -->
                <div id="settings-tab" class="tab-content hidden p-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                        <div class="text-center">
                            <i class="fas fa-cog text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">System Settings</h3>
                            <p class="text-gray-600">Configure application settings and preferences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Delete Modal -->
    <div id="modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity backdrop-blur-sm"></div>
            
            <!-- Modal Panel -->
            <div class="inline-block align-bottom bg-white rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Delete User Account
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete the user <span id="modal_username" class="font-semibold text-gray-900"></span>? 
                                This action will permanently remove the user account and all associated comments. This action cannot be undone.
                            </p>
                            <div class="mt-3 p-3 bg-red-50 rounded-lg border border-red-200">
                                <div class="flex">
                                    <i class="fas fa-info-circle text-red-400 mr-2 mt-0.5"></i>
                                    <div class="text-sm text-red-700">
                                        <strong>User ID:</strong> <span id="modal_user_id"></span><br>
                                        <strong>Impact:</strong> All user comments will be permanently deleted
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button" id="delete_confirm" onclick=""
                        class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        <i class="fas fa-trash mr-2"></i>
                        Delete User
                    </button>
                    <button type="button" id="close"
                        class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.querySelectorAll('.tab-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs and content
                document.querySelectorAll('.tab-link').forEach(l => l.classList.remove('active', 'bg-blue-50', 'border-blue-500', 'text-gray-700'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
                
                // Add active class to clicked tab
                this.classList.add('active', 'bg-blue-50', 'border-blue-500', 'text-gray-700');
                
                // Show corresponding content
                const tabId = this.getAttribute('data-tab') + '-tab';
                document.getElementById(tabId).classList.remove('hidden');
            });
        });

        // Enhanced modal functionality
        document.querySelectorAll('.modal-show').forEach(button => {
            button.addEventListener("click", function() {
                const userId = this.getAttribute('data-user-id');
                const username = this.getAttribute('data-username');
                
                document.getElementById('modal').classList.remove('hidden');
                document.getElementById('modal_user_id').textContent = userId;
                document.getElementById('modal_username').textContent = username;
                
                // Update delete button with correct URL
                document.getElementById('delete_confirm').setAttribute('onclick', `window.location.href='delete-user?uid=${encodeURIComponent(userId)}'`);
            });
        });

        // Close modal functionality
        document.getElementById('close').addEventListener("click", function() {
            document.getElementById('modal').classList.add('hidden');
        });

        // Close modal when clicking outside
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });

        // Auto-hide status messages
        setTimeout(() => {
            const statusMessage = document.querySelector('.animate-pulse');
            if (statusMessage) {
                statusMessage.style.transform = 'translateX(100%)';
                setTimeout(() => statusMessage.remove(), 300);
            }
        }, 3000);
    </script>
</body>
</html>
<!-- <?php include 'components/footer.php' ?> -->

