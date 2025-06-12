<?php
include 'database/config.php';
include 'components/header.php';

$showId = $_GET['id'];
echo $showId;

// Fetch show data (replace blogs with shows)
$show = $conn->prepare("SELECT
s.show_name,
s.date_shown,
s.show_type,
u.username,
u.user_id
FROM shows s
JOIN users u ON u.user_id = u.user_id  -- Dummy join for compatibility; update if shows are linked to creators
WHERE s.show_id = $showId");

$show->execute();
$show->store_result();
$show->bind_result($show_name, $date_shown, $show_type, $username, $user_id);
$show->fetch();
?>

<!-- Show Info Page -->
<section class="bg-white dark:bg-gray-900">
  <div class="container px-6 py-10 mx-auto">
    <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">Now Showing</h1>

    <div class="mt-8 lg:-mx-6 lg:flex lg:items-center">
      <img src="<?= ROOT_DIR ?>assets/theatre-hall.jpg" alt="<?= htmlspecialchars($show_name) ?>" class="object-cover" />
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
            <form id="reviewForm" action="reviewController?sid=<?= $showId ?>&uid=<?= $_SESSION['user_id'] ?>" method="post">
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
      </div>
    </div>
  </div>
</section>

<?php include 'components/footer.php'; ?>
