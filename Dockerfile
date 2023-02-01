FROM ubuntu:latest

RUN apt update
RUN apt install --yes --no-install-recommends curl ca-certificates git

RUN curl https://install.meteor.com/ | sh

ENV METEOR_ALLOW_SUPERUSER=true

CMD meteor
