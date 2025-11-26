use serde::Deserialize;
use yew::Properties;
#[derive(Deserialize, Properties, PartialEq)]
pub struct ReqNameBlog {
    pub name: String,
}
