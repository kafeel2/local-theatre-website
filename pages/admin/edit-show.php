<?php 
    include 'components/header.php';
    include 'database/config.php';
    $sid = isset($_GET['sid']) ? (int) $_GET['sid'] : 0;

    $shows = $conn->prepare("SELECT
        s.show_name,
        s.show_type
        FROM shows s
        WHERE s.show_id = ?
    ");
    $shows->bind_param("i", $sid);
    $shows->execute();
    $shows->store_result();
    $shows->bind_result($showName, $showType);
    $shows->fetch();
?>

<h1>Edit Show <?= htmlspecialchars($showName) ?></h1>
<form class="space-y-4 font-[sans-serif] max-w-md mx-auto" action="editShowController?sid=<?= $sid ?>" method="post">
  <p>ID: <?= $sid ?></p>
  
  <input type="text" name="show_name" value="<?= htmlspecialchars($showName) ?>"
    class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" />

  <input type="text" name="show_type" value="<?= htmlspecialchars($showType) ?>"
    class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" />

  <button type="submit"
    class="!mt-8 w-full px-4 py-2.5 mx-auto block text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
    Submit
  </button>
</form>

<?php include 'components/footer.php' ?>
