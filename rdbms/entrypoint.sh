#!/bin/sh
set -eux
while IFS= read -r password_rdbms_admin; do
  # TODO: Dit is niet optimaal veilig, want environment variables lekken makkelijk uit. Toch gebruiken we dit vanwege een externe beperking (https://github.com/microsoft/mssql-docker/pull/364). (infosec)
  set +x
  MSSQL_SA_PASSWORD="${password_rdbms_admin:?}"
  export MSSQL_SA_PASSWORD
  set -x
  # shellcheck disable=SC2093,SC2068
  exec /opt/mssql/bin/permissions_check.sh /opt/mssql/bin/sqlservr
done </run/secrets/password_rdbms_admin
