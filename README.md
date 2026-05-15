# Alumni
Projeto de acompanhamento de egressos (Alumni) que atenda às novas exigências do Inep 2026, é fundamental focar na coleta de dados de empregabilidade e na trajetória profissional

# Objetivo
O Inep 2026 agora exige que saibamos se nossos ex-alunos estão trabalhando na área.

# O que buscamos?
Atualização de perfil que peça o CNPJ da empresa atual e o cargo.

# Resultado
Precisamos que esses dados gerem um gráfico de 'Porcentagem de Egressos Empregados' no painel do administrador.


# Paleta de Cores do Projeto

Esta paleta foi gerada analisando a logo fornecida. Ela usa tons profissionais e limpos, ideais para um portal institucional.

    Azul Marinho Escuro (#2E4E94): Cor primária para textos principais, cabeçalhos, e elementos de destaque estáveis.

    Verde Floresta (#0A8F4F): Cor primária para ações secundárias, links ativos e elementos dinâmicos.

    Verde Médio (#47A36F): Cor secundária para acentos sutis e estados de hover.

    Vermelho de Destaque (#E02C2C): Cor de destaque para ações críticas (ex: excluir), erros e notificações urgentes.

    Branco (#FFFFFF) e Cinza Claro (#F0F2F5, #E0E2E6): Cores de fundo e superfícies para garantir clareza e limpeza visual.

    Cinza de Texto (#7A818C): Cor para textos secundários e descritivos.

Instalar dependências:

    composer install

Configurar Banco de Dados:

        Crie um banco de dados no MySQL chamado portal_egresso.

        Renomeie o arquivo .env.example para .env e insira suas credenciais.

        Execute as migrations:
        Bash

        php vendor/bin/phinx migrate

    Servidor Local:
    Bash

    php -S localhost:80 -t public

📂 Estrutura do Projeto

├── app/
│   ├── Controllers/    # Lógica de controle das requisições
│   ├── Models/         # Interação com o banco de dados
│   ├── Views/          # Templates HTML/HTMX
│   └── Core/           # Classes base e roteamento
├── config/             # Arquivos de configuração
├── database/           # Migrations e Seeds
├── public/
│	└─ assets/
│        └── imagem/
│              └── logo/
└── composer.json       # Dependências do projeto

⚖️ Licença

Este projeto é de uso institucional da Univinte. Todos os direitos reservados.

Desenvolvido seguindo princípios de Clean Code e SOLID.
