<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/blogs/to_home">BlogDevLeo.com</a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="menu" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/blogs/to_blog/contacts">Contatos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/blogs/to_blog/about">Sobre</a></li>
                    <?php if (empty($_COOKIE["token"])): ?>
                        <li class="nav-item"><a class="nav-link" href="/auth/login">Entrar</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/blogs_admin/new_blog">Criar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
