FROM nginx:latest

WORKDIR /app

RUN apt update && apt install -y procps
COPY ./nginx.conf /etc/nginx/nginx.conf
RUN rm /etc/nginx/conf.d/default.conf
