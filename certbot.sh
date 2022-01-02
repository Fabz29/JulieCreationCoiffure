docker run -it --rm --name certbot \
    --env AWS_ACCESS_KEY_ID=XXXXXXXXXX \
    --env AWS_SECRET_ACCESS_KEY=XXXXXXXXXXX \
    -v "/home/ubuntu/PhpstormProjects/JulierCreationCoiffure/certbot/letsencrypt/:/etc/letsencrypt/" \
    -v "/home/ubuntu/PhpstormProjects/JulierCreationCoiffure/certbot/letsencrypt/:/var/lib/letsencrypt/" \
    certbot/dns-route53 certonly \
    -d julie-creation-coiffure.fr \
    -m XXXXXXXXXXXX \
    --agree-tos --server https://acme-v02.api.letsencrypt.org/directory