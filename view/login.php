
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
      <?php include __DIR__ . "/components/header.php"; ?>
      <main class="container d-flex justify-content-center align-items-center vh-100">
          <div class="card shadow p-4" style="width: 350px;">
              <h3 class="text-center mb-3">Login</h3>
              <?php echo isset($error) && !empty($error)
                  ? "<p class='text-danger text-center'>$error</p>"
                  : ""; ?>
              <form method="POST" action="/auth/validate">
                  <input type="hidden" name="csrf_token" value="<?= App\Core\Session::get(
                      "csrf_token",
                  ) ?>">
                  <div class="mb-3">
                      <label class="form-label">Usuário</label>
                      <input type="text" name="email" class="form-control" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Senha</label>
                      <input type="password" name="password" class="form-control" required>
                  </div>

                  <button type="submit" class="btn btn-primary w-100">
                      Entrar
                  </button>
              </form>
          </div>
      </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
