docker run -it --rm --name certbot \
    --env AWS_ACCESS_KEY_ID=xxxxxxxxxxxxxxxxxxx \
    --env AWS_SECRET_ACCESS_KEY=xxxxxxxxxxxxxx \
    -v "/xxxxxxxxxx/certbot/letsencrypt/:/etc/letsencrypt/" \
    -v "/xxxxxxxxxx/certbot/letsencrypt/:/var/lib/letsencrypt/" \
    certbot/dns-route53 certonly \
    -d xxxxxxxxx \
    -m xxxxxxxxxxxxx \
    --agree-tos --server https://acme-v02.api.letsencrypt.org/directory
