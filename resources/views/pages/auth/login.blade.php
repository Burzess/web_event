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
            <div class="d-flex flex-column align-items-center hero gap-5">
                <div>
                    <div class="hero-headline text-start">
                        Sign In
                    </div>
                </div>
                <form action="" class="form-login d-flex flex-column mt-4 mt-md-0 p-30">
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
                    <div class="d-grid mt-2 gap-4">
                        <!-- <button class="btn-green">
                            Sign In
                        </button> -->
                        <a href="" class="btn-green">
                            Sign In
                        </a>
                        <a href="{{ route('oauth.google') }}" class="btn-navy">
                            Login with Google
                        </a>
                        <a href="{{ route('participant.register')}}" class="btn-navy">
                            Create New Account
                        </a>
                    </div>
                </form>
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