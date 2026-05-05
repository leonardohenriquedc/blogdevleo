---
title: Construindo pelo primeiro blog 3 vezes
author: Leonardo Henrique
date: 2026-04-27
---

# Início

No meu primeiro ano como programador, eu já tinha construído alguns projetos, como uma pequena API para um sistema de delivery e um backend para um e-commerce, foi então que conheci o canal do Fábio Akita e, com ele, o seu blog, isso me motivou a entrar na “saga” de tentar construir o meu próprio blog. Eu não sabia exatamente sobre o que escrever — e, sendo sincero, até hoje ainda não sei —, mas mesmo assim resolvi criar.

A única linguagem que eu dominava relativamente bem era Java e o único padrão que eu conhecia era o próprio padrão arquitetural comum do ecossistema Java, então, para construir um simples blog, comecei — obviamente — pelo lugar menos intuitivo: o login, por que um blog precisaria de login eu não sabia, mas já que estava nisso, por que não construir também um banco de dados para armazenar os posts em vez de usar arquivos. Depois de todo esse processo de planejamento (e complicação desnecessária), finalmente comecei a trabalhar no login, e aqui vai um detalhe importante: eu estava usando OAuth2 sem nem saber exatamente o que era ou como configurar corretamente, como acontece com muitos projetos que sofrem de **overengineering**, acabei desistindo no meio do caminho.

---

# Resolvendo pensar antes de fazer

Após algum tempo — pouco mais de três meses — comecei a aprender a linguagem de programação Rust e resolvi tentar novamente construir um blog, dessa vez com mais planejamento, a ideia agora era usar uma stack voltada para WASM (WebAssembly), um formato binário capaz de rodar na web, algo que realmente me chamou atenção, afinal, quanto mais longe do JavaScript melhor (na minha visão da época). Decidi usar a stack Yew com Axum e, dessa vez, nada de complexidade desnecessária: sem banco de dados, sem sistema de login, os posts seriam salvos em arquivos `.md`, convertidos para HTML e renderizados no servidor usando SSR com Yew.

Na época, a parte mais difícil foi fazer os caminhos chegarem corretamente aos arquivos, depois disso tudo ficou mais tranquilo, existem milhares de bibliotecas que fazem boa parte do trabalho, como `pulldown-cmark` e `askama`, usadas para converter o conteúdo Markdown em HTML, e então pronto, o blog estava construído. Mas surgiu um novo problema: como criar novos posts, a solução foi simples, criei um script em Bash que gera um template base para cada novo post, incluindo os metadados do Front Matter, como nome do autor, data, tags e título, a partir daí era só escrever o conteúdo.

---

# Transformando o blog em um projeto de currículo real

Depois de um tempo usando Rust, resolvi aprender a tão criticada linguagem de programação PHP — o famoso “quick and dirty”, como dizia Fábio Akita — e nesse ponto fica claro como a opinião dos outros pode influenciar nossas decisões e até nos impedir de conhecer algo novo, meu preconceito com PHP era tão grande que eu nem sequer queria ler código nessa linguagem, simplesmente porque muita gente dizia que era insegura, bagunçada e mal projetada.

Mas, depois de tanto ouvir opiniões negativas, resolvi dar uma chance e conhecer por conta própria, e percebi que muitas dessas críticas vinham de pessoas presas a versões extremamente antigas da linguagem, é como falar mal de um carro da Peugeot tendo dirigido apenas um Peugeot 206 a vida inteira. Comecei a estudar PHP e percebi que poderia fazer de forma muito mais simples o que eu estava tentando fazer em Rust, até porque Rust não foi projetado nativamente para esse tipo de aplicação, então resolvi refazer o blog pela terceira vez, mas agora com o objetivo de transformá-lo em um projeto de portfólio.

Comecei entendendo como funciona o I/O de arquivos na linguagem, depois aprofundei meus conhecimentos sobre como o PHP atua como servidor e como renderiza HTML para envio ao cliente e, por fim, estudei roteamento e integração com banco de dados, com isso já conseguia construir algo básico em PHP puro, e foi exatamente o que fiz. Posteriormente, adicionei suporte a sessões, cookies e middlewares, incluindo proteções contra ataques comuns no mundo da TI, como CSRF, session hijacking e SQL injection, além de implementar idempotência, que não é um ataque, mas sim uma proteção importante contra requisições repetidas, como o famoso “F5 nervoso”.

Depois de tudo isso, o projeto está no ar, rodando sob um domínio e evoluindo constantemente, tanto do ponto de vista técnico quanto visual.
