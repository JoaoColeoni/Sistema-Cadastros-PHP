# PHP
`versão 7.4.33`
# Banco de Dados

## Banco de dados principal - MySQL
`MariaDB  10.4.17`

```php
$DBSERVER = 'spigonet.ddns.net';
$DBPORT = "33306";
$DBNAME = "partners";
$DBUSER = "root";
$DBPASS = "******";
```

## Banco de dados de Integração com o MBM - PostgreSQL
`PostgreSQL  9.4.26`
```php
$I_SERVER = 'spigonet.ddns.net';
$I_PORT = "55432";
$I_DATABASE = "DB_INTEGRACAO_SPIGO_MBM";
$I_USER = "postgres";
$I_PASS = "******";
```

## Banco de dados de replicação - PostgreSQL

```php
$I_REP = 'spigonet.ddns.net';
$I_REP_PORT = "55432";
$I_REP_DATABASE = "EMPRESA";
$I_REP_USER = "postgres";
$I_REP_PASS = "******";
```

## Banco de dados de Integração com o Dynamics - SQL Server

```php
$S_SERVER = "spigonet.ddns.net";
$S_PORT = "11433";
$S_SCHEMA = "partners";
$S_DATABASE = "Dynamics";
$S_USER = 'sa';
$S_PASS = '******';
```
