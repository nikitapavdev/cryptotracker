from fastapi import FastAPI

app = FastAPI()

@app.get("/signals")
async def get_signals():
    return {"message": "FastAPI Service Placeholder"}
