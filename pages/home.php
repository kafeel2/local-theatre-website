<?php
include 'database/config.php';
include 'components/header.php';

?>

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
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Our Menu</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Pizza 1 -->
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Margherita Pizza" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Margherita</h3>
                        <p class="text-gray-600 mt-2">Classic pizza with tomato sauce, mozzarella, and basil.</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-primary font-bold text-lg">$12.99</span>
                            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                </div>
                
                <!-- Pizza 2 -->
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1552539618-7eec9b4d1796?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Pepperoni Pizza" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Pepperoni</h3>
                        <p class="text-gray-600 mt-2">Tomato sauce, mozzarella, and lots of pepperoni.</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-primary font-bold text-lg">$14.99</span>
                            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                </div>
                
                <!-- Pizza 3 -->
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Vegetarian Pizza" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Vegetarian</h3>
                        <p class="text-gray-600 mt-2">Tomato sauce, mozzarella, bell peppers, mushrooms, and olives.</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-primary font-bold text-lg">$13.99</span>
                            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                </div>
                
                <!-- Pizza 4 -->
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1620374645498-af6bd681a0bd?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Hawaiian Pizza" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Hawaiian</h3>
                        <p class="text-gray-600 mt-2">Tomato sauce, mozzarella, ham, and pineapple.</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-primary font-bold text-lg">$15.99</span>
                            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                </div>
                
                <!-- Pizza 5 -->
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1593504049359-74330189a345?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="BBQ Chicken Pizza" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">BBQ Chicken</h3>
                        <p class="text-gray-600 mt-2">BBQ sauce, mozzarella, chicken, red onions, and cilantro.</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-primary font-bold text-lg">$16.99</span>
                            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                </div>
                
                <!-- Pizza 6 -->
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1574071318508-1cdbab80d002?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Meat Lovers Pizza" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Meat Lovers</h3>
                        <p class="text-gray-600 mt-2">Tomato sauce, mozzarella, pepperoni, sausage, bacon, and ham.</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-primary font-bold text-lg">$17.99</span>
                            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                </div>
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