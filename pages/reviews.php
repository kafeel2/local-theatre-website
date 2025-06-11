<?php
include 'database/config.php';
include 'components/header.php';
?>

<section class="bg-white px-4 py-12 md:py-24">
  <div class="max-w-screen-xl mx-auto">
    <h2 class="font-black text-black text-center text-3xl leading-none uppercase max-w-2xl mx-auto mb-12">What Listeners
      Are Saying</h2>
    <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4 relative">
      <div class="bg-gray-200 rounded-lg p-8 text-center md:w-1/3">
        <p class="font-bold uppercase">John Doe</p>
        <p class="text-xl font-light italic text-gray-700">This podcast is amazing! The storytelling and production
          quality are top-notch. I can't wait for the next episode!</p>
        <div class="flex items-center justify-center space-x-2 mt-4">
          <svg class="text-yellow-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" stroke="currentColor">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
          <svg class="text-yellow-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" stroke="currentColor">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
          <svg class="text-yellow-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" stroke="currentColor">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
        </div>
      </div>
      <div class="bg-gray-200 rounded-lg p-8 text-center md:w-1/3">
        <p class="font-bold uppercase">Jane Smith</p>
        <p class="text-xl font-light italic text-gray-700">This podcast kept me on the edge of my seat. It's a
          must-listen for true crime enthusiasts!</p>
        <div class="flex items-center justify-center space-x-2 mt-4">
          <svg class="text-yellow-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" stroke="currentColor">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
          <svg class="text-yellow-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" stroke="currentColor">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
          <svg class="text-yellow-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" stroke="currentColor">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
        </div>
      </div>
      <div class="bg-gray-200 rounded-lg p-8 text-center md:w-1/3">
        <p class="font-bold uppercase">Emily Johnson</p>
        <p class="text-xl font-light italic text-gray-700">I can't get enough of this podcast! The host's voice is so
          soothing, and the stories are gripping. Highly recommend!</p>
        <div class="flex items-center justify-center space-x-2 mt-4">
          <svg class="text-yellow-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" stroke="currentColor">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
          <svg class="text-yellow-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" stroke="currentColor">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
          <svg class="text-yellow-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" stroke="currentColor">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
            </path>
          </svg>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'components/footer.php'; ?>