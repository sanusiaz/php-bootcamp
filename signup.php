<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIgnup</title>


    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="w-full h-screen flex items-center justify-center bg-indigo-100">
      <form method="POST" action="./register.php" class="w-full md:w-1/3 rounded-lg">
        <div class="flex font-bold justify-center mt-6">
          <img class="h-20 w-20 mb-3" src="https://dummyimage.com/64x64" />
        </div>
        <h2 class="text-2xl text-center text-gray-200 mb-8">Register</h2>
        <div class="px-12 pb-10">
          <div class="w-full mb-2">
            <div class="flex items-center">
              <input
                type="text"
                id="first_name"
                placeholder="First name"
                name="first_name"
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
          <div class="w-full mb-2">
            <div class="flex items-center">
              <input
                type="text"
                id="last_name"
                name="last_name"
                placeholder="Last Name"
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
          <div class="w-full mb-2">
            <div class="flex items-center">
              <input
                type="text"
                id="username"
                name="username"
                placeholder="Choose username"
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
          <div class="w-full mb-2">
            <div class="flex items-center">
              <input
                type="text"
                name="email"
                id="email"
                placeholder="Email Address"
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
          <div class="w-full mb-2">
            <div class="flex items-center">
              <input
                type="password"
                name="password"
                placeholder="Password"
                class="
                  w-full
                  border
                  rounded
                  px-3
                  py-2
                  text-gray-700
                  focus:outline-none
                "

                maxlength="20"
              />
            </div>
          </div>
          <div class="w-full mb-2">
            <div class="flex items-center">
              <input
                type="password"
                name="confirm_password"
                placeholder="Confirm Password"
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
            Create an account
          </button>


          <a href="./login.php" class="text-gray-800 text-center m-auto text-xs block py-5">Already Have an account</a>

        </div>
      </form>
    </div>
</body>
</html>