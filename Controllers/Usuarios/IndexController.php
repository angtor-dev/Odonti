<?php
requiereAutenticacion();

$usuarios = Usuario::listar(1);

renderView();