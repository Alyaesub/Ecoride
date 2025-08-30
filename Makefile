SASS_FOLDER := public/styles/sass
CSS_FOLDER := public/styles/css
APP_CONTAINER := ecoride_app
DATABASE_CONTAINER := ecoride_database

.PHONY: install
install:
	npm install && composer install

# Compile les fichiers Sass dans le dossier CSS
.PHONY: sass-compile
sass-compile:
    npx sass $(SASS_FOLDER):$(CSS_FOLDER)

# Compile les fichiers Sass dans le dossier CSS et recompile si les fichiers Sass changent
.PHONY: sass-watch
sass-watch:
    npx sass $(SASS_FOLDER):$(CSS_FOLDER) --watch

.PHONY: inspect-php
inspect-php:
	docker exec -it $(APP_CONTAINER) bash

.PHONY: inspect-database
inspect-database:
	docker exec -it $(DATABASE_CONTAINER) bash

.PHONY: copy-seeds
copy-seeds:
	docker container cp "database/sql/bddEcoride.sql" "$(DATABASE_CONTAINER):/bddEcoride.sql" && \
	docker container cp "database/sql/seeds.sql" "$(DATABASE_CONTAINER):/seeds.sql" && \
	docker exec -it $(DATABASE_CONTAINER) sh -c "mysql -u ecoride -pB8Byky8tcDuL ecoride < /bddEcoride.sql" && \
	docker exec -it $(DATABASE_CONTAINER) sh -c "mysql -u ecoride -pB8Byky8tcDuL ecoride < /seeds.sql"