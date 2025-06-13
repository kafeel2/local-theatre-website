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
    LIMIT 3
    ");
$blog->execute();
$blog->store_result();
$blog->bind_result($blog_id, $blog_title, $blog_content, $blog_author, $image_url, $blog_created);

// show info
$shows = $conn->prepare("SELECT
    s.show_id,
    s.show_name,
    s.date_shown,
    s.show_type,
    s.image_url
  FROM shows s
  ORDER BY s.date_shown
  LIMIT 3
  ");


$shows->execute();
$shows->store_result();
$shows->bind_result($sid, $showName, $dateShown, $showType, $imageUrl);

?>
<div>
<div class="relative min-h-[560px]">
  <!-- Full-width background image -->
  <img src="assets/theatre-hall.jpg" alt="Banner" class="absolute inset-0 w-full h-full object-cover z-0" />

  <!-- Overlay content (with white text) -->
  <div class="relative z-10 h-full w-full flex items-center">
    <div class="max-w-7xl mx-auto px-6 py-16 w-full">
      <div class="grid lg:grid-cols-2 items-center gap-10 text-white">
        <div>
          <h1 class="md:text-5xl text-4xl font-bold mb-6 md:!leading-[55px]">
            Experience the Magic of Live Theatre
          </h1>
          <p class="text-base leading-relaxed font-semibold mb-0 md:pl-0 pl-0">
            Join us for an unforgettable journey through storytelling, music and performance art.
          </p>
          <div class="flex flex-wrap gap-4 mt-8">
          <button class="bg-red-800 text-white font-semibold px-6 py-3 rounded-md hover:bg-red-900 transition">
           Get Tickets
          </button>

          </div>
        </div>
        <div class="hidden lg:block"></div>
      </div>
    </div>
  </div>
</div>


<section id="menu" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Latest Blog</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Victorian Show -->
          <?php while($blog->fetch()): ?>
          <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
            <img src="<?= ROOT_DIR ?>assets/<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($blog_title); ?>" class="w-full h-52 object-cover" />
            <div class="p-6">
              <h3 class="text-xl font-semibold text-gray-800"><?= $blog_title ?></h3>
              <p class="text-gray-600 mt-2"><?= $blog_content ?></p>
              <div class="mt-4">
                <a href="blog-info?id=<?php echo $blog_id; ?>" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-purple-600 hover:bg-purple-700 text-white text-[13px]">Read More</a>
              </div>
            </div>
          </div>
          <?php endwhile; ?>  
        </div>
      </div> 
  </section>

  <!-- shows -->
  <section id="menu" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Current Shows</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Victorian Show -->
            <?php while($shows->fetch()): ?>
            <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
              <img src="<?= ROOT_DIR ?>assets/<?php echo htmlspecialchars($imageUrl); ?>" alt="<?php echo htmlspecialchars($showName); ?>" class="w-full h-52 object-cover" />
              <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800"><?= $showName ?></h3>
                <p class="text-gray-600 mt-2"><?= $showType ?></p>
                <div class="mt-4">
                <a href="shows-info?id=<?= $sid ?>" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 inline-block">View Show</a>
                </div>
              </div>
            </div>
            <?php endwhile; ?>  
        </div>
      </div> 
  </section>




      <hr class="my-6" />
      <p class='text-center mb-6'>© 2023<a href='https://readymadeui.com/' target='_blank'
          class="hover:underline mx-1">ReadymadeUI</a>All Rights Reserved.</p>
    </footer>


  <script>
    var toggleOpen = document.getElementById('toggleOpen');
    var toggleClose = document.getElementById('toggleClose');
    var collapseMenu = document.getElementById('collapseMenu');

    function handleClick() {
      if (collapseMenu.style.display === 'block') {
        collapseMenu.style.display = 'none';
      } else {
        collapseMenu.style.display = 'block';
      }
    }

    toggleOpen.addEventListener('click', handleClick);
    toggleClose.addEventListener('click', handleClick);

  </script>
</body>

</html>
<?php
include 'components/footer.php';
?>