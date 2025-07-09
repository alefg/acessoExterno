<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Sistema de Gerenciamento de Solicitações de Cadastro de Usuários - SEI

## 📌 Visão Geral

Este sistema visa gerenciar solicitações de cadastro de usuários externos ao SEI (Sistema Eletrônico de Informações) do Governo do Estado de Minas Gerais. Permite o envio de formulários por cidadãos, análise por responsáveis setoriais e administração global pelo superadministrador.

---

## 🛠 Tecnologias Utilizadas

- **Backend:** Laravel 12
- **Frontend:** Blade + Bootstrap
- **Componentes:** Laravel Breeze, Laravel UI, Livewire
- **Banco de Dados:** MySQL
- **Armazenamento de Arquivos:** Local (filesystem Laravel)

---

## 👥 Perfis de Usuário

| Perfil              | Acesso e Permissões                                                                 |
|---------------------|--------------------------------------------------------------------------------------|
| Solicitante         | Acesso público. Preenche formulário e envia documentos                              |
| Responsável de Área | Login com e-mail/senha. Visualiza e executa cadastros apenas de sua área            |
| Superadmin          | Acesso total ao sistema. Visualiza, cadastra áreas, órgãos e usuários               |

---

## 📋 Funcionalidades Principais

### Formulário Público

- Nome completo
- Tipo de representação: Pessoa Física ou Jurídica
- E-mail pessoal
- E-mail do SEI (mesmo ou não)
- Upload de documentos obrigatórios:
  - Termo assinado
  - Documento com CPF
  - Selfie com documento
  - Documentação complementar para PJ

### Tipos de Preenchimento do Termo

- Manual (escaneado)
- Digital com Adobe Reader
- Com Certificado Digital ICP-Brasil

### Aceite de Termos

- Aceite obrigatório conforme legislação vigente

---

## 🔄 Fluxo de Solicitação

1. **Pendente**
2. **Em análise**
3. **Aprovado**
4. **Concluído**

---

## 🏢 Multiorganização

- Cadastro de múltiplos órgãos
- Cada órgão com suas áreas e responsáveis
- Isolamento completo de dados por órgão

---

## 📧 Notificações

- Envio automático de e-mail ao responsável da área ao receber nova solicitação
  - Assunto: “Nova solicitação de cadastro de usuários”
  - Conteúdo: Nome do solicitante e link direto para a análise

---

## 📊 Relatórios e Exportações

- Exportação de dados em CSV:
  - Por data
  - Por área
  - Por status
- Exportação em lote de documentos

---

## 🕵️ Auditoria

- Registro do tempo entre submissão e conclusão
- Histórico completo de movimentações de status

---

## ✅ Requisitos Não Funcionais

| Requisito     | Descrição                                                             |
|---------------|----------------------------------------------------------------------|
| Usabilidade   | Interface responsiva, compatível com dispositivos móveis             |
| Manutenção    | Código limpo e estruturado em arquitetura MVC                        |
| Desempenho    | Tempo de resposta inferior a 2 segundos em interações usuais         |
| Armazenamento | Arquivos locais com limite de 2MB por arquivo                        |
| Privacidade   | Dados acessíveis apenas ao responsável da área e superadmin          |

---

## 📅 Versão e Responsável

- **Versão:** 1.0  
- **Data:** 08/07/2025  
- **Responsável:** Alef – Líder de Projeto e Análise de Requisitos

---