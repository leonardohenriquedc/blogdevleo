use axum::{extract::Path, response::Html};
use tracing::info;

use crate::{components::BlogView, format_html, structs::ReqNameBlog};

#[axum::debug_handler]
pub async fn blog_handler(Path(params): Path<ReqNameBlog>) -> Html<String> {
    info!("Call this route: blog_handler");
    let renderer =
        yew::ServerRenderer::<BlogView>::with_props(move || ReqNameBlog { name: params.name })
            .render()
            .await;

    Html(format_html!(renderer))
}
