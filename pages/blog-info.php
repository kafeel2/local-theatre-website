<?php
include 'database/config.php';
include 'components/header.php';
$blogId = $_GET['id'];
echo $blogId;


$blog = $conn->prepare("SELECT
b.title,
b.content,
b.image,
u.username

from blogs b
INNER JOIN users u ON b.user_id = u.id
where b.id =$blogId ");
$blog->execute();
$blog->store_result();
$blog->bind_result($title, $content, $image, $username);
$blog->fetch();
?>

<!-- component -->
<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">From the blog</h1>

        <div class="mt-8 lg:-mx-6 lg:flex lg:items-center">
        <img src="<?= ROOT_DIR ?>assets/images/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>" class="object-cover" />
            <div class="mt-6 lg:w-1/2 lg:mt-0 lg:mx-6 ">
                

                <a href="#" class="block mt-4 text-2xl font-semibold text-gray-800 hover:underline dark:text-white md:text-3xl">
                <?php echo htmlspecialchars($title); ?>
                </a>

                <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                <?php echo htmlspecialchars($content); ?>
                </p>

                <div class="flex items-center mt-6">
                    <img class="object-cover object-center w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1531590878845-12627191e687?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80" alt="">

                    <div class="mx-4">
                        <h1 class="text-sm text-gray-700 dark:text-gray-200"><?php echo htmlspecialchars($username); ?></h1>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
//include 'components/banner.php';
include 'components/footer.php';
?>