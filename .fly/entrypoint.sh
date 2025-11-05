#!/usr/bin/env sh

# Run user scripts, if they exist
for f in /var/www/html/.fly/scripts/*.sh; do
    # Bail out this loop if any script exits with non-zero status code
    bash "$f" -e
done

if [ $# -gt 0 ]; then
    # If we passed a command, run it as root
    exec "$@"
else
    # --- INÍCIO DAS NOSSAS CORREÇÕES ---

    # 1. Garante que as pastas de framework essenciais existem
    mkdir -p /var/www/html/storage/framework/sessions
    mkdir -p /var/www/html/storage/framework/views
    mkdir -p /var/www/html/storage/framework/cache/data
    mkdir -p /var/www/html/storage/logs

    # 2. Define o 'www-data' como dono de todo o storage
    chown -R www-data:www-data /var/www/html/storage

    # 3. Mude para o diretório da aplicação
    cd /var/www/html

    # 4. Crie o atalho como ROOT (para garantir que funciona)
    #    (O '|| true' ignora erros se o link já existir)
    php artisan storage:link || true

    # 5. CORRIJA a permissão do atalho que acabámos de criar
    #    (O atalho está em /var/www/html/public/storage)
    chown -h www-data:www-data /var/www/html/public/storage

    # --- FIM DAS NOSSAS CORREÇÕES ---

    # Comando original para iniciar o servidor
    exec supervisord -c /etc/supervisor/supervisord.conf
fi
