<?php

    if ( !session_start() )
    {
        session_start();
    }

    $error_message = (isset($_SESSION['error']) && !empty($_SESSION['error'])) ? $_SESSION['error'] : "";
    $success_message = (isset($_SESSION['success']) && !empty($_SESSION['success'])) ? $_SESSION['success'] : "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="w-full h-screen flex items-center justify-center bg-indigo-100">
      <form method="POST" action="./login_user.php" class="w-full md:w-1/3 rounded-lg">
        <div class="flex font-bold justify-center mt-6">
          <img class="h-20 w-20 mb-3" src="https://dummyimage.com/64x64" />
        </div>
        <h2 class="text-2xl text-center text-gray-200 mb-8">Reset Your Password</h2>
        <div class="px-12 pb-10">
          <div class="w-full mb-2">
            <div class="flex items-center">
              <input
                type="text"
                placeholder="Email Address"
                name="email"
                class="
                  w-full
                  border
                  rounded
                  px-3
                  py-2
                  text-gray-700
                  focus:outline-none
                "
              />
            </div>
          </div>
          <button
            type="submit"
            class="
              w-full
              py-2
              mt-8
              rounded-full
              bg-blue-400
              text-gray-100
              focus:outline-none
            "
          >
            Change Password
          </button>


          <a href="./signup.php" class="text-gray-800 text-center m-auto text-xs block py-5">Create an account</a>
          <a href="./login.php" class="text-gray-800 text-center m-auto text-xs block py-5">Already Have an account</a>
        </div>
      </form>
    </div>



    
    <?php if(!empty($error_message)):?>
        <div class="text-red text-sm p-3 overflow-hidden px-7 truncate text-ellipsis text-red-600 max-w-[200px] sm:max-w-[350px] md:max-w-[400px] fixed bottom-2 right-2 border-red-600 bg-red-300">
            <?= $error_message;?>
        </div>
    <?php endif;?>


    <?php if(!empty($success_message)):?>
        <div class="text-green text-sm p-3 overflow-hidden px-7 truncate text-ellipsis text-green-600 max-w-[200px] sm:max-w-[350px] md:max-w-[400px] fixed bottom-2 right-2 border-green-600 bg-green-300">
            <?= $success_message;?>
        </div>
    <?php endif;?>




    <?php
    
        if ( isset($_SESSION['success']) )
        {
            unset($_SESSION['success']);
        }


        if ( isset($_SESSION['error']) )
        {
            unset($_SESSION['error']);
        }
    ?>
</body>
</html>