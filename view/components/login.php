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
