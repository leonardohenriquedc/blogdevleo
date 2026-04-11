FROM php:latest 

WORKDIR blogdevleo 

COPY ..

RUN composer install




