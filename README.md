<p align="center">
  <img 
    src="https://github.com/librecodecoop/telegram/raw/master/public/image/telegram.png" 
    height="150px" 
    alt="Telegram"
  >
</p>

# Telegram ~ Gerenciador de Grupos e Canais
Siga este passo-a-passo para iniciar o bot.

## Criação do Bot
Vá até o [BotFather](https://t.me/BotFather) e use os menus dele para criar um bot.
Na tela do chat utilize o comando `/newbot` e informe o id e o nome do seu bot.
Você pode configurar uma imagem e outros recursos de apresentação também.
Quando o bot estiver criado você receberá uma mensagem como esta:

> Done! Congratulations on your new bot. You will find it at `https://t.me/<id>`.
You can now add a description, about section and profile picture for your bot, see /help for a list of commands.
By the way, when you've finished creating your cool bot, ping our Bot Support if you want a better username for it. 
Just make sure the bot is fully operational before you do this.
>
> Use this token to access the HTTP API:
>
> 518711564:AAHdIiBaUaLo3OAi3r8LKpxjqRi-eyKOE7k
>
> For a description of the Bot API, see this page: https://core.telegram.org/bots/api

## Configuração do Projeto
Faça um clone deste projeto e execute os seguintes comandos
```bash
$ cp .env.sample .env
$ cp docker-composer.yml.sample docker-compose.yml
```

Em seguida, abra o `.env` com seu editor favorito e informe o **token** que foi gerado na criação do bot.
```ini
APP_TOKEN="<TOKEN>"
APP_DEBUG=1
```

Abra também o `docker-compose.yml` e modifique as ocorrências de `<PROJECT>` com o nome do seu projeto

## Rodando o Projeto
Instale as dependências e execute e inicialize o servidor.
```
$ docker-compose up -d
$ docker-compose exec <PROJECT>-app composer install
```
Navegue até [localhost:8000](http://localhost:8000) apenas para testar se está rodando.

## Ativando o Webhook
Para interagir com o bot você precisa configurar a URL do seu projeto.
Para isso tanto você precisar executar a URL a seguir com as configurações do seu projeto.
```
https://api.telegram.org/bot<TOKEN>/setWebhook?url=<URL>
```
Para preencher a `<URL>` é preciso ter uma URL externa válida; localhost não vale.
Você pode usar o [ngrok](https://ngrok.com) para ter uma URL externa válida.

O comando `ngrok http 8000` geraria uma URL semelhante a `https://3c1be5e0.ngrok.io`.

## Hora da Festa
Agora com tudo configurado você pode chamar seu bot para conversar.
