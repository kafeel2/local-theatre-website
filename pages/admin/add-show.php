<?php 
include 'components/header.php'; 
?>

<h1 class="text-2xl font-bold text-center my-6">Add New Show</h1>

<form class="space-y-4 font-[sans-serif] max-w-md mx-auto" action="addShowController" method="post">
  <input type="text" name="show_name" placeholder="Show Name" required
    class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-red-600 rounded" />

  <input type="text" name="show_type" placeholder="Show Type (e.g., theatre, film)" required
    class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-red-600 rounded" />

  <input type="date" name="date_shown" required
    class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-red-600 rounded" />

  <button type="submit"
    class="!mt-8 w-full px-4 py-2.5 mx-auto block text-sm bg-red-600 text-white rounded hover:bg-red-700">
    Submit
  </button>
</form>

<?php include 'components/footer.php'; ?>
