use std::env;

use yew::prelude::*;

use crate::{css, service::get_all_name_title_blogs};

#[function_component(BodyMain)]
pub fn body_main() -> Html {
    let title_blogs = get_all_name_title_blogs();

    let css_main = css!({
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    });

    let css_ul = css!({
        display: flex;
        width: 60dvw;
        justify-content: start;
        text-align: justify;
        flex-direction: column;
        gap: 10px;
    });

    let css_a = css! ({
        text-decoration: none;
    });

    html! {
        <main style={css_main}>
            <ul style={css_ul}>
                {
                    for title_blogs.iter().map(|(name, title)| {
                        html! {
                            <li>
                                <a style={css_a.clone()} href={format!("{}blog/{}",env::var("DOMAIN").unwrap(), name)}>
                                    { title }
                                </a>
                            </li>
                        }
                    })
                }
            </ul>
        </main>
    }
}
