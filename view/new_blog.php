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

    <main class="container">
        <form class="form-control" method="POST" action="/blogs_admin/save_blog">
            <input type="hidden" name="csrf_token" value="<?= App\Core\Session::get(
                "csrf_token",
            ) ?>">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <input type="date" name="date" class="form-control">
                </div>

                <div class="col-md-6">
                    <input type="text" name="author" class="form-control" placeholder="Insira o primeiro nome do autor">
                </div>

                <div class="col-12">
                    <input type="text" name="title" class="form-control" placeholder="Insira o titulo do blog">
                </div>
            </div>

            <div class="mb-3">
                <textarea class="form-control" name="content" rows="50" placeholder="Insira o conteúdo do blog"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
