<?php 
    include 'components/header.php';
    include 'database/config.php';
    $bid = isset($_GET['bid']) ? (int) $_GET['bid'] : 0;

    $blogs = $conn->prepare("SELECT
    b.blog_title,
    b.blog_content
    FROM blogs b
    where b.blog_id = ?
    ");
$blogs->bind_param("i", $bid);
$blogs->execute();
$blogs->store_result();
$blogs->bind_result($blogTitle, $blogContent);
$blogs->fetch();
?>
    <h1>Edit Blog <?= $blogTitle ?></h1>
    <form class="space-y-4 font-[sans-serif] max-w-md mx-auto" action="editBlogController?bid=<?= $bid ?>" method="post">
      <p>ID: <?= $bid ?></p>
      <input type="text" name="blog_title" value="<?= $blogTitle ?>"
        class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" />

      <textarea name="blog_content" rows="10" class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded"><?= $blogContent ?></textarea>
     

      <button type="submit"
        class="!mt-8 w-full px-4 py-2.5 mx-auto block text-sm bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
    </form>
<?php include 'components/footer.php' ?>