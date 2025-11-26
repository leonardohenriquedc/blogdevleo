use crate::components::BodyMain;
use crate::components::Header;
use yew::prelude::*;

#[function_component(App)]
pub fn app() -> Html {
    html! {
        <>
            <Header />
            <BodyMain />
        </>
    }
}
