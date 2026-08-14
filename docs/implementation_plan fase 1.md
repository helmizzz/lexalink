# Fase 1: Data Foundation, Scraping, & Broker Connection

Tujuan dari fase ini adalah membangun infrastruktur dasar (pipa data) untuk menyedot data *live price* dan berita ekonomi, serta menyediakannya via WebSocket untuk UI (Fase 3) dan database (TimescaleDB) untuk AI (Fase 2).

## User Review Required

> [!IMPORTANT]
> Proyek baru ini akan dibangun di dalam direktori `c:\laragon\www\aitrade\nofx-trading-agent`. Apakah nama folder ini sudah sesuai?

> [!TIP]
> Saya merekomendasikan penggunaan **Redis** sebagai *Message Broker* antara tugas *background* (seperti WebSocket stream dari OANDA) dan *endpoint* WebSocket FastAPI agar aplikasi lebih *scalable*. Apakah kamu setuju untuk memasukkan Redis ke dalam `docker-compose`?

## Open Questions

1. **Kredensial Broker**: Untuk saat ini, modul broker (`oanda.py`) dan scraper (`myfxbook.py`) akan dibuat kerangkanya (*stubs/mock*) terlebih dahulu agar sistem bisa di-test tanpa harus memasukkan API Key sungguhan. Apakah ini sesuai dengan keinginanmu, atau kamu ingin langsung mengintegrasikan API Key riil?
2. **Library Database**: Saya berencana menggunakan `SQLAlchemy` (Async) bersama `asyncpg` untuk koneksi FastAPI ke TimescaleDB. Apakah kamu punya preferensi library lain?

## Proposed Changes

Berikut adalah *file* yang akan dibuat di dalam folder `nofx-trading-agent`:

### Infrastruktur & Konfigurasi

#### [NEW] [docker-compose.yml](file:///c:/laragon/www/aitrade/nofx-trading-agent/docker-compose.yml)
- *Service* `db`: Menggunakan *image* TimescaleDB (PostgreSQL).
- *Service* `redis`: Menggunakan *image* Redis alpine.
- *Service* `backend`: *Build* dari folder `backend/`.

#### [NEW] [.env](file:///c:/laragon/www/aitrade/nofx-trading-agent/.env)
- Variabel lingkungan untuk koneksi DB, Redis, dan kerangka API Key broker.

### Database

#### [NEW] [init.sql](file:///c:/laragon/www/aitrade/nofx-trading-agent/database/init.sql)
- Tabel `candlesticks` (dioptimalkan sebagai *hypertable* TimescaleDB).
- Tabel `economic_calendar` untuk jadwal berita (*High Impact*).
- Tabel `market_sentiment` untuk data rasio *Long/Short*.

### Backend (FastAPI)

#### [NEW] [Dockerfile](file:///c:/laragon/www/aitrade/nofx-trading-agent/backend/Dockerfile)
- Berbasis `python:3.11-slim`, menginstal *requirements*, dan Playwright *browsers*.

#### [NEW] [requirements.txt](file:///c:/laragon/www/aitrade/nofx-trading-agent/backend/requirements.txt)
- `fastapi`, `uvicorn`, `sqlalchemy`, `asyncpg`, `playwright`, `redis`, `websockets`, `python-dotenv`.

#### [NEW] [main.py](file:///c:/laragon/www/aitrade/nofx-trading-agent/backend/app/main.py)
- Inisialisasi FastAPI.
- *Endpoint* WebSocket `/ws/live-ticks` yang membaca dari *Redis channel*.

#### [NEW] [config.py](file:///c:/laragon/www/aitrade/nofx-trading-agent/backend/app/config.py)
- Membaca `.env` menggunakan `pydantic-settings`.

#### [NEW] [database.py](file:///c:/laragon/www/aitrade/nofx-trading-agent/backend/app/database.py)
- Koneksi *async* SQLAlchemy ke TimescaleDB.

#### [NEW] [oanda.py](file:///c:/laragon/www/aitrade/nofx-trading-agent/backend/app/brokers/oanda.py)
- Kerangka fungsi untuk *HTTP Streaming* harga dan pengiriman order (*Buy/Sell*).

#### [NEW] [myfxbook.py](file:///c:/laragon/www/aitrade/nofx-trading-agent/backend/app/scraper/myfxbook.py)
- Kerangka fungsi menggunakan *Playwright* untuk *scraping* berita *High Impact* secara berkala.

## Verification Plan

### Manual Verification
1. Menjalankan `docker-compose up -d --build`.
2. Memeriksa status *container* `db`, `redis`, dan `backend` pastikan semuanya berjalan (*running*).
3. Mengakses dokumentasi FastAPI di `http://localhost:8000/docs`.
4. Mencoba melakukan koneksi ke WebSocket `ws://localhost:8000/ws/live-ticks` untuk melihat apakah koneksi diterima.
