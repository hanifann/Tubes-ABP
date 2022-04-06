<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forbidden</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="error">

        <div class="container text-center pt-32">
            <h1 class='error-title'>403</h1>
            <p>You're not allowed in here</p>
            <a href="{{ route('index') }}" class='btn btn-primary'>Go Home</a>
        </div>
    </div>
</body>

</html>