<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <?php include __DIR__ . "/components/header.php"; ?>

    <main class="d-flex flex-column align-items-center justify-content-center my-4">
        <ul>
            <?php foreach ($nameAndTitles as $line): ?>
                <li class="mb-3">
                    <a class="text-decoration-none text-body"
                       href="index.php?to=blog&title=<?php echo urlencode(
                           $line["router"],
                       ); ?>">
                        <?php echo $line["title"]; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
