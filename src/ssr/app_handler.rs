use crate::components::App;
use crate::format_html;
use axum::response::Html;
#[cfg(not(target_arch = "wasm32"))]
use yew::ServerRenderer;

pub async fn home_handler() -> Html<String> {
    let renderer = ServerRenderer::<App>::new();

    let html = renderer.render().await;

    Html(format_html!(html))
}
