use std::{
    env,
    fs::{self, read_to_string},
    str::FromStr,
};

use chrono::NaiveDate;
use linked_hash_map::LinkedHashMap;
use pulldown_cmark::{Options, Parser, html};

use crate::structs::BlogData;

pub fn get_all_name_title_blogs() -> LinkedHashMap<String, String> {
    let metadata_file: LinkedHashMap<String, String> = get_metadata_blogs()
        .iter()
        .map(|f| (f.name.clone(), f.title.clone()))
        .collect();

    metadata_file
}

pub fn get_content_blog(name: String) -> String {
    let mut file = read_to_string(format!(
        "{}{}",
        env::var("BLOG_FILES_CONTENT").unwrap(),
        name
    ))
    .expect("It is not possible a read file");

    remove_metadata_blogs(&mut file);

    parsing_md_to_html(file)
}

fn parsing_md_to_html(content: String) -> String {
    let options = Options::ENABLE_STRIKETHROUGH
        | Options::ENABLE_TABLES
        | Options::ENABLE_TASKLISTS
        | Options::ENABLE_FOOTNOTES
        | Options::ENABLE_MATH;
    let parser = Parser::new_ext(content.as_str(), options);

    let mut content_as_html = String::new();

    html::push_html(&mut content_as_html, parser);

    content_as_html
}

fn remove_metadata_blogs(file: &mut String) {
    for (line, line_content) in file.clone().lines().enumerate() {
        if line_content == "---" && line != 0 {
            *file = file.replace(line_content, "");

            break;
        }

        *file = file.replace(line_content, "");
    }
}

fn get_metadata_blogs() -> Vec<BlogData> {
    let path_contents = fs::read_dir(env::var("BLOG_FILES_CONTENT").unwrap())
        .expect("It is not possible to read the directory");

    let mut metadata_blogs: Vec<BlogData> = Vec::new();

    for entry in path_contents.filter_map(|f| f.ok()) {
        let file =
            fs::read_to_string(entry.path()).expect("It is not possible to read the directory");

        metadata_blogs.push(BlogData {
            name: entry.file_name().into_string().unwrap(),
            title: get_metadata_of_file(file.clone(), "title: ".to_string()),
            date: NaiveDate::from_str(get_metadata_of_file(file, "date: ".to_string()).as_str())
                .unwrap(),
        });
    }

    BlogData::sort_by_date(&mut metadata_blogs);
    metadata_blogs
}

fn get_metadata_of_file(file: String, metadado_name: String) -> String {
    let mut metadados: Vec<String> = Vec::new();

    for (index, line) in file.lines().enumerate() {
        if line == "---" && index != 0 {
            break;
        }

        if line != "---" {
            metadados.push(line.to_string());
        }
    }

    if !metadado_name.is_empty() {
        for line in &metadados {
            if line.starts_with(&metadado_name) {
                return line
                    .clone()
                    .strip_prefix(&metadado_name)
                    .expect("não foi possivel remover prefixo")
                    .to_string();
            }
        }
    }

    metadados.join("\n")
}
