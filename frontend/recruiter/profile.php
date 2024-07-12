<!DOCTYPE html>

<html>
<?php
session_start();
require_once ('../../entities/user.php');
$user = unserialize($_SESSION['user']);
$appliedApplications = $user->getAppliedApplications();
?>

<head>
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    <?php require_once ('../navbar.php') ?>


    <?php
    if (!empty($_GET['msg'] && $_GET['msg'] == 'fields_required')) {
        ?>
        <div class="p-4  mt-32 mb-4 text-sm text-red-800  bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            fields to add jop is required </div>
        <?php
    }
    ?>


    <?php

    if (isset($_GET['msg'])) {

        if (!empty($_GET['msg'] && $_GET['msg'] == 'sent')) {
            ?>
            <div class="p-4 mt-32 mb-4 text-sm text-green-800  bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">woohooo</span> your post has been sent
            </div>

            <?php
        }
    }

    ?>

    <section class="relative pt-40 pb-24">

        <form action="editProfileImage.php" method="post" enctype="multipart/form-data">
            <img src="https://pagedone.io/asset/uploads/1705473908.png" alt="cover-image"
                class="w-full absolute top-0 left-0 z-0 h-60">

            <div class="w-full max-w-7xl mx-auto px-6 md:px-8">

                <div class="flex items-center justify-center sm:justify-start relative z-10 mb-5">
                    <div class=" hover:scale-105 duration-200 cursor-pointer">
                        <label for="profileImage">
                            <img src="<?= $user->profileImg ?>" alt="user-avatar-image"
                                class="border-4 h-44 w-44 border-solid border-white rounded-full">
                        </label>
                        <input id="profileImage" name="profileImage" type="file" class="hidden">
                    </div>
                </div>
                <button type="submit" class="bg-red-500 rounded-sm px-3 py-1 text-white"> Add Image</button>

        </form>


        <div class="flex items-center justify-center flex-col sm:flex-row max-sm:gap-5 sm:justify-between mb-5">
            <div class="block">
                <h3 class="font-manrope font-bold text-4xl text-gray-900 mb-1 max-sm:text-center">
                    <?= $user->username ?>
                </h3>
                <p class="font-normal text-base leading-7 text-gray-500  max-sm:text-center">
                    recruiter</p>
            </div>

        </div>
        <div class="flex max-sm:flex-wrap max-sm:justify-center items-center gap-4">
            <a href="javascript:;"
                class="rounded-full py-3 px-6 bg-stone-100 text-gray-700 font-semibold text-sm leading-6 transition-all duration-500 hover:bg-stone-200 hover:text-gray-900">Ux
                Research</a>
            <a href="javascript:;"
                class="rounded-full py-3 px-6 bg-stone-100 text-gray-700 font-semibold text-sm leading-6 transition-all duration-500 hover:bg-stone-200 hover:text-gray-900">CX
                Strategy</a>
            <a href="javascript:;"
                class="rounded-full py-3 px-6 bg-stone-100 text-gray-700 font-semibold text-sm leading-6 transition-all duration-500 hover:bg-stone-200 hover:text-gray-900">Project
                Manager</a>
        </div>
        </div>
    </section>



    <div class="heading text-center font-bold text-2xl m-5 text-gray-800">post a job</div>
    <style>
        body {
            background: white !important;
        }
    </style>

    <form method="post" action="postjobs.php">
        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
            <input name="title" id="title" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none"
                spellcheck="false" placeholder="Title" type="text">

            <input name="location" id="location" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none"
                spellcheck="false" placeholder="location" type="text">

            <textarea name="content" class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none"
                spellcheck="false" placeholder="Describe everything about this post here"></textarea>

            <!-- icons -->
            <div class="icons flex text-gray-500 m-2">
                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
                <div class="count ml-auto text-gray-400 text-xs font-semibold">0/300</div>
            </div>
            <!-- buttons -->
            <div class="buttons flex">
                <div class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto">
                    Cancel
                </div>
                <button type="submit"
                    class="btn border  p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-red-500">
                    Post</button>
            </div>
        </div>

    </form>

    <?php
    if (!empty($appliedApplications)) {
        ?>

        <div>
            <div class="flex justify-center mt-20 items-center">
                <h1 class="mx-auto text-2xl  font-bold ">applied applications</h1>
            </div>


            <?php foreach ($appliedApplications as $application): ?>

                <!-- post card -->
                <div
                    class="max-w-sm  my-10 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-row">
                        <svg fill="#990000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
                            viewBox="-109.37 -109.37 794.36 794.36" xml:space="preserve" stroke="#990000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <path
                                            d="M429.248,141.439C429.248,63.33,365.985,0,287.808,0c-78.109,0-141.439,63.33-141.439,141.439 c0,78.11,63.33,141.439,141.439,141.439C365.988,282.878,429.248,219.549,429.248,141.439z M181.727,144.499 c0,0-4.079-40.12,24.82-70.72c20.34,20.389,81.261,70.72,187.342,70.72c0,58.498-47.586,106.081-106.081,106.081 S181.727,202.994,181.727,144.499z">
                                        </path>
                                        <path
                                            d="M45.049,391.68v62.559v80.919c0,22.365,18.136,40.459,40.459,40.459h404.6c22.365,0,40.459-18.097,40.459-40.459v-80.919 V391.68c0-44.688-36.193-80.919-80.919-80.919H377.91c-5.07,0-11.46,3.422-14.271,7.639l-70.735,99.982 c-2.812,4.22-7.372,4.22-10.184,0l-70.738-99.986c-2.812-4.22-9.202-7.638-14.272-7.638h-71.742 C81.319,310.758,45.049,346.991,45.049,391.68z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </svg>

                        <p class="mt-5 font-bold text-l"><?= $application['username'] ?></p>

                    </div>
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        <?= $application['title'] ?>
                    </h5>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400"><?= $application['content'] ?>
                    </p>

                    <p class="mb-3 font-normal "><?= $application['jopTitle'] ?>
                    </p>
                    <div class="flex items-end justify-end">
                        <P><?= $application['status'] ?></P>
                    </div>
                    <div class="flex flex-row gap-4">
                        <form action="approveApplication.php">
                            <input type="hidden" name="applicationId" value="<?= @$application['id'] ?>">
                            <button type="submit"
                                class=" px-3 py-2 rounded-md text-white bg-green-500 hover:scale-105 duration-200">approve</button>
                        </form>

                        <form action="refuseApplication.php">
                            <input type="hidden" name="applicationId" value="<?= @$application['id'] ?>">

                            <button
                                class=" px-3 py-2 rounded-md text-white bg-red-500 hover:scale-105 duration-200">refuse</button>

                        </form>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
        <?php
    } else {
        ?>

        <div class="flex justify-center items-center">
            <h1 class="text-xl font-bold py-10 "> no one has applied to your jobs </h1>

        </div> <?php
    }
    ?>

    <?php

    if (!empty($_GET['msg'])) {
        ?>

        <script>

            history.replaceState(null, '', location.pathname);
        </script>


        <?php
    }
    ?>

</body>

</html>