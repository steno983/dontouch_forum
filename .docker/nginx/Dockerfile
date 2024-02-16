FROM nginx:latest

# Qui puoi eseguire i comandi desiderati prima dell'avvio di Nginx
#RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/bodyblyss.com.key -out /etc/ssl/certs/bobyblyss.com.crt -subj "/C=IT/ST=Milan/L=Milan/O=Organization/OU=IT Department/CN=bodyblyss.com"

# Copia la configurazione di Nginx nel container (se necessario)
COPY ./default.conf /etc/nginx/conf.d/

# Avvia Nginx in foreground (in modo che il container non si chiuda)
CMD ["nginx", "-g", "daemon off;"]
