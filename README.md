# Sustenta Food

**Sustenta Food** é um sistema web de cardápio digital com gerenciamento de reservas de mesas para restaurantes, desenvolvido como Trabalho de Conclusão de Curso (TCC) em Análise e Desenvolvimento de Sistemas.

O objetivo é modernizar o atendimento em restaurantes, permitindo que clientes visualizem o cardápio, façam reservas online e que administradores gerenciem facilmente o cardápio, as reservas e configurações gerais do restaurante.  
O sistema consome nossa **SustentaFoodAPI**, uma API REST feita para facilitar todas as operações de nosso sistema.

Para mais informações sobre a **SustentaFoodAPI** e sua documentação, acesse `https://github.com/Willzin1/SustentaFoodAPI`.

---

## Visão Geral

- Visualização de cardápio digital
- Cadastro, edição e exclusão de pratos e bebidas
- Sistema de reservas com verificação de disponibilidade
- Autenticação de usuários (clientes e administradores)
- Painel administrativo para controle do restaurante
- Consumo de API externa para dados

---

## Como baixar e rodar o projeto

Para rodar o projeto, deveremos baixar nossa API também, siga as instruções para baixar a SustentaFoodAPI, acesse `https://github.com/Willzin1/SustentaFoodAPI`.

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/Willzin1/SustentaFood.git
   cd SustentaFood
   ```

2. **Instale as dependências do PHP/Laravel:**
   ```bash
   composer install
   ```

3. **Instale as dependências do front-end:**
   ```bash
   npm install
   npm run dev
   ```

4. **Configure o arquivo de ambiente:**
   ```bash
   copy .env.example .env
   ```
   Edite o arquivo `.env` com as informações da API e banco de dados.

5. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

7. **Inicie o servidor:**
   ```bash
   php artisan serve
   ```

---

## 🛠️ Tecnologias Utilizadas

- **Back-end:** PHP, Laravel, MySQL
- **Front-end:** HTML5, CSS3, JavaScript, Blade (Laravel)
- **Outros:** Git, Docker, Microsoft Azure

---

## Colaboradores

- [William (Willzin1)](https://github.com/Willzin1)

---

## Licença

Este projeto está licenciado sob a licença [MIT](LICENSE)
