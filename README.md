# 🎓 Alumni - Acompanhamento de Egressos

Projeto de acompanhamento de egressos (Alumni) desenvolvido para atender às novas exigências do **Inep 2026**, com foco fundamental na coleta de dados de empregabilidade e na trajetória profissional dos ex-alunos.

---

## 🎯 Objetivo
O Inep 2026 exige métricas claras sobre a inserção dos ex-alunos no mercado de trabalho. Este sistema visa automatizar e centralizar essa coleta.

**O que buscamos?**
*   Atualização contínua do perfil do egresso.
*   Coleta de informações cruciais, como o **CNPJ da empresa atual** e o **cargo** ocupado.

**Resultado Esperado:**
*   Geração de dados precisos para alimentar o gráfico de **'Porcentagem de Egressos Empregados'** no painel do administrador, facilitando a tomada de decisões e a comprovação junto ao MEC/Inep.

---

## 🎨 Paleta de Cores do Projeto

Esta paleta foi gerada analisando a identidade visual da instituição. Ela usa tons profissionais e limpos, ideais para um portal institucional:

*   🔵 **Azul Marinho Escuro (`#2E4E94`)**: Cor primária para textos principais, cabeçalhos, e elementos de destaque estáveis.
*   🟢 **Verde Floresta (`#0A8F4F`)**: Cor primária para ações secundárias, links ativos e elementos dinâmicos.
*   🍏 **Verde Médio (`#47A36F`)**: Cor secundária para acentos sutis e estados de *hover*.
*   🔴 **Vermelho de Destaque (`#E02C2C`)**: Cor de destaque para ações críticas (ex: excluir), erros e notificações urgentes.
*   ⚪ **Branco (`#FFFFFF`) e Cinza Claro (`#F0F2F5`, `#E0E2E6`)**: Cores de fundo e superfícies para garantir clareza e limpeza visual.
*   🔘 **Cinza de Texto (`#7A818C`)**: Cor para textos secundários e descritivos.

---

## 🛠️ Tecnologias Utilizadas

*   **Framework:** Laravel 11 (PHP 8.2)
*   **Front-end:** HTMX + Bootstrap 5 (CDN)
*   **Banco de Dados:** MySQL 8.0 (UTF-8 MB4 Unicode)
*   **Infraestrutura:** Docker & Docker Compose
*   **Relatórios:** Dompdf (Geração de PDFs)

---

## 🚀 Como executar o projeto (Primeira Vez)

O ambiente de desenvolvimento é totalmente containerizado. Siga os passos abaixo para iniciar a aplicação:

### 1. Pré-requisitos
Certifique-se de ter o **Docker** e o **Docker Compose** instalados na sua máquina.

### 2. Configuração do Ambiente
Clone o repositório e crie o arquivo de variáveis de ambiente:
```bash
cp .env.example .env```

### 3. Subir os Containers

Inicie os serviços do servidor web e do banco de dados em segundo plano:
```bash
docker-compose up -d
```

### 4. Instalação e Configuração Interna

Acesse o terminal do container da aplicação:
```bash
# Instalar dependências do PHP
docker compose exec web composer install

# Gerar a chave de criptografia da aplicação
docker compose exec web php artisan key:generate

# Garantir permissões de escrita nas pastas necessárias
docker compose exec web chown -R www-data:www-data storage bootstrap/cache
docker compose exec web chmod -R 775 storage bootstrap/cache

# Executar as migrações para criar as tabelas no banco de dados
docker compose exec web php artisan migrate
```

### 5. Acessar o Sistema

A aplicação estará rodando localmente na porta 80. Abra o navegador e acesse:
👉 http://localhost


### 📂 Estrutura do Projeto (Laravel)
├── app/
│   ├── Http/
│   │   └── Controllers/  # Lógica de controle das requisições
│   └── Models/           # Interação com o banco de dados (Eloquent)
├── bootstrap/            # Arquivos de inicialização do framework
├── config/               # Arquivos de configuração do sistema
├── database/
│   ├── migrations/       # Scripts de criação e alteração de tabelas
│   └── seeders/          # Alimentação inicial do banco de dados
├── public/               # Raiz do servidor web (index.php)
│   └── assets/
│       └── image/
│           └── logo/
│               ├── logo.png          # Logotipo Completo Univinte
│               └── logo-estrela.png  # Ícone isolado da Estrela
├── resources/
│   └── views/            # Templates (Blade) contendo o HTML/HTMX
├── routes/
│   └── web.php           # Definição de todas as rotas da aplicação
├── storage/              # Logs, cache e arquivos gerados (como os PDFs)
├── docker-compose.yml    # Orquestração dos containers
├── Dockerfile            # Imagem customizada do PHP/Apache
└── composer.json         # Dependências do projeto


