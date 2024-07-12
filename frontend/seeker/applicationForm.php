<!DOCTYPE html>

<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>


    <?php require_once ('../navbar.php') ?>

    <div>
        <div class="container mt-96 mx-auto py-12">

            <div class="max-w-lg mx-auto px-4">
                <h2 class="text-3xl font-semibold text-gray-900 mb-4">
                    starting working with us
                </h2>
                <p class="text-gray-700 mb-8">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sagittis velit
                    eget nisi lobortis dignissim.
                </p>
                <form action="handleSendApplication.php" method="post" class="bg-white rounded-lg px-6 py-8 shadow-md">
                    <input type="hidden" name="jobId" value="<?= $_GET['jobId'] ?>">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="title">title</label>
                        <input
                            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="title" name="title" type="title" placeholder="enter your title">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="message">Message</label>
                        <textarea
                            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="content" name="content" rows="6" placeholder="Enter your message"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button
                            class="bg-red-500 hover:bg-red-700 duration-200 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>