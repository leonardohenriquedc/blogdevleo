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
    </head>
    <body>
        {}
        <script src=\"/pkg/app.js\"></script>
    </body>
    </html>
    ",
            String::from($x)
        )
    };
}
