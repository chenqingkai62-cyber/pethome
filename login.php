<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <form
                        action="login_process.php"
                        method="post"
                        autocomplete="off"
                        class="sign-in-form">
                        <div class="logo">
                            <img src="images/logo.jpg" alt="easyclass" />
                            <a
                                href="index.php"
                                style="text-decoration: none"
                                class="backbtn">Pet Adoption System Home Page</a>
                        </div>

                        <div class="heading">
                            <h2>Welcome&nbsp;Log In</h2>
                            <h6>Don't have an account yet?</h6>
                            <a href="#" class="toggle">Click to Register</a>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input
                                    type="text"
                                    minlength="4"
                                    class="input-field"
                                    autocomplete="off"
                                    name="username"
                                    required />
                                <label>Username</label>
                            </div>

                            <div class="input-wrap">
                                <input
                                    type="password"
                                    minlength="4"
                                    class="input-field"
                                    autocomplete="off"
                                    name="password"
                                    required />
                                <label>password</label>
                            </div>
                            <div class="input-wrap">
                                <input type="checkbox" name="remember_me" /> Seven days without login
                            </div>
                            <input type="submit" value="Log In" class="sign-btn" />

                            <p class="text">
                                By logging in, you agree
                                <a href="#">Terms of Service</a> and
                                <a href="#">Privacy Policy</a>
                            </p>
                        </div>
                    </form>

                    <form
                        action="register_process.php"
                        method="post"
                        autocomplete="off"
                        class="sign-up-form">
                        <div class="logo">
                            <img src="images/logo.jpg" alt="easyclass" />
                            <a
                                href="index.php"
                                style="text-decoration: none"
                                class="backbtn">Pet Adoption System Home</a>
                        </div>
                        <div class="heading">
                            <h2>User&nbsp;Register</h2>
                            <h6>Already have an account?Click</h6>
                            <a href="#" class="toggle">Log In</a>
                        </div>
                        <div class="actual-form">
                            <div class="input-wrap">
                                <input
                                    type="text"
                                    minlength="4"
                                    class="input-field"
                                    autocomplete="off"
                                    name="username"
                                    required />
                                <label>Username</label>
                            </div>
                            <div class="input-wrap">
                                <input
                                    type="password"
                                    minlength="4"
                                    class="input-field"
                                    autocomplete="off"
                                    name="password"
                                    required />
                                <label>password</label>
                            </div>
                            <div class="input-wrap">
                                <input
                                    type="password"
                                    minlength="4"
                                    class="input-field"
                                    autocomplete="off"
                                    name="repassword"
                                    required />
                                <label>Confirm Password</label>
                            </div>
                            <div class="input-wrap">
                                <input
                                    type="text"
                                    class="input-field"
                                    autocomplete="off"
                                    name="name"
                                    required />
                                <label>name</label>
                            </div>
                            <div class="input-wrap">
                                <input
                                    type="text"
                                    class="input-field"
                                    autocomplete="off"
                                    name="phone"
                                    required />
                                <label>Contact Information</label>
                            </div>
                            <input type="submit" value="Register" class="sign-btn" />
                            <p class="text">
                                By registering, you agree
                                <a href="#">Terms of Service</a> and
                                <a href="#">Privacy Policy</a>
                            </p>
                        </div>
                    </form>
                </div>

                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="images/l1.jpg" class="image img-1 show" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/login.js"></script>
</body>

</html>