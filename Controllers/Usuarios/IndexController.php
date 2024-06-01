<?php
requiereAutenticacion();

$usuarios = Usuario::listar();

renderView();