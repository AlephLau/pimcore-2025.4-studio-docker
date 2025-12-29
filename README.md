# Pimcore 2025.4 + Studio UI (Docker, ready-to-use)

This repository provides a **fully working Pimcore 2025.4 local development environment** with the **new Pimcore Studio (Backend + UI)** already configured.

The goal of this project is simple:

> **Clone → Docker up → Run a few commands → Start working with Pimcore Studio**

This repo exists because, as of Pimcore **2025.4**, installing the new Studio stack requires combining multiple pieces of documentation with no clear step-by-step path:
- Platform Version
- Generic Execution Engine
- Generic Data Index
- OpenSearch
- Mercure
- Studio Backend
- Studio UI
- New parameters on config.yaml
- Messenger + Supervisor configuration

All that work is already done here.

---

## ⚠️ Important Notes

- **Development only** – not production-ready.
- **Not affiliated with or endorsed by Pimcore GmbH.**

---

## 📋 Requirements

- Docker Engine
- Docker Compose

---

## 🚀 Quick Start

### 1. Clone the repository
```bash
git clone https://github.com/AlephLau/pimcore-2025.4-studio-docker.git
cd pimcore-2025.4-studio-docker
```

---

### 2. Start containers
```bash
docker compose up -d
```

---

### 3. Prepare Pimcore directories
```bash
docker compose exec php mkdir -p var/tmp var/cache var/log
docker compose exec php chmod -R 777 var/
```

---

### 4. Install PHP dependencies
```bash
docker compose exec php composer install --no-scripts
```

---

### 5. Install Pimcore (interactive)
```bash
docker compose exec php vendor/bin/pimcore-install
```
- Enter admin username (e.g., `admin`)
- Enter admin password
- Open the registration link provided, get your product key
- Paste the product key

---

### 6. Install required bundles
```bash
docker compose exec php bin/console pimcore:bundle:install PimcoreGenericExecutionEngineBundle
docker compose exec php bin/console pimcore:bundle:install PimcoreGenericDataIndexBundle
docker compose exec php bin/console pimcore:bundle:install PimcoreStudioBackendBundle
docker compose exec php bin/console pimcore:bundle:install PimcoreStudioUiBundle
```

---

### 7. Build OpenSearch indexes
```bash
docker compose exec php bin/console generic-data-index:update:index -r
```

---

## ✅ Done!

### Access URLs

| URL | Description |
|-----|-------------|
| http://localhost:8000/admin | Classic Admin UI |
| http://localhost:8000/pimcore-studio | **New Studio UI** |
| http://localhost:8000/pimcore-studio/api/docs | API Documentation (Swagger) |

---

## 🧱 Architecture Overview

| Component | Purpose |
|-----------|---------|
| **RabbitMQ** | Message queue for background jobs (imports, exports, etc.) |
| **Supervisor** | Manages Messenger workers that process queues |
| **OpenSearch** | Search engine for Generic Data Index (fast asset/object search) |
| **Mercure** | Server-Sent Events for real-time Studio updates |
| **Studio Backend** | REST API with OpenAPI documentation |
| **Studio UI** | Modern React-based admin interface |

---

## 🧠 For Existing Pimcore Projects

Each architectural step is isolated into **separate commits** so you can inspect and adapt them to your own project:

```bash
git log --oneline
```

| Commit | Description |
|--------|-------------|
| 1 | Initial Pimcore skeleton |
| 2 | Platform Version 2025.4 setup |
| 3 | Generic Execution Engine + RabbitMQ + Supervisor |
| 4 | Generic Data Index + OpenSearch |
| 5 | Mercure + Nginx reverse proxy |
| 6 | Studio Backend Bundle + Security firewall |
| 7 | Studio UI Bundle |

Review each commit to see exactly which files were modified.

---

## 🔧 Troubleshooting

### "Missing topic parameter" on /hub
This is correct! It means Mercure is working. The endpoint expects SSE connections with a topic parameter.

### Permission errors on var/
```bash
docker compose exec php chmod -R 777 var/
```

### OpenSearch not connecting
Wait a few seconds after `docker compose up -d`. OpenSearch takes time to initialize.

---

## 📚 Resources

- [Pimcore Studio Documentation](https://pimcore.com/docs/platform/Pimcore/Pimcore_Studio)
- [Generic Data Index](https://pimcore.com/docs/platform/Generic_Data_Index)
- [Generic Execution Engine](https://pimcore.com/docs/platform/Generic_Execution_Engine)
- [Mercure](https://mercure.rocks)

---

## 🎬 Video Tutorial

📺 Step-by-step video tutorial: **[Coming Soon]**

---

## 📄 License

GPL-3.0 License – same as Pimcore.

---

## 👤 Author

**Aleph Lau**

- YouTube: [Coming Soon]
- Blog: [Coming Soon]
