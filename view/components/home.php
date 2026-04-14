<main class="d-flex flex-column align-items-center justify-content-center my-4">
    <ul>
        <?php foreach ($data as $line): ?>
            <li class="mb-3">
                <a class="text-decoration-none text-body"
                    href="/blogs/to_blog/<?php echo urlencode(
                        $line["router"],
                    ); ?>">
                    <?php echo $line["title"]; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</main>
