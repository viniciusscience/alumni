# 🎨 Documento de Design e Arquitetura - Portal Alumni

Este documento descreve as diretrizes de design de interface (UI), experiência do usuário (UX) e as decisões arquiteturais do Portal Alumni da Univinte, desenvolvido pela ForgeIT Systems.

---

## 🏛️ 1. Arquitetura Front-end (A Abordagem "HTML-First")

Para manter o projeto leve, seguro e fácil de manter, optamos por uma arquitetura sem frameworks JavaScript complexos (como React ou Vue) e sem processos de *build* (Node.js/Vite).

*   **Renderização:** *Server-Side Rendering* (SSR) clássico utilizando a *engine* Blade do Laravel.
*   **Reatividade:** Utilização de **HTMX**. As interações do usuário (filtros, paginação, submissão de formulários) disparam requisições AJAX que retornam fragmentos de HTML pré-renderizados pelo Laravel, substituindo apenas as partes necessárias do DOM (`hx-target`, `hx-swap`).
*   **Estilização:** **Bootstrap 5** via CDN, utilizando as classes utilitárias nativas para espaçamento, tipografia e grid responsivo.

---

## 🎨 2. Identidade Visual e Paleta de Cores

As cores foram extraídas da identidade visual da instituição, garantindo consistência e um tom profissional focado na usabilidade de sistemas de gestão.

| Cor | Hexadecimal | Uso Principal | Classe Bootstrap Mapeada |
| :--- | :--- | :--- | :--- |
| **Azul Marinho** | `#2E4E94` | Textos principais, cabeçalhos, navbar e links primários. | `.text-primary`, `.bg-primary` (Customizado) |
| **Verde Floresta** | `#0A8F4F` | Ações de sucesso, botões principais de "Salvar" ou "Adicionar". | `.text-success`, `.btn-success` |
| **Verde Médio** | `#47A36F` | Acentos, ícones secundários e estados de *hover*. | *(Uso via CSS customizado)* |
| **Vermelho** | `#E02C2C` | Ações destrutivas (excluir), alertas de erro e validações Inep. | `.text-danger`, `.btn-danger` |
| **Cinza de Texto** | `#7A818C` | Textos de apoio, descrições secundárias e *placeholders*. | `.text-muted`, `.text-secondary` |
| **Fundos** | `#F0F2F5` | Cor de fundo geral do sistema (`body`) para destacar os *cards* brancos. | `.bg-light` |

---

## 🧩 3. Padrões de Interface (UI)

O sistema deve transparecer limpeza e organização, facilitando o preenchimento dos dados obrigatórios de empregabilidade.

### 3.1. Layout Base
*   **Navegação:** Topbar horizontal escura (`bg-dark` ou `#2E4E94`) contendo a logo da ForgeIT Systems/Univinte e links rápidos.
*   **Conteúdo:** Envolvido em um contêiner central (`.container` do Bootstrap).
*   **Cards:** O conteúdo principal (tabelas de alunos, formulários) deve estar sempre contido em `.card.shadow-sm` com fundo branco, garantindo contraste contra o fundo cinza claro.

### 3.2. Formulários e Coleta de Dados (Inep 2026)
Como a meta principal é rastrear a empregabilidade, os formulários devem ser desenhados para reduzir a fricção:
*   Campos como **CNPJ da empresa** e **Cargo** devem ter validação em tempo real via HTMX (ex: disparar um `hx-post` ao perder o foco para checar se o CNPJ é válido).
*   Utilizar *tooltips* do Bootstrap para explicar ao egresso *por que* estamos pedindo aquelas informações (justificativa do Inep).

### 3.3. Painel do Administrador (Dashboard)
A tela inicial do administrador deve priorizar o consumo rápido de dados:
*   O gráfico de **"Porcentagem de Egressos Empregados"** deve ser o elemento central superior.
*   Utilizar *badges* (`.badge`) para sinalizar rapidamente o status do egresso (ex: <span class="badge bg-success">Empregado na Área</span> ou <span class="badge bg-secondary">Buscando Oportunidade</span>).

---

## 🗄️ 4. Padrões de Nomenclatura e Banco de Dados

Seguindo as convenções do Laravel e as definições do projeto:
*   **Tabelas:** Sempre em letras minúsculas e no plural. Exemplo: `alunos` (e não "Alunos"), `vagas`, `empresas`.
*   **Chaves Estrangeiras:** Padrão `tabela_id`. Ex: `empresa_id` na tabela de alunos.
*   **Collation:** O banco de dados MySQL está configurado com `utf8mb4_0900_ai_ci` para garantir precisão absoluta nas buscas e ordenações em língua portuguesa (ignorando acentos e maiúsculas/minúsculas de forma inteligente).

---

## 📄 5. Geração de Relatórios (PDF)

Os relatórios exigidos pelas coordenações e pelo MEC serão gerados utilizando a biblioteca `barryvdh/laravel-dompdf`.
*   **Design dos PDFs:** Devem compartilhar o mesmo CSS limpo (preferencialmente carregando um *stylesheet* simplificado do Bootstrap).
*   **Tipografia nos PDFs:** Utilizar fontes nativas (como Helvetica ou Arial) embutidas no DOMPDF para evitar problemas de renderização e garantir arquivos leves.