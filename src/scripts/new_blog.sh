#!/bin/bash

echo "Welcome CLI of the my blog, Please provide the following information: title, author,  date and tags if applicable."

init="---"
path_content="content/"
final="---"

create_new_blog() {

  local file="${1,,}"
  file="${file// /-}"

  cat >"$path_content$file.md" <<EOF
$init
title: $1
author: $2
data: $3
tags: [$4]
$final
EOF

}
