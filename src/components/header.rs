use std::env;
use yew::prelude::*;

#[function_component(Header)]
pub fn header() -> Html {
    html! {
                <>
    <header>
        <nav class="navbar navbar-light bg-light px-4 d-flex justify-content-around">
            <a class="navbar-brand fs-1" href={env::var("DOMAIN").unwrap()}>
            {"DevLeo.com"}
            </a>
            <a class="nav-link fs-1" href={format!("{}blog/about.md", env::var("DOMAIN").unwrap())}>
            {"About"}
            </a>
        </nav>
    </header>
                </>
            }
}
