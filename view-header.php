<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customers.php">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sales.php">Sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customers-with-purchase.php">Customers With Purchases</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="saleitems.php">Sale Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customers-chart.php">Customers Chart</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Title -->
    <header class="bg-primary text-white text-center py-5">
        <h1 class="display-4"><?= htmlspecialchars($pageTitle); ?></h1>
    </header>

    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="mb-4">Welcome to the Dashboard</h2>
        <p>This is where you can explore data and insights. Below are some links to other pages:</p>
        <ul>
            <li><a href="post.php">Go to Post Page</a></li>
            <li><a href="get.php">Go to Get Page</a></li>
        </ul>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-5">
        <p>&copy; <?= date("Y"); ?> My Website | All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS (Including Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
