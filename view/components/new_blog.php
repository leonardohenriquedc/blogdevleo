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
