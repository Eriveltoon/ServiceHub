# ServiceHub

Sistema de gerenciamento de empresas, projetos e tickets desenvolvido como teste técnico.

---

# 🚀 Objetivo

O ServiceHub simula um sistema de suporte técnico com:

- Gestão de empresas
- Gestão de projetos por empresa
- Abertura e acompanhamento de tickets
- Processamento assíncrono de dados técnicos via queue

---

# 🧱 Stack

- Laravel 11
- Inertia.js
- Vue 3
- MySQL 8
- Docker (Laravel + Node + MySQL)
- Vite

---

# ⚙️ Requisitos

- Docker
- Docker Compose
- Git

---

# 🚀 Como executar o projeto

## 1. Clonar o repositório

```bash
git clone https://github.com/Eriveltoon/ServiceHub.git
cd ServiceHub
```

## 2. Configuração do ambiente

Copie o arquivo de exemplo:

```bash
cp .env.example .env
```

## 3. Subir containers

Na pasta do projeto.
O ambiente já inclui Laravel, MySQL e Node (Vite).

```bash
docker compose up --build
```

## 4. Configurar aplicação

Aguardar os containers subirem completamente e executar:

```bash
docker exec -it servicehub-app php artisan key:generate
docker compose exec app php artisan migrate
```

## 5. Acessar aplicação

No navegador acesse a URL:docker compose exec app cat storage/logs/laravel.log

```bash
http://localhost:8000
```

## 6. Conferir o envio de e-mail após subir arquivo de texto

No terminal bash, dentro da pasta do projeto, rodar o comando

```bash
docker compose exec app grep -n "To:" storage/logs/laravel.log -A 20
```
