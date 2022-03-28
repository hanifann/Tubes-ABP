<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="assets/images/logo.png" height="96" class='mb-4'>
                                <h3>Daftar</h3>
                                <p>Daftar untuk mengakses Dashboard</p>
                            </div>
                            <form action="{{ route('user.register') }}" method="POST">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nama</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Email</label>
                                            <input type="email" id="last-name-column" class="form-control"
                                                name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Password</label>
                                            <input type="password" id="country-floating" class="form-control"
                                                name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Alamat</label>
                                            <input type="text" id="country-floating" class="form-control"
                                                name="address">
                                        </div>
                                    </div>
                                </diV>
                                <a href="/login">Have an account? Login</a>
                                <div class="clearfix">
                                    <button class="btn btn-primary float-end">Daftar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>