## Описание проблемы

На предприятие приходят заявки на подоконники различных длин.
На складе у предприятия изначально находятся подоконники фиксированной длины, но по мере выполнения заказов к ним добавляются остатки от предыдущих резок.
Помимо этой проблемы резчик может неоптимально выбирать исходные материалы для следующего заказа, что приведет к увеличению отходов.

Математическое описание проблемы: http://en.wikipedia.org/wiki/Bin_packing_problem

## Решение

Необходимо создать инструмент, который:
	* позволит заполнить базу остатков, в дальнейшем автоматически её пересчитывать и экспортировать данные в xlsx;
	* позволит импортировать заказы из xlsx файла в заданном формате
	* будет рассчитывать оптимальные задачи для резки с учетом параметров "Минимальная допустимая длина подоконника" и "Максимально допустимая длина отходов"

## Установка

```
$ git clone https://github.com/andreyzhylin/ef-sill.git
$ cd ef-sill
$ composer update
Создать пустую базу данных и прописать настройки в конфигурационный файл или файл окружения .env
$ php artisan migrate
$ php artisan serve
```
