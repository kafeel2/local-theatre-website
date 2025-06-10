<?php
include 'database/config.php';
include 'components/header.php';

$blog = $conn->prepare("SELECT 
    blog_id, 
    blog_title, 
    blog_content,
    blog_author,
    image_url, 
    blog_created
    from blogs
    ");
$blog->execute();
$blog->store_result();
$blog->bind_result($blog_id, $blog_title, $blog_content, $blog_author, $image_url, $blog_created);
?>

<div class="p-4 font-[sans-serif]">
      <div class="max-w-6xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">
        <div class="max-w-md mx-auto">
          <h2 class="text-3xl font-extrabold text-gray-800 mb-12 text-center leading-10">Stay updated with the latest blog posts.</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-8">
        <?php while($blog->fetch()): ?>
          <div class="bg-white rounded overflow-hidden">
            <img src="<?= ROOT_DIR ?>assets/<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($blog_title); ?>" class="w-full h-52 object-cover" />
            <div class="p-6">
              <h3 class="text-lg font-bold text-gray-800 mb-3"><?php echo htmlspecialchars($blog_title); ?></h3>
              <p class="text-gray-500 text-sm"><?php echo htmlspecialchars(substr($blog_content, 0, 100)) . '...'; ?></p>
              <p class="text-gray-800 text-[13px] font-semibold mt-4"><?php echo date("d M Y", strtotime($blog_created)); ?></p>
              <a href="blog-info?id=<?php echo $blog_id; ?>" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-purple-600 hover:bg-purple-700 text-white text-[13px]">Read More</a>
            </div>
          </div>
        <?php endwhile; ?>
        </div>
      </div>
</div>
<?php
include 'components/banner.php';
include 'components/footer.php';
?>