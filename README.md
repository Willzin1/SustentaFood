# 🍽️ Sustenta Food

**Sustenta Food** é um sistema web de cardápio digital com funcionalidades de reservas de mesas para restaurantes, desenvolvido como **Trabalho de Conclusão de Curso (TCC)** do curso de Análise e Desenvolvimento de Sistemas.

Este projeto visa modernizar o atendimento em restaurantes e automatizar o gerenciamento de reservas, proporcionando aos clientes uma experiência interativa e aos administradores um painel de gestão simples e eficiente.

>  Projeto em desenvolvimento!

---

## Funcionalidades

- Visualização de cardápio digital
- Cadastro e gerenciamento de itens (pratos, bebidas, etc.)
- Sistema de reservas com verificação de disponibilidade
- Autenticação de usuários (clientes e administradores)
- Consumo de **API RESTful**
- Painel administrativo para controle do restaurante

---

##  Tecnologias Utilizadas

### Back-end
- ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
- ![Laravel](https://img.shields.io/badge/Laravel-E34F26?style=for-the-badge&logo=laravel&logoColor=white)
- ![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

### Front-end
- ![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
- ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
- ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
- ![Laravel](https://img.shields.io/badge/Laravel-E34F26?style=for-the-badge&logo=laravel&logoColor=white)

### Outros
- ![Git](https://img.shields.io/badge/Git-F05032?style=for-the-badge&logo=git&logoColor=white)
- ![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)
- ![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

---

## Estrutura do Projeto

```bash
├── app/                    # Código principal da aplicação (Controllers, Models, etc.)
├── routes/                 # Definição das rotas da API e da aplicação
├── database/               # Migrações, factories e seeds
├── resources/              # Views e outros arquivos de recursos
    └── views/              # Arquivos Blade
    └── JS/                 # Arquivos JS
    └── css/                # Arquivos CSS
├── public/                 # Arquivos públicos (CSS, JS, imagens)
├── .env.example            # Arquivo de configuração de ambiente
├── docker-compose.yml      # Arquivo de configuração do Docker
└── README.md               # Documentação do projeto
