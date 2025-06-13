<?php
include 'database/config.php';
include 'components/header.php';
$blogId = $_GET['id'];
$user_id = $_SESSION['user_id'] ?? 0;

$blog = $conn->prepare("SELECT
b.blog_title,
b.blog_content,
b.image_url,
u.username
FROM blogs b
INNER JOIN users u ON b.blog_author = u.user_id  
WHERE b.blog_id = ?");
$blog->bind_param("i", $blogId);
$blog->execute();
$blog->store_result();
$blog->bind_result($blog_title, $blog_content, $image_url, $username);
$blog->fetch();
?>

<!-- component -->
<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">From the blog</h1>

        <div class="mt-8 lg:-mx-6 lg:flex lg:items-center">
            <img src="<?= ROOT_DIR ?>assets/<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($blog_title); ?>" class="object-cover" />
            
            <div class="mt-6 lg:w-1/2 lg:mt-0 lg:mx-6">
                <a href="#" class="block mt-4 text-2xl font-semibold text-gray-800 hover:underline dark:text-white md:text-3xl">
                    <?php echo htmlspecialchars($blog_title); ?>
                </a>

                <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                    <?php echo htmlspecialchars($blog_content); ?>
                </p>

                <div class="flex items-center mt-6">
                    <img class="object-cover object-center w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1531590878845-12627191e687?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80" alt="">
                    <div class="mx-4">
                        <h1 class="text-sm text-gray-700 dark:text-gray-200"><?php echo htmlspecialchars($username); ?></h1>
                    </div>
                </div>

                <?php if(isset($_SESSION['user_id'])) : ?>
                <div class="mt-20">
                    <form id="commentForm" action="commentsController?bid=<?= $blogId ?>&uid=<?= $user_id ?>" method="post">
                        <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Comment on <?= htmlspecialchars($blog_title) ?></label>
                        <textarea id="comment" name="comment_text" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your comment..."></textarea>
                        <button type="submit" class="relative inline cursor-pointer text-xl font-medium before:bg-violet-600  before:absolute before:-bottom-1 before:block before:h-[2px] before:w-full before:origin-bottom-right before:scale-x-0 before:transition before:duration-300 before:ease-in-out hover:before:origin-bottom-left hover:before:scale-x-100">Submit Comment</button>
                        <p class="mt-5">Your comment will appear once approved by admin</p>
                    </form>
                </div>
                <?php else : ?>
                    <p class="mt-10 text-gray-700 dark:text-white">Please sign in to comment on this blog.</p>
                <?php endif; ?>    

                <!-- Approved Comments Section -->
                <div class="mt-10">
                    <h2 class="text-2xl font-semibold text-gray-700 dark:text-white mb-4">Comments</h2>
                    <?php
                    $approvedComments = $conn->prepare("SELECT c.comment_text, c.comment_created, u.username
                        FROM comments c
                        INNER JOIN users u ON c.user_id = u.user_id
                        WHERE c.blog_id = ? AND c.status = 'approved'
                        ORDER BY c.comment_created DESC");
                    $approvedComments->bind_param("i", $blogId);
                    $approvedComments->execute();
                    $approvedComments->store_result();
                    $approvedComments->bind_result($comment_text, $comment_created, $comment_user);
                    ?>

                    <?php if ($approvedComments->num_rows > 0): ?>
                        <?php while ($approvedComments->fetch()): ?>
                            <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-sm">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($comment_user) ?></span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400"><?= date("F j, Y, g:i a", strtotime($comment_created)) ?></span>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed"><?= htmlspecialchars($comment_text) ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-gray-500 dark:text-gray-400">No comments yet. Be the first to comment!</p>
                    <?php endif; ?>
                </div>
                <!-- End Approved Comments Section -->
            </div>
        </div>
    </div>
</section>

<?php
include 'components/footer.php';
?>
