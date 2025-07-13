# Используем официальный образ Node.js 20 для сборки React
FROM node:22-alpine AS builder
# Устанавливаем рабочую директорию
WORKDIR /app
# Копируем package.json и package-lock.json
COPY package*.json ./
# Устанавливаем зависимости
RUN npm install
# Копируем код фронтенда
COPY . .
# Собираем React приложение
RUN npm run build

# Используем Nginx для сервировки
FROM nginx:alpine
# Копируем собранные файлы
COPY --from=builder /app/build /usr/share/nginx/html
# Копируем конфигурацию Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf
# Открываем порт 80
EXPOSE 80
# Запускаем Nginx
CMD ["nginx", "-g", "daemon off;"]
