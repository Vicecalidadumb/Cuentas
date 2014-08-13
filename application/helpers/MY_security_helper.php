<?php

function validate_login($logged_in) {
    $CI = & get_instance();
    if ($logged_in == FALSE) {
        $CI->session->set_flashdata(array('message' => '<strong>Error</strong> Debe Iniciar una Sesion.', 'message_type' => 'danger'));
        redirect('', 'refresh');
    }
}

function know_permission_role($module_sigla, $permission_type) {
    $CI = & get_instance();
    $rol_permissions = $CI->session->userdata('rol_permissions');
    if (isset($rol_permissions[$module_sigla]['permissions'][$permission_type]))
        return ($rol_permissions[$module_sigla]['permissions'][$permission_type] == 1) ? TRUE : FALSE;
    else
        return false;
}

function validation_permission_role($module_sigla, $permission_type) {
    $CI = & get_instance();
    $rol_permissions = $CI->session->userdata('rol_permissions');
    //echo '<pre>'.print_r($CI->session->userdata('rol_permissions'),true).'</pre>'; return;
    if ($rol_permissions[$module_sigla]['permissions'][$permission_type] == 1) {
        return TRUE;
    } else {
        $CI->session->set_flashdata(array('message' => 'No Posee Permisos para Realizar esta Accion.', 'message_type' => 'warning'));
        redirect('/desk', 'refresh');
    }
}

function make_hash($password, $saltlength = 8) {
    $salt = substr(md5(uniqid(rand(), true)), 0, $saltlength);
    return $salt . '$' . sha1($salt . $password);
}

function verifyHash($password, $hash) {
    if ($hash == '')
        return false;

    if (substr_count($hash, ':') > 0) {
        // WHMCS Salted
        $parts = explode(':', $hash);
        $salt = $parts[1];
        $hash = $parts[0];

        if (md5($salt . html_entity_decode($password)) == $hash)
            return true;
    } elseif (substr_count($hash, '$') > 0) {
        // DNA Salted
        $parts = explode('$', $hash);
        if (strcmp(sha1($parts[0] . $password), $parts[1]) == 0)
            return true;
    }


    return false;
}

function check_password($password, $stored_hash) {
    $hash = crypt_private($password, $stored_hash);
    if ($hash[0] == '*')
        $hash = crypt($password, $stored_hash);

    return $hash == $stored_hash;
}

function crypt_private($password, $setting) {
    $output = '*0';
    if (substr($setting, 0, 2) == $output)
        $output = '*1';

    $id = substr($setting, 0, 3);
# We use "$P$", phpBB3 uses "$H$" for the same thing
    if ($id != '$P$' && $id != '$H$')
        return $output;

    $count_log2 = strpos($this->itoa64, $setting[3]);
    if ($count_log2 < 7 || $count_log2 > 30)
        return $output;

    $count = 1 << $count_log2;

    $salt = substr($setting, 4, 8);
    if (strlen($salt) != 8)
        return $output;

# We're kind of forced to use MD5 here since it's the only
# cryptographic primitive available in all versions of PHP
# currently in use.  To implement our own low-level crypto
# in PHP would result in much worse performance and
# consequently in lower iteration counts and hashes that are
# quicker to crack (by non-PHP code).
    if (PHP_VERSION >= '5') {
        $hash = md5($salt . $password, TRUE);
        do {
            $hash = md5($hash . $password, TRUE);
        } while (--$count);
    } else {
        $hash = pack('H*', md5($salt . $password));
        do {
            $hash = pack('H*', md5($hash . $password));
        } while (--$count);
    }

    $output = substr($setting, 0, 12);
    $output .= $this->encode64($hash, 16);

    return $output;
}

function encode64($input, $count) {
    $output = '';
    $i = 0;
    do {
        $value = ord($input[$i++]);
        $output .= $this->itoa64[$value & 0x3f];
        if ($i < $count)
            $value |= ord($input[$i]) << 8;
        $output .= $this->itoa64[($value >> 6) & 0x3f];
        if ($i++ >= $count)
            break;
        if ($i < $count)
            $value |= ord($input[$i]) << 16;
        $output .= $this->itoa64[($value >> 12) & 0x3f];
        if ($i++ >= $count)
            break;
        $output .= $this->itoa64[($value >> 18) & 0x3f];
    } while ($i < $count);

    return $output;
}

