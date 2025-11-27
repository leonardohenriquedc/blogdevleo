use axum::{extract::Path, response::Html};

use crate::{components::BlogView, format_html, structs::ReqNameBlog};

#[axum::debug_handler]
pub async fn blog_handler(Path(params): Path<ReqNameBlog>) -> Html<String> {
    let renderer =
        yew::ServerRenderer::<BlogView>::with_props(move || ReqNameBlog { name: params.name })
            .render()
            .await;

    Html(format_html!(renderer))
}
