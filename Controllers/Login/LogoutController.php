<?php
necesitaAutenticacion();
session_destroy();

// TODO: Registrar cierre de sesion en bitacora

header('location:'.LOCAL_DIR.'/Login');