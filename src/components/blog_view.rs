use yew::{Html, function_component, html};

use crate::components::Header;
use crate::css;
use crate::service::get_content_blog;
use crate::structs::ReqNameBlog;

#[function_component(BlogView)]
pub fn blog_view(name: &ReqNameBlog) -> Html {
    let content = get_content_blog(name.name.clone());

    let css_main = css!({

            body {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

            main {
                max-width: 70%;
                text-align: justify;
            }

            table {
          border-collapse: collapse;
          /* junta as bordas */
          width: 100%;
          /* opcional, ocupar toda a largura */
        }

        table,
        th,
        td {
          border: 1px solid #444;
          /* cor da borda */
        }

        pre {
          display: flex;
          justify-content: center;
        }

        @media only screen and (min-width: 1025px) {
          body>main {
            max-width: 60dvw;
          }
        }

        h1 {
          text-align: center;
        }

        hr {
          width: 100%;
        }
        });

    html! {
        <>

        <head>
            <style>{css_main}</style>
        </head>
            <Header />
            <main >
                { Html::from_html_unchecked(content.into()) }
            </main>
        </>
    }
}
