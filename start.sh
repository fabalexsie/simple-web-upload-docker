cd /etc/nginx/ssl
# if localhost+1.pem do not already exist, create them
if [ -f "/etc/nginx/ssl/localhost+1.pem" ]; then
  echo "SSL certificate already exists"
else
  mkcert -install
  cp /root/.local/share/mkcert/rootCA.pem /var/www/html/uploads/rootCA.pem
  echo "You find the rootCA.pem in the uploads folder"
  mkcert localhost ${HOSTIP}
fi

# Start the server
/start.sh