# INF653 Quotes API — Midterm Project

**Student:** [Your Name Here]  
**Course:** INF653 — Back End Web Development, Spring 2026

---

## Overview

A PHP OOP REST API for famous and user-submitted quotations. Built with PHP 8.2, Apache, and PostgreSQL, deployed via Docker on Render.com.

## 🚀 Live Project

**API Base URL:** https://inf653-midterm-ff8m.onrender.com

**Endpoints:**
- `GET /api/quotes/` — All quotes
- `GET /api/authors/` — All authors
- `GET /api/categories/` — All categories

## Tech Stack

- **Language:** PHP 8.2
- **Server:** Apache (via Docker)
- **Database:** PostgreSQL 15
- **Hosting:** Render.com (Docker Web Service + PostgreSQL)

## Setup (Local Development)

Requires [Docker Desktop](https://www.docker.com/products/docker-desktop/).

```bash
git clone <your-repo-url>
cd <project-folder>
docker compose up --build -d
```

API available at: `http://localhost:8080`

## API Reference

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/quotes/` | All quotes |
| GET | `/api/quotes/?id=X` | Single quote |
| GET | `/api/quotes/?author_id=X` | Quotes by author |
| GET | `/api/quotes/?category_id=X` | Quotes by category |
| POST | `/api/quotes/` | Create a quote |
| PUT | `/api/quotes/` | Update a quote |
| DELETE | `/api/quotes/` | Delete a quote |
| GET | `/api/authors/` | All authors |
| GET | `/api/authors/?id=X` | Single author |
| POST | `/api/authors/` | Create an author |
| PUT | `/api/authors/` | Update an author |
| DELETE | `/api/authors/` | Delete an author |
| GET | `/api/categories/` | All categories |
| GET | `/api/categories/?id=X` | Single category |
| POST | `/api/categories/` | Create a category |
| PUT | `/api/categories/` | Update a category |
| DELETE | `/api/categories/` | Delete a category |
