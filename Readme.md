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

Caso passe o parâmetro -m (migration) já é criado a migration da model

~~~
php artisan make:model NOMEDAMODEL -m
~~~

Caso seja necessário recriar as tabelas com com seus relacionamentos use o comando (apaga e recria ntodas a s tabelas)

~~~
php artisan migrate:fresh
~~~

Este é um pacote para integrar PHP Debug Bar com Laravel. Ele inclui um ServiceProvider para registrar a barra de depuração e anexá-la à saída.

~~~
composer require barryvdh/laravel-debugbar --dev
~~~

O service container que vai analisar o que precisamos e entregar. Ele cria para nós e injeta, seja no construtor ou em cada uma das ações ao longo do código. Ele que cria o request, qualquer dependência, etc. O service container que permite a injeção de dependência, contudo, além disso, no Laravel temos o service providers.

~~~
php artisan make:provider SeriesRepositoryProvider
~~~

- Criando Atenticação com middleware

~~~
php artisan make:middleware [NomeDoMiddleware]
~~~

- Criando Envio de e-mail

~~~
php artisan make:mail SeriesCreated
~~~

- Se no projeto olharmos as migrations em "database > migrations", por padrão, o Laravel já nos trouxe uma tabela de failed jobs, podemos analisar depois, mas, repare que não criou a tabela de jobs, assim, vamos executar no terminal o comando queue:table.

~~~
php artisan queue:table
~~~

- Então, se no terminal rodarmos php artisan temos duas formas: 
    - uma delas é o *`queue:listen`* 
    - e a outra o *` queue:work`*
    
ambas são semelhantes, mas, por regra, em produção, utilizamos o **queue:work**, que pega todo o código Laravel e insere em memória, inicia a aplicação uma única vez e fica ouvindo todas as tarefas que vão entrando na fila, ou seja, se em algum momento for alterado o código e gerar uma tarefa esse work que vai estar rodando, não pega o código atualizado, então, em tempo de desenvolvimento é comum usar o listen.

Em desenvolvimento usamos o **queue:listen** visto que sempre que chega uma nova tarefa o Laravel é inicializado e o **queue:work** é usado em produção por ser mais rápido, ele inicializa o Laravel uma vez só. Por estarmos habituado vou usar sempre o work.

No terminal vamos rodar o php artisan **queue:work** e, com isso, vai começar a processar os jobs, está enviando e falhou no sexto, o motivo já sabemos, o mailtrap tem o limite de cinco e-mails a cada dez segundos.


~~~
php artisan queue:work 
~~~

No terminal vamos rodar o **`php artisan queue:listen --tries=2`** para não precisar ter que ficar encerrando o worker e subindo novamente. 

Rode o comando **`php artisan make:listener EmailUsersAboutSeriesCreated`**, o EmailUsersAboutSeriesCreated é o nome da classe que vamos criar que vai ser o ouvinte de evento, isto é, vai receber o evento e executar alguma coisa.

~~~
php artisan make:listener [nomedolistener]
~~~

- Criando um evento

~~~
php artisan make:event [nomedoEvento]
~~~

Vamos utilizar um service provider que o próprio Laravel possui por padrão em *`"app > Providers > EventServiceProvider"`*, o *`EventServiceProvider`* contém uma propriedade chamada listen, o mapeamento de eventos para os seus listeners, então, repare que o pacote de autenticação que adicionamos já possui um evento listener, quando um usuário é registrado, *Registered::class =>*, ele envia um e-mail de notificação: *SendEmailVerificationNotification::class,*.

```
protected $listen = [
    Registered::class => [
        SendEmailVerificationNotification::class,
    ],
    SeriesCreatedEvent::class => [
        EmailUsersAboutSeriesCreated::class,
    ],
];
```

Quando adicionado no *`listen`* o mapeamento de *`SeriesCreatedEvent`* que é o evento, importado do namespace correto que vai possuir apenas um listener, por enquanto, o *`EmailUsersAboutSeriesCreated`*. Com isso, o Laravel vai saber que sempre que a série for criada, o _listener_ *`EmailUsersAboutSeriesCreated`* vai ser executado.

Vamos criar um novo listener, rode o comando

```
php artisan make:listener LogSeriesCreated -e SeriesCreatedEvent
```

php artisan make:listener LogSeriesCreated, vai realizar o log de uma série criada e podemos passar um parâmetro -e informando qual evento esse listener vai ouvir, no caso SeriesCreated.

- Criando link simbolico para imagem

```
php artisan storage:link
```

- Criando testes

```
php artisan make:test SeriesRepositoryTest
```

- Construindo api

As rotas de api são definadas em *`routes/api.php`* não é necessário atribuir o *`api/..`* o lravel já entende que as rotas desse arquivo já fazem parte da api e com iso atribui o api a rota

    - exemplo
    http://localhost:8000/api/rota

fica assim em 

*`routes/api.php`* 

Route::get('/rota',[Controller::class, 'index']);

- Atenticação


A autenticação é para identificar um usuário, autorização é para permitir que usuário, conhecido ou não, faça alguma tarefa. Por exemplo, eu só quero permitir que removam séries usuários administradores ou algo assim.

Se ele for administrador, eu posso adicionar uma habilidade a mais nesse token, nós temos um array de abilities. Eu posso informar, por exemplo, que esse usuário, ele pode 
*`$token = $user->createToken(name: 'token', ['series:delete'])`*
Eu posso dar qualquer nome aqui, pode ser ['pode_remover_series'], mas é um bom padrão termos um recurso que será manipulado, dois pontos e a operação.

Se eu perguntar se esse usuário pode fazer qualquer coisa, ele vai poder, isso tudo será verdadeiro, porque quando geramos o token inicial, nós não passamos abilities, então ele pode fazer qualquer coisa. Aí é que está, nós, por padrão, temos essa hability, ['*'], essa habilidade, essa permissão, que é fazer tudo.

Na area em questão , exemplo método *`destroy`* podemos utilizar authenticable, *`(int $series, Authenticable $user)`* quer dizer alguém que seja autenticável.

Então eu posso verificar se o token desse usuário pode fazer algo, *`dd($user->tokenCan())`*. 
Por exemplo, *`(ability: 'series:delete')`*. 

Não é comum fazer logout numa API, porque não estamos armazenando sessão. Mas, sempre que eu fizer um login, eu posso fazer logout desse mesmo usuário, ou seja, eu posso revogar qualquer outro token que ele tenha. Eu posso fazer *`$user->tokens()->delete()`*. Ou seja, eu vou acabar removendo todos os tokens que esse usuário tenha.

Em APIs nós não utilizamos o conceito de sessão no servidor, porém um cliente pode armazenar o token e manter o usuário logado. Se o usuário fizer login de novo, é feita a revogação de todos os tokens, ou seja, todas as aplicações onde o usuário estava logado antes serão deslogadas. Isso permite uma segurança a mais, mas é uma implementação opcional.