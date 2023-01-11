FROM node:alpine
WORKDIR /opt/front
COPY ./front/package.json /opt/front/
#RUN npm install
COPY . /opt/front
CMD ["npm", "start"]