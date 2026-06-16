# Comandos para montar o projeto do zero

## 1. Criar projeto Laravel
```bash
composer create-project laravel/laravel agua-controle
cd agua-controle
```

## 2. Criar Models + Migrations + Controllers de uma vez
```bash
php artisan make:model Consumidor -mcr
php artisan make:model Leitura -mc
php artisan make:model Fatura -mc
php artisan make:model ConfiguracaoTaxa -mc
```

## 3. Executar migrations
```bash
php artisan migrate
```

## 4. Commits sugeridos (Conventional Commits)
```
migration: create_consumidores_table
migration: create_leituras_table
migration: create_faturas_table
migration: create_configuracoes_taxa_table
feat: cadastro de consumidores
feat: registro de leitura e cálculo de consumo
feat: geração de fatura com valor calculado
feat: configuração de taxa pelo gestor
feat: link WhatsApp para notificação de fatura
fix: validação de leitura menor que anterior
docs: atualiza README com instruções de uso
```

## 5. Rodar servidor
```bash
php artisan serve
```
