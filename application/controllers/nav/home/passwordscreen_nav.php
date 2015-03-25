<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 $params = array(
            'name' => 'password',
            'value' => '',
            'fullscreen' => 'false',
            'hidevalue' => 'true',
            'manditory' => 'true',
            'predictivetext' => 'allow',
            'mode' => 'text',
            'maxlength' => 10,
        );


        $this->bml_form->set_title('Enter Password');
        $this->bml_form->set_ttl(1);
        $this->bml_form->set_action_url($this->config->item('app_home') . '?action=password');
        $this->bml_form->add_field($params);

        $this->load->view('bml/form_template', $this->bml_form);
?>
