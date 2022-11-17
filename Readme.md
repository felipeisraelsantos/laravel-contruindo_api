# Laravel: Craindo Uma Aplicação MVC

- Criando um projeto

        composer create-project laravel/laravel teste ^9

    - Executar o projeto
        ~~~php
        artisan serve
        ~~~ 
    - Lista os comandos
        ~~~php
        php artisan
        ~~~
    - Cria o servidor web  
        ~~~php
        php artisan make:controller [NOME]Controller
        ~~~

        Documentação de como criar as action's [Resource Controllers](https://laravel.com/docs/9.x/controllers#actions-handled-by-resource-controller)

        Laravel atribui as rotas típicas de criação, leitura, atualização e exclusão ("CRUD") a um controlador com uma única linha de código, 

        executando o comando
        
        ~~~php
        php artisan make:controller [NOME]Controller --resource
        ~~~

    - Sobre Request

    O objeto de **Request** do Laravel nos fornece várias formas de atingir o mesmo objetivo.

    Por exemplo, para buscar um dado da query string, eu utilizei o método **`get`** no vídeo. Porém nós também podemos utilizar o método **`query`** que vai gerar exatamente o mesmo resultado.

    A diferença entre o método **`get`** e o método **`query`** é que o método **`get`** busca o dado de qualquer lugar do nosso request, seja da query string ou mesmo de um campo enviado por post. Por isso o ideal é utilizar o método **`query`** para que nosso código fique mais explícito, deixando claro de onde vamos buscar o dado.

    - Sobre Componentes

    Nós temos 2 tipos de componentes. Os componentes baseados em classes e os componentes anônimos. Componentes anônimos são os que possuem apenas um arquivo de view, como o nosso caso do layout. Não é necessário criar uma classe para isso. Já os componentes baseados em classes possuem uma classe que pode manipular livremente os dados deste componente.

    Vimos neste vídeo como criar um componente baseado em classe com o comando **`make:component`**. Se quisermos criar um componente anônimo, como nosso layout, poderíamos executar **`php artisan make:component layout –view`**. Como não há classe, podemos deixar o nome em minúsculo mesmo.

    Caso a gente queira separar nosso componentes em pastas, como **`forms/input.blade.php`**, por exemplo, podemos sem problemas. Na hora de utilizá-lo, vamos referenciá-lo como **`<x-forms.input>`**, usando o **`.`** como separador. Assim podemos manter nossos componentes organizados.

    Há muito mais para aprender sobre componentes e caso você queira se aprofundar, pode conferir este link:

    - [Components](https://laravel.com/docs/9.x/blade#components)

    - O que é [XSS](https://laravel.com/docs/9.x/blade#components) 

- Instalando node
~~~sh
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash - &&\
sudo apt-get install -y nodejs
~~~

- Instalando Mix

    - Para instalar o Laravel mix, execute:
~~~sh
npm install laravel-mix --save-dev
~~~

O Laravel Mix , um pacote desenvolvido pelo criador do Laracasts , Jeffrey Way, fornece uma API fluente para definir as etapas de construção do webpack para seu aplicativo Laravel usando vários pré-processadores CSS e JavaScript comuns.

Em outras palavras, o Mix torna fácil compilar e minificar os arquivos CSS e JavaScript do seu aplicativo. Por meio do encadeamento de métodos simples, você pode definir com fluência seu pipeline de ativos. Por exemplo:

~~~
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css');
~~~

- Depois crie na raiz do projeto o arquivo **`webpack.mix.js`** com o seguinte conteúdo:

~~~javascript
const mix = require('laravel-mix');
~~~

Agora nesse arquivo você pode definir todas as configurações da mesma forma que eu fizer nos vídeos. Além disso, para executar corretamente o comando **`npm run dev`** e o **`mix`** ser executado, altere a linha **`"dev": "vite"`**, para **`"dev": "mix"`**, no arquivo **`package.json`**.

Isso deve ser o suficiente para você seguir usando o Mix como ferramenta para o front-end.

- Instalando o bootstrap

~~~
npm install bootstrap
~~~

depois rode

~~~
npm run dev
~~~

- Sobre migrations

Com o comando

~~~
php artisan make:migration  create_NOMETABELA_table

~~~

Para rodar as Migrations

~~~
php artisan migrate
~~~

O Laravel possui uma proteção contra um ataque chamado Cross-Site Request Forgery (CSRF). Todo formulário que nós enviamos para o Laravel precisa ter uma informação extra: um token. Esse token permite que o Laravel verifique que a requisição realmente foi enviada por um formulário do site.

Felizmente essa informação é simples de se adicionar, bastando usar a diretiva @csrf do blade.


- Models

Para criar uma model use o comando

~~~
php artisan make:model NOMEDAMODEL
~~~