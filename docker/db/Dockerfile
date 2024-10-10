FROM mysql:8.0.30

# docker-entrypoint-initdb.d にある SQL ファイルがコンテナ起動時に実行される
COPY ./docker/db/initdb.d /docker-entrypoint-initdb.d