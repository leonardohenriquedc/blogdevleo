use crate::css;
use askama::filters::format;
use std::env;
use yew::prelude::*;

#[function_component(Header)]
pub fn header() -> Html {
    let css_header = css!({
        position: sticky;
        top: 0;
        border-bottom-style: groove;
        display: flex;
        margin: auto;
        justify-content: space-around;
        width: 100vw;
        align-items: center;
        background-color: white;

    });
    let css_h1 = css! ({
        cursor: pointer
    });

    let css_a = css! ({
        text-decoration: none;
        color: black;
    });

    html! {
        <>
        <header style={css_header}>
            <h1 style={css_h1}><a style={css_a.clone()} href={env::var("DOMAIN").unwrap()}> { "DevLeo.com" }</a></h1>
            <h1><a style={css_a} href={format!("{}blog/about.md", env::var("DOMAIN").unwrap())}>{" About "}</a></h1>
        </header>
        </>
    }
}
