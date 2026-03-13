FROM rust:latest 

WORKDIR /blogdevleo

COPY . . 

RUN rm -rf dist 

RUN cargo build 

CMD ["cargo", "run"]

EXPOSE 8080
