<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlogDevLeo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
      html, body {
        height: 100%;
      }
    </style>
  </head>

  <body class="d-flex flex-column min-vh-100">
    
    <?php include __DIR__ . "/components/header.php"; ?>

    <!-- Conteúdo principal -->
    <main class="flex-grow-1">
      <div class="container py-4">
        <?php include __DIR__ . $view; ?>
      </div>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . "/components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>