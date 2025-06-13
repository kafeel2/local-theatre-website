<?php
include 'database/config.php';
include 'components/header.php';

$showId = $_GET['id'];
$user_id = $_SESSION['user_id'] ?? 0;

$show = $conn->prepare("SELECT
  s.show_name,
  s.date_shown,
  s.show_type,
  s.image_url,
  u.username,
  u.user_id
FROM shows s
JOIN users u ON u.user_id = u.user_id
WHERE s.show_id = ?");
$show->bind_param("i", $showId);
$show->execute();
$show->store_result();
$show->bind_result($show_name, $date_shown, $show_type, $image_url, $username, $user_id);
$show->fetch();
?>

<!-- Show Info Page -->
<section class="bg-white dark:bg-gray-900">
  <div class="container px-6 py-10 mx-auto">
    <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">Now Showing</h1>

    <div class="mt-8 lg:-mx-6 lg:flex lg:items-center">
      <img src="<?= ROOT_DIR ?>assets/<?php echo htmlspecialchars($image_url); ?>" alt="<?= htmlspecialchars($show_name); ?>" class="object-cover" />
      <div class="mt-6 lg:w-1/2 lg:mt-0 lg:mx-6">
        <a href="#" class="block mt-4 text-2xl font-semibold text-gray-800 hover:underline dark:text-white md:text-3xl">
          <?= htmlspecialchars($show_name) ?>
        </a>
        <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
          <?= htmlspecialchars($show_type) ?> • <?= htmlspecialchars($date_shown) ?>
        </p>

        <div class="flex items-center mt-6">
          <img class="object-cover object-center w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1531590878845-12627191e687?ixlib=rb-1.2.1&auto=format&fit=crop&w=764&q=80" alt="">
          <div class="mx-4">
            <h1 class="text-sm text-gray-700 dark:text-gray-200"><?= htmlspecialchars($username) ?></h1>
          </div>
        </div>

        <?php if (isset($_SESSION['user_id'])) : ?>
          <div class="mt-20">
            <form id="reviewForm" action="reviewsController?sid=<?= $showId ?>&uid=<?= $_SESSION['user_id'] ?>" method="post">
              <label for="review_text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Review <?= htmlspecialchars($show_name) ?></label>
              <textarea id="review_text" name="review_text" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="Your review..."></textarea>
              <button type="submit"
                class="relative inline cursor-pointer text-xl font-medium before:bg-red-600 before:absolute before:-bottom-1 before:block before:h-[2px] before:w-full before:origin-bottom-right before:scale-x-0 before:transition hover:before:origin-bottom-left hover:before:scale-x-100">
                Submit Review
              </button>
              <p class="mt-5">Your review will appear once approved by admin</p>
            </form>
          </div>
        <?php else : ?>
          <p class="mt-6 text-gray-600">Please sign in to leave a review.</p>
        <?php endif ?>

        <!-- Approved Reviews Section -->
        <div class="mt-10">
          <h2 class="text-2xl font-semibold text-gray-700 dark:text-white mb-4">Reviews</h2>
          <?php
          $approvedReviews = $conn->prepare("SELECT r.review_text, r.created_at, u.username
              FROM reviews r
              INNER JOIN users u ON r.user_id = u.user_id
              WHERE r.show_id = ? AND r.status = 'approved'
              ORDER BY r.created_at DESC");
          $approvedReviews->bind_param("i", $showId);
          $approvedReviews->execute();
          $approvedReviews->store_result();
          $approvedReviews->bind_result($review_text, $created_at, $review_user);
          ?>

          <?php if ($approvedReviews->num_rows > 0): ?>
            <?php while ($approvedReviews->fetch()): ?>
              <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-sm">
                <div class="flex items-center justify-between mb-2">
                  <span class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($review_user) ?></span>
                  <span class="text-xs text-gray-500 dark:text-gray-400"><?= date("F j, Y, g:i a", strtotime($created_at)) ?></span>
                </div>
                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed"><?= htmlspecialchars($review_text) ?></p>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p class="text-gray-500 dark:text-gray-400">No reviews yet. Be the first to leave one!</p>
          <?php endif; ?>
        </div>
        <!-- End Approved Reviews Section -->

      </div>
    </div>
  </div>
</section>

<?php include 'components/footer.php'; ?>
