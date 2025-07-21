# DocVault 
is a web application for secure document storage, management, and sharing with access control, versioning, and analytics. It enables users to upload files, generate temporary sharing links, and track download activity while ensuring high security standards and GDPR compliance.

## Technology Stack

    Frontend: React, Tailwind CSS

    Backend: Laravel (PHP), Express.js (Node.js), FastAPI (Python)

    Database: PostgreSQL

    Caching: Redis

    Object Storage: Amazon S3 (or MinIO for local development)

    Containerization: Docker, Docker Compose

    CI/CD: GitHub Actions

    Cloud Hosting: AWS (EC2 / S3) or equivalent provider

## 📡 API Overview

The API follows RESTful conventions and is organized into several core modules: authentication, file management, Storage interaction, and user account operations. All requests should be sent with appropriate headers, and most routes require authorization via Bearer token.

🔗 Full Postman Documentation: [https://documenter.getpostman.com/view/46791452/2sB34kFeyK](https://documenter.getpostman.com/view/46791452/2sB34kFeyK)

### 🔐 Authentication
- `POST /api/register` – Register a new user
- `POST /api/login` – Log in with email and password
- `POST /api/logout` – Log out the current user

### 📄 File Management
- `GET /api/files` – List all your uploaded files
- `POST /api/files` – Upload a new file
- `DELETE /api/files/{id}` – Delete a file
- `PATCH /api/files/{id}` – Update the information about a file

### 🤝 Storage interaction
- `GET /api/files/upload-url` – get a link to Storage for uploading a file
- `GET /api/files/download-url` – get a link to Storage for downloading a file

### 👤 User Profile
- `GET /api/user` – Get authenticated user data

All endpoints return standardized JSON responses.  
Refer to the [Postman documentation](https://documenter.getpostman.com/view/46791452/2sB34kFeyK) for detailed request/response examples, headers, and error codes.

