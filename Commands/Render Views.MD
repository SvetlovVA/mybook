А чтобы быть ближе к Symfony и как можно проще интегрировать Webpack в наше приложение, установим Webpack
Encore:

$ **symfony composer req encore**

В файле **package.json** есть несколько полезных команд, которые мы будем использовать на протяжении всей книги.


Установите загрузчик Saas:

$ **yarn add node-sass "sass-loader@^8.0.0" --dev**

Эффективное использование Bootstrap В создании адаптивного сайта, особенно в самом начале разработки,
такой CSS-фреймворк как Bootstrap, может значительно помочь. Установите его как пакет:

$ **yarn add bootstrap jquery popper.js bs-custom-file-input --dev**

У форм в Symfony есть встроенная поддержка Bootstrap со специальной темой, включите её:

    config/packages/twig.yaml

    twig:

        form_themes: ['bootstrap_4_layout.html.twig']


**Сборка ресурсов**

Собрать ресурсы в процессе разработки можно с помощью команды encore dev :

$ **symfony run yarn encore dev**

Чтобы не выполнять эту команду каждый раз после внесения изменений, 
запустите её в фоновом режиме и оставьте наблюдать за изменениями JS и CSS:

$ **symfony run -d yarn encore dev --watch**




