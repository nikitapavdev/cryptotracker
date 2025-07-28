import logging
from fastapi import FastAPI

app = FastAPI()

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

@app.post("/secure")
async def post_secure():
    logger.info('connected');
    return {"message": "secured"}
