FROM node:22.7.0-alpine

WORKDIR /app/src/client

COPY package*.json ./

RUN npm install

COPY  . .

CMD [ "npm" ,"run" ,"dev" ]