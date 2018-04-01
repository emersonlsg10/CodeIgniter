<?php

class Controle_acesso {

    public function controlar() {
        $CI = &get_instance();
        $user = $CI->session->userdata("usuario");

        if (empty($user)) {
            redirect("acesso/index");
        }
    }

}
