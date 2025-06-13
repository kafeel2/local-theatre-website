<?php 
include 'components/header.php';
include 'database/config.php';

$rid = isset($_GET['rid']) ? (int) $_GET['rid'] : 0;

$reviews = $conn->prepare("SELECT
    r.review_text
FROM reviews r
WHERE r.review_id = ?");
$reviews->bind_param("i", $rid);
$reviews->execute();
$reviews->store_result();
$reviews->bind_result($reviewText);
$reviews->fetch();
?>

<h1>Edit Review <?= $rid ?></h1>
<form class="space-y-4 font-[sans-serif] max-w-md mx-auto" action="editReviewController?rid=<?= $rid ?>" method="post">
  <p>ID: <?= $rid ?></p>

  <textarea name="review_text" rows="10"
    class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded"><?= htmlspecialchars($reviewText) ?></textarea>

  <button type="submit"
    class="!mt-8 w-full px-4 py-2.5 mx-auto block text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
    Submit
  </button>
</form>

<?php include 'components/footer.php' ?>
