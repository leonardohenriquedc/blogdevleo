use crate::css;
use std::env;
use yew::prelude::*;

#[function_component(Header)]
pub fn header() -> Html {
    let css_header = css!({
        display: flex;
        margin: auto;
        justify-content: space-around;
        width: 100%;
        align-items: center;
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
            <h1 style={css_h1}><a style={css_a} href={env::var("DOMAIN").unwrap()}> { "DevLeo.com" }</a></h1>
        </header>
        <hr />
        </>
    }
}
