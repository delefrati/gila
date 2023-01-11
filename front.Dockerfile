FROM node:alpine
WORKDIR /opt/app-front
COPY package.json /opt/app-front
RUN yarn install
COPY . /opt/app-front
CMD [“yarn”, “run”, “start”]