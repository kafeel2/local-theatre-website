<?php
include 'database/config.php';
include 'components/header.php';

$shows = $conn->prepare("SELECT
    s.show_id,
    s.show_name,
    s.date_shown,
    s.show_type,
    s.image_url
  FROM shows s
  ORDER BY s.date_shown");


$shows->execute();
$shows->store_result();
$shows->bind_result($sid, $showName, $dateShown, $showType, $imageUrl);

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

  <!-- Show list -->
  <div class="space-y-6">
    <?php while ($shows->fetch()) : ?>
      <div class="flex flex-col sm:flex-row bg-white rounded shadow hover:shadow-lg transition overflow-hidden">
        <img src="<?= ROOT_DIR ?>assets/<?php echo htmlspecialchars($imageUrl); ?>" alt="<?php echo htmlspecialchars($showName); ?>" class="w-full sm:w-1/3 h-48 object-cover">
        <div class="p-4 flex-1 flex flex-col justify-between">
          <div>
            <h2 class="text-2xl font-semibold mb-2">
              <a href="show-info.php?id=<?= $sid ?>" class="hover:underline"><?= htmlspecialchars($showName) ?></a>
            </h2>
            <p class="text-gray-600"><?= date("M d, Y", strtotime($dateShown)) ?> • <?= ucfirst($showType) ?></p>
            <p class="mt-3 text-gray-700">Click below for full show details and to book tickets.</p>
          </div>
          <div class="mt-4">
            <a href="shows-info?id=<?= $sid ?>" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 inline-block">Book Tickets</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include 'components/footer.php'; ?>
