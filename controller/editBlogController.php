<?php 
    include 'components/header.php';
    include 'database/config.php';
    $bid = isset($_GET['bid']) ? (int) $_GET['bid'] : 0;

    $user = $conn->prepare("SELECT
    blog_title,
    blog_content
    FROM blogs
    where blog_id = $bid
    ");
    $user->execute();               // Execute the query
    $user->store_result();          // Store the result
    $user->bind_result($title, $content);
    $user->fetch();
    ?>
    <h1>Edit blog</h1>
    <form class="space-y-4 font-[sans-serif] max-w-md mx-auto" action="edit-blog-config?bid=<?= $bid ?>" method="post">
      <p>ID: <?= $bid ?></p>
      <input type="text" name="title" value="<?= $title ?>"
        class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" />

      <input type="text" name="content" value="<?= $content ?>"
        class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded" />
     
     

      <button type="submit"
        class="!mt-8 w-full px-4 py-2.5 mx-auto block text-sm bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
    </form>
<?php include 'components/footer.php' ?>    