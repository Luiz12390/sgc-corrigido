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
    chown -R www-data:www-data /var/www/html/storage
    su www-data -s /bin/sh -c "cd /var/www/html && php artisan storage:link"
    exec supervisord -c /etc/supervisor/supervisord.conf
fi
