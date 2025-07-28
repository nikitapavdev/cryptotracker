# Используем официальный образ Python 3.11
FROM python:3.11-slim
# Устанавливаем рабочую директорию
WORKDIR /app
# Копируем requirements.txt
COPY requirements.txt .
# Устанавливаем зависимости
RUN pip install --no-cache-dir -r requirements.txt
# Копируем код сервиса
COPY . .
# Открываем порт для FastAPI
ENV PORT=8080
EXPOSE 8080
# Запускаем Uvicorn
CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8080"]
