<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semina | Sign In</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="../assets/scss/main.css" />
</head>

<body>
    <section class="login header bg-navy">
        <div class="container">
            <div class="row row-cols-md-12 row-cols-1 d-flex justify-content-center align-items-center hero">
                <div class="col-md-6">
                    <div class="hero-headline text-start">
                        Expand Your <br class="d-none d-md-block" />
                        Knowledge & Skills
                    </div>
                    <p class="hero-paragraph text-start">
                        Kami menyediakan berbagai acara terbaik untuk membantu <br class="d-none d-lg-block" />
                        anda dalam meningkatkan skills di bidang teknologi
                    </p>
                </div>
                <div class="col-md-6">
                    <form action="" class="form-login d-flex flex-column mt-4 mt-md-0">
                        <!-- First Name -->
                        <div class="d-flex flex-column align-items-start">
                            <label for="first_name" class="form-label">
                                First Name
                            </label>
                            <input type="text" placeholder="First name here" class="form-control" id="first_name">
                        </div>
                        <!-- Last Name -->
                        <div class="d-flex flex-column align-items-start">
                            <label for="last_name" class="form-label">
                                Last Name
                            </label>
                            <input type="text" placeholder="Last name here" class="form-control" id="last_name">
                        </div>
                        <!-- Email -->
                        <div class="d-flex flex-column align-items-start">
                            <label for="email_address" class="form-label">
                                Email
                            </label>
                            <input type="email" class="form-control" id="email_address" placeholder="semina@bwa.com">
                        </div>
                        <!-- Password -->
                        <div class="d-flex flex-column align-items-start">
                            <label for="password" class="form-label">
                                Password (6 characters)
                            </label>
                            <input type="password" class="form-control" id="password" placeholder="Type your password">
                        </div>
                        <!-- Role -->
                        <div class="d-flex flex-column align-items-start">
                            <label for="role" class="form-label">
                                Role
                            </label>
                            <input type="text" class="form-control" id="role" placeholder="ex: Product Designer">
                        </div>
                        <div class="d-grid mt-2">
                            <button class="btn-green">
                                Sign Up
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>