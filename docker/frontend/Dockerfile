FROM node:22-alpine

WORKDIR /src

RUN apk add --no-cache libc6-compat

EXPOSE 3000

CMD ["sh", "-c", "yarn install && yarn run dev -- --host 0.0.0.0"]
