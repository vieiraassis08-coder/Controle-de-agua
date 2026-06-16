# 💧 Sistema de Controle de Consumo de Água

Avaliação prática — IFCE Campus Boa Viagem · ADS — Programação Web I · 2026.1

## 👥 Dupla

- [Nome 1]
- [Nome 2]

## 🛠 Tecnologias Usadas

- **PHP 8.x** + **Laravel 11**
- **MySQL** (banco de dados)
- **Blade** (templates)
- **Artisan** (migrations e models)

---

## ⚙️ Como Instalar e Rodar Localmente

### Pré-requisitos

- PHP >= 8.1
- Composer
- MySQL

### Passo a passo

```bash
# 1. Clonar o repositório
git clone https://github.com/SEU_USUARIO/SEU_REPOSITORIO.git
cd SEU_REPOSITORIO

# 2. Instalar dependências
composer install

# 3. Copiar e configurar o .env
cp .env.example .env
php artisan key:generate

# 4. Configurar banco de dados no .env
# DB_DATABASE=agua_db
# DB_USERNAME=root
# DB_PASSWORD=sua_senha

# 5. Criar o banco e executar as migrations
php artisan migrate

# 6. Rodar o servidor
php artisan serve
```

Acesse: **http://localhost:8000**

---

## 🗄 Configurando o .env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agua_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## 👤 Usuário/Senha Padrão

Este sistema não possui login/autenticação. Qualquer pessoa com acesso à URL pode usar o sistema.

---

## 📋 Funcionalidades

| Módulo | Descrição |
|--------|-----------|
| **Consumidores** | Cadastrar, listar e editar consumidores |
| **Leitura Mensal** | Registrar leitura atual; consumo calculado automaticamente |
| **Faturas** | Gerada automaticamente após cada leitura; gestor pode marcar como paga |
| **Configuração de Taxa** | Alterar taxa fixa e valor do excedente |
| **Bônus WhatsApp** | Botão que abre WhatsApp com mensagem pré-preenchida |

---

## 💰 Regra de Cobrança

| Consumo mensal | Cobrança |
|----------------|----------|
| Até 10.000 L (10 m³) | Taxa fixa padrão: R$ 25,00 (configurável) |
| Acima de 10.000 L | Taxa fixa + R$ 2,00 por cada 1.000 L excedentes |

**Exemplo:** consumo de 15.000 L → R$ 25,00 + R$ 10,00 (5.000 L × R$ 2,00) = **R$ 35,00**
