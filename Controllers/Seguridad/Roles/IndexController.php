<?php
requiereAutenticacion();

$roles = Rol::listar(1);

renderView();