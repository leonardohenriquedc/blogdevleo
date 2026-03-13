use std::env;

use yew::prelude::*;

use crate::service::get_all_name_title_blogs;

#[function_component(BodyMain)]
pub fn body_main() -> Html {
    let title_blogs = get_all_name_title_blogs();

    html! {
        <main class="d-flex flex-column align-items-center justify-content-center my-4">
            <ul>
                {
                    for title_blogs.iter().map(|(name, title)| {
                        html! {
                            <li class="mb-2">
                                <a class="text-decoration-none text-body"
                                   href={format!("{}blog/{}", env::var("DOMAIN").unwrap(), name)}>
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
