cd /etc/nginx/ssl
mkcert -install
mkcert localhost ${HOSTIP}

# Start the server
/start.sh