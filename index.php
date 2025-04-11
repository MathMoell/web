<?php
$posts = file_exists('posts.txt') ? file('posts.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
$bannerImages = ['info.jpg', 'matrix.jpg', 'nova.jpg', 'supa.jpg'];
$randomBanner = $bannerImages[array_rand($bannerImages)];

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moell Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            height: 50vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .navbar {
            position: absolute;
            width: 100%;
            z-index: 1000;
            background: transparent !important;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 1rem 0;
            z-index: 1000;
        }
        .content-wrapper {
            min-height: calc(100vh - 56px);
            padding-bottom: 80px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="?page=home">Moell</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=home">Avaleht</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=about">Minust</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=contact">Kontakt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=admin">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        <?php if($page === 'home'): ?>
            <header class="hero" style="background-image: url('<?php echo $randomBanner; ?>')">
                <div class="hero-content">
                    <h1 class="display-4">Minu Blogi</h1>
                    <p class="lead">Mathias Möll IT-23</p>
                </div>
            </header>

            <main class="container my-5">
                <?php
                $firstPosts = array_slice($posts, 0, 4);
                foreach($firstPosts as $post) {
                    $parts = explode('|', $post);
                    if(count($parts) === 2):
                ?>
                    <article class="mb-5">
                        <h2><?php echo htmlspecialchars($parts[0]); ?></h2>
                        <p class="text-muted"><?php echo htmlspecialchars($parts[1]); ?></p>
                    </article>
                <?php 
                    endif;
                }
                ?>
                <div class="text-center mt-5">
                    <a href="?page=allposts" class="btn btn-primary">Eelnevad postitused →</a>
                </div>
            </main>

        <?php elseif($page === 'about'): ?>
            <div class="container mt-5 pt-5">
                <h1>Minust</h1>
                <p>See on minust Blog</p>
            </div>

        <?php elseif($page === 'contact'): ?>
            <div class="container mt-5 pt-5">
                <h1>Kontakt</h1>
                <p>Tel: +372 582 3492</p>
            </div>

        <?php elseif($page === 'admin'): ?>
            <div class="container mt-5 pt-5">
                <h1>Admin</h1>
                <form action="admin_handler.php" method="post" class="mb-4">
                    <div class="mb-3">
                        <label for="title" class="form-label">Pealkiri</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Sisu</label>
                        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Lisa postitus</button>
                </form>

                <h2>Olemasolevad postitused</h2>
                <?php
                foreach($posts as $index => $post) {
                    $parts = explode('|', $post);
                    if(count($parts) === 2):
                ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($parts[0]); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($parts[1]); ?></p>
                            <form action="admin_handler.php" method="post" style="display: inline;">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm">Kustuta</button>
                            </form>
                        </div>
                    </div>
                <?php 
                    endif;
                }
                ?>
            </div>

        <?php elseif($page === 'allposts'): ?>
            <div class="container mt-5 pt-5">
                <h1>Kõik postitused</h1>
                <?php
                foreach($posts as $post) {
                    $parts = explode('|', $post);
                    if(count($parts) === 2):
                ?>
                    <article class="mb-5">
                        <h2><?php echo htmlspecialchars($parts[0]); ?></h2>
                        <p class="text-muted"><?php echo htmlspecialchars($parts[1]); ?></p>
                    </article>
                <?php 
                    endif;
                }
                ?>
            </div>

        <?php else: ?>
            <div class="container mt-5 pt-5">
                <h1>404 - Sa pole piisavalt äge</h1>
                <p>Leht on katki :c</p>
            </div>
        <?php endif; ?>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <a href="#" class="text-dark text-decoration-none">Moell</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
