<?php
define('ROOT_DIR', '/local-theatre-website/');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>local_theatre</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Condensed:wght@600&display=swap" rel="stylesheet">
</head>
<body>

    <header class="flex [box-shadow:rgba(0,0,0,0.1)_-4px_9px_25px_-6px] py-4 px-4 sm:px-10 bg-white min-h-[75px] tracking-wide relative z-50">
      <div class="flex flex-wrap items-center gap-4 w-full">
        <img src="<?= ROOT_DIR?>/assets/logo.png" alt="logo" class="w-16">

        <div id="collapseMenu"
          class="lg:ml-12 max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-40 max-lg:before:inset-0 max-lg:before:z-50">
          <button id="toggleClose" class="lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border border-gray-200 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-black" viewBox="0 0 320.591 320.591">
              <path
                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                data-original="#000000"></path>
              <path
                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                data-original="#000000"></path>
            </svg>
          </button>

          <ul
            class="lg:flex lg:gap-x-4 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-2/3 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-4 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50">
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:pb-4 px-3 lg:hidden">
              <a href="javascript:void(0)"><img src="<?= ROOT_DIR?>/assets/logo.png" alt="logo" class="w-16">


              </a>
            </li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3">
              <a href="<?= ROOT_DIR ?>home"
                class="hover:text-blue-700 text-blue-700 block font-medium text-base">Home</a>
            </li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href="<?= ROOT_DIR ?>shows"
              class="hover:text-blue-700 text-slate-900 block font-medium text-base">Shows</a>
            </li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href="<?= ROOT_DIR ?>blog"
              class="hover:text-blue-700 text-slate-900 block font-medium text-base">Blog</a>
            </li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href="<?= ROOT_DIR ?>reviews"
              class="hover:text-blue-700 text-slate-900 block font-medium text-base">Reviews</a>
            </li>
            <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3"><a href="<?= ROOT_DIR ?>contact"
              class="hover:text-blue-700 text-slate-900 block font-medium text-base">Contact</a>
            </li>
          </ul>
        </div>

        <div class="flex items-center ml-auto space-x-6">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="20px" class="cursor-pointer fill-gray-400">
    <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"></path>
  </svg>

  <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
    <a href="<?= ROOT_DIR ?>login" class="font-medium text-[15px] border-0 outline-0 cursor-pointer text-black-700 hover:underline">
      Login
    </a>
    <a href="<?= ROOT_DIR ?>register" class="px-4 py-2 text-sm rounded-md font-medium text-white border border-red-800 bg-red-800 hover:bg-red-900 cursor-pointer">
      Sign up
    </a>
  <?php else: ?>
    <?php if ($_SESSION['role'] === 'admin'): ?>
      <a href="<?= ROOT_DIR ?>admin/dashboard" class="font-medium text-[15px] border-0 outline-0 cursor-pointer text-black-700 hover:underline">
        Dashboard
      </a>
      <a href="<?= ROOT_DIR ?>admin/manage-blogs" class="font-medium text-[15px] border-0 outline-0 cursor-pointer text-black-700 hover:underline">
        Manage Blogs
      </a>
    <a href="<?= ROOT_DIR ?>admin/manage-shows" class="font-medium text-[15px] border-0 outline-0 cursor-pointer text-black-700 hover:underline">
      Manage Shows
    </a>
    <a href="<?= ROOT_DIR ?>admin/comments" class="font-medium text-[15px] border-0 outline-0 cursor-pointer text-black-700 hover:underline">
       Manage Comments
    </a>
    <a href="<?= ROOT_DIR ?>admin/manage-reviews" class="font-medium text-[15px] border-0 outline-0 cursor-pointer text-black-700 hover:underline">
      Manage Reviews
    </a>
    <?php elseif ($_SESSION['role'] === 'user'): ?>
      <a href="<?= ROOT_DIR ?>user/dashboard" class="font-medium text-[15px] border-0 outline-0 cursor-pointer text-black-700 hover:underline">
        Dashboard
      </a>
    <?php endif; ?>
    <a href="<?= ROOT_DIR ?>logout" class="px-4 py-2 text-sm rounded-md font-medium text-white border border-red-800 bg-red-800 hover:bg-red-900 cursor-pointer">
      Logout
    </a>
  <?php endif; ?>

  <button id="toggleOpen" class="lg:hidden cursor-pointer">
    <svg class="w-7 h-7" fill="#333" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
    </svg>
  </button>
</div>

      </div>
    </header>