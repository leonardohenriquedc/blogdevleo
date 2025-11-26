use axum::{Router, routing::get};
use dotenv::dotenv;
use ssr::blog_handler;
use ssr::home_handler;
use tracing::info;

mod components;
mod service;
mod ssr;
mod structs;

#[tokio::main]
async fn main() {
    dotenv().ok();

    tracing_subscriber::fmt::init();
    info!("Server started");

    // build our application with a single route
    let app = Router::new()
        .route("/", get(home_handler))
        .route("/blog/{name}", get(blog_handler));

    // run our app with hyper, listening globally on port 3000
    let listener = tokio::net::TcpListener::bind("0.0.0.0:3000").await.unwrap();
    axum::serve(listener, app).await.unwrap();
}
