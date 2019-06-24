<?php
$conStr = 'host=localhost port=5432 dbname=seg user=postgres password=postgres';
$bdcon = pg_connect($conStr);

$query = "SELECT * FROM testes WHERE login='". $_POST['login'] ."' AND password='". $_POST['password'] ."'";

$result = pg_query($bdcon, $query);

// var_dump(pg_fetch_assoc($result));

if (pg_fetch_assoc($result)) {
    print 'DEU CERTO';
} else {
    print 'NÃO';
}

die();

while($consulta = pg_fetch_assoc($result)) {
    print 'id: ' . $consulta['id'] . ' - ';
    print 'login: ' . $consulta['login'] . ' - ';
    print 'name: ' . $consulta['name'] . ' - ';
    print 'password: ' . $consulta['password'] . ' <br> ';
}

die();
