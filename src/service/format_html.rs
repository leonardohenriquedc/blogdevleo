#[macro_export]
macro_rules! format_html {
    ($x: expr) => {
        format!(
            "
    <!DOCTYPE html>
    <html lang=\"pt-br\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>BlogDevLeo</title>
        <!-- Bootstrap CSS -->
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    </head>
    <body>
        {}
        <script src=\"/pkg/app.js\"></script>
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js\"></script>
        
    </body>
    </html>
    ",
            String::from($x)
        )
    };
}
