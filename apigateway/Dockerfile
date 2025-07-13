# Используем официальный образ Node.js 20 LTS
FROM node:22-alpine
# Устанавливаем рабочую директорию
WORKDIR /app
# Копируем package.json и package-lock.json
COPY package*.json ./
# Устанавливаем зависимости, включая express и socket.io
RUN npm install
# Копируем код приложения
COPY . .
# Открываем порт для Express.js и WebSocket
EXPOSE 3000
# Запускаем сервер Express.js
CMD ["node", "index.js"]
