use yew::{Html, function_component, html};

use crate::components::Header;
use crate::service::get_content_blog;
use crate::structs::ReqNameBlog;

#[function_component(BlogView)]
pub fn blog_view(name: &ReqNameBlog) -> Html {
    let content = get_content_blog(name.name.clone());

    html! {
                <>
            <Header />

            <main class="container my-4">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        // Aqui você pode sobrescrever pequenas coisas se necessário
                        <div class="text-justify">
                            { Html::from_html_unchecked(content.into()) }
                        </div>
                    </div>
                </div>
            </main>
        </>
    }
}
