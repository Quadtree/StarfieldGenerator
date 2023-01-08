FROM ubuntu:22.04
RUN apt-get update
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y php php-gd
