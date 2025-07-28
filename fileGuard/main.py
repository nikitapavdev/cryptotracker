from fastapi import FastAPI

app = FastAPI()

@app.post("/secure")
async def post_secure():
    return {"message": "secured"}
