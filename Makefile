build:
	docker build -t fas:prod --target prod .

stop:
	docker stop fas

run:
	docker stop fas || echo "Nothing to stop"
	docker run -d --name fas --rm -it -p8081:80 -v`pwd`/config.prod.yaml:/app/config.yaml:ro fas:prod
