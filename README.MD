# Instalando o Symfony
O Symfony precisa de algumas extensões no PHP para funcionar. Por padrão, o Symfony já oferece implementações que substituem essas extensões, **mas a perfomance da aplicação cai**.

Rode o comando abaixo para criar o projeto:
```
composer create-project symfony/skeleton:"6.1.*" controle_series_symfony
```

É necessário instalar o componente webapp, para que os componentes necessários para aplicações web funcionem. Para isso, rode **dentro da pasta do projeto** para que o composer.json seja atualizado:
```
cd aplicacao
composer require webapp
```

Para rodar o código usando servidor PHP built-in:
```
php -S 0.0.0.0:8080 -t public
```
Repare: o parâmetro `-S` está em maiúsculo e indica o host + a porta onde o servidor web PHP vai escutar as requisições. O parâmetro `-t` se refere ao document root, à pasta de onde o servidor vai iniciar a aplicação (no caso, a pasta public).
