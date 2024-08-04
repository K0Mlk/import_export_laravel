# Laravel Import/Export Products


Этот проект демонстрирует импорт и экспорт продуктов с использованием Laravel.


## Установка

1. Клонируйте репозиторий:


2. Установите зависимости:

    composer install
    npm install

3. Настройте переменные окружения в файле .env:

4. Запустите контейнеры Docker:

    docker-compose up -d

5. Запустите миграции:

    docker-compose exec app php artisan migrate

## Использование

- Посетите `http://localhost:8080/import` для загрузки файла Excel и импорта продуктов.
- Посетите `http://localhost:8080/products` для просмотра списка продуктов.
- Кликните на продукт для просмотра его карточки.

