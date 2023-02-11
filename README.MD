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

# Definindo a primeira rota
Quando instalamos o Symfony usando o composer, podemos acessar seu console por meio do seguinte comando na raiz do projeto:
```
cd aplicacao
php .\bin\console
```
Esse console facilita a criação de objetos do Symfony e dos seus outros componentes (ORM Doctrine etc.).

Os controladores são usados como base para a criação automática de rotas.

Para criar um controller, use: 
```
php \.bin\console make:controller MeuController
```
Com este comando, a classe PHP de Controller e o template (arquivo .html.twig) são criados.

O arquivo de Controller possui uma annotation chamado Route. As annotations do PHP são de dois tipos: as de comentários e as de attributes:

```php
// BEFORE: annotations defined with Doctrine Annotations library
use Symfony\Component\Routing\Annotation\Route;

class SomeController
{
    /**
     * @Route("/path", name="action")
     */
    public function someAction()
    {
        // ...
    }
}
// AFTER: annotations defined with PHP 8 attributes
use Symfony\Component\Routing\Annotation\Route;

class SomeController
{
    #[Route('/path', name: 'action')]
    public function someAction()
    {
        // ...
    }
}
```

Por padrão o modo de debug fica ligado (ideal para a fase de desenvolvimento). Para desligar o modo de debug do Symfony, edite o arquivo `.env` incluindo a seguinte linha:
```
APP_DEBUG=0
```
# Lidando com Request e Response
O parâmetro name dentro da annotation `Route` **NÃO** é obrigatório.

As classes de requisição `Request` e resposta `Response` do Symfony estão no namespace `Symfony\Component\HttpFoundation`.

O Symfony dispõe de uma função que combina os comandos `var_dump` e `die`: é a função `dd($variavel)`. Boa para comparar os valores das variáveis durante o debug.

As respostas `Response` no Symfony recebem 3 parâmetros no seu construtor:
1. O conteúdo;
2. O código de status HTTP; e
3. Um dicionário (key/value) com cabeçalhos HTTP.

# Para saber mais: método get
Dentro da requisição `Request` temos o método `get`. Ele busca valores tanto da query string (método `GET`) quanto do payload (método `POST`). **Porém** o recomendado é ser explicíto sobre de onde vem a variável que estamos procurando: 
```PHP
<?php...

use Symfony\Component\HttpFoundation\Request;

...

#[Route('/ola_mundo')]
public function index(Request $request): Response
{
    // $_GET parameters
    $request->query->get('name');

    // $_POST parameters
    $request->request->get('name');
}
```
# Parâmetros de Route
| Nome do parâmetro | Função |
|---|---|
| `path` | URI (caminho) para a função que vai retornar a resposta. |
| `name` | Nome pelo qual os templates localizam a URI da rota. |
| `methods` | Array de métodos HTTP permitidos na rota. |

O controller `OlaMundoController` será excluído.

Há vários subtipos de `Response` no Symfony. No exemplo, usaremos o `JsonResponse`, cujo cabeçalho `Content-Type` já é definido para `application/json`.

# Conhecendo o Twig
A sintaxe do Twig é **MUITO** semelhante à do Jinja2 e à do Django template engine.

O método `$this->render` também é muito semelhante aos métodos de renderização do Django e do Flask: um parâmetro para informar o arquivo de template, e outro para informar o array/dicionário com o contexto da resposta:
```PHP
class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {
        $lista =  [
            'Item 1',
            'Item 2',
            'Item 3',
        ];
        return $this->render('home/index.html.twig', [
            'lista' => $lista,
        ]);
    }
}
```
Renderização em `index.html.twig`:
```HTML 
<h1>Minha lista</h1>
<ul>
    {% for item in lista %}
        <li>{{ item }}</li>
    {% endfor %}
</ul>
```
# Entendendo o layout
Novamente as semelhanças do Twig com o Jinja2 e o Django template engine: os blocos de código extensíveis.

Página base.html.twig:
```HTML
<!DOCTYPE html>
<html>
    <head>
        <title>{% block title %}Título Padrão!{% endblock %}</title>
    </head>
    <body>
        {% block body %}{% endblock %}
    </body>
</html>
```

Página index.html.twig: 
```HTML
{% extends 'base.html.twig' %}

{% block title %}Minha página Index{% endblock %}

{% block body %}
    <h1>Conteúdo da página Index.</h1>
{% endblock %}
```

As páginas-filha usam a diretiva `extends`. Os blocos de código são declarados nas páginas-pai e substituídos nas páginas-filha por meio da diretiva  `block`. 

As diretivas são declaradas dentro dos caracteres `{%` e `%}`.