# Kracht PHP

Projeto final desenvolvido nas aulas de Programação Web com PHP.

---

## 📌 Repositórios

* **Projeto principal:** [https://github.com/fortesvitoria/kracht-php](https://github.com/fortesvitoria/kracht-php)
* **Projeto base e referência:** [https://github.com/fortesvitoria/kracht](https://github.com/fortesvitoria/kracht)

> **Obs.:** O arquivo do banco de dados (`db_kracht`) está disponível na pasta **/db**.
>
> **Obs.2:** O projeto é totalmente responsivo para telas **mobile** e **desktop**.

---

## 🔄 Atualizações do Projeto

### 📁 `view/index.php`

* HTML e CSS finalizados.
* Botão **Entrar** direciona para login ou cadastro.
* Exibe lista de bicicletas cadastradas no banco no *carousel* (somente itens do tipo "bicicleta").
* Exibe lista de roupas e acessórios cadastrados no banco no *carousel* (todos os tipos que **não** forem "bicicleta").

---

### 📁 `view/paginas/login_usuario.php`

* HTML e CSS finalizados.
* Valida credenciais no banco de dados.
* Redirecionamentos:

  * Se **admin**, direciona para a página de administrador.

    * Admin padrão:

      * **Email:** [vitoria@gmail.com](mailto:vitoria@gmail.com)
      * **Senha:** 1234
  * Se **usuário comum**, direciona para a página do usuário.

    * Usuário comum padrão:

      * **Email:** [eduardo@gmail.com](mailto:eduardo@gmail.com)
      * **Senha:** 1234

---

### 📁 `view/paginas/admin.php`

* HTML e CSS completos.
* Funcionalidades do administrador:

  * Alterar seus próprios dados.
  * Deletar e alterar dados de usuários comuns.
  * Deletar ou alterar produtos cadastrados.
  * Cadastrar novos produtos.

---

### 📁 `view/paginas/usuario.php`

* HTML e CSS completos.
* Funcionalidades do usuário:

  * Alterar seus dados pessoais.
  * Excluir sua própria conta.

---

### 📁 `view/paginas/login_cadastro.php`

* HTML e CSS completos.
* Realiza cadastro de novos usuários no banco.
* Todo usuário é registrado como: `is_admin = 0` (usuário comum).
* Apenas um administrador existe no sistema.

---

## ✔️ Status Atual

O projeto está funcional, responsivo e com todas as páginas principais implementadas, incluindo fluxo de login, controle de sessão, cadastro, administração e exibição de produtos.

---
