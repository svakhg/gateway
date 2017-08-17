<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pages
 *
 * @author 
 */
Class Promo extends Frontend_Controller {

    var $template = 'web/template';

    public function __construct() {
        parent::__construct();
        $this->load->model('m_page');
        $this->load->model('m_promo');
    }

    public function index() {
        $this->data['page'] = $this->m_promo->get_all();
        if (!empty($this->data['page'])) {
            add_meta_title($this->data['page']->title);
           //method = '_' . $this->data['page']->template;
           //f (method_exists($this, $method)) {
            //  $this->$method();
            //else {
            //  log_message('error', 'Tidak dpt meload template ' . $method . ' di file ' . __FILE__ . ' baris ' . _LINE__);
           //   show_error('Tidak dapat meload template ' . $method);
           //}
//
//        // Load the view
            $this->data['content'] = 'templates/' . $this->data['page']->template;
            $this->load->view($this->template, $this->data);
        } else {
            $this->data['content'] = 'templates/404';
            $this->load->view($this->template, $this->data);
        }
    }

    private function _homepage() {
        $this->load->model('m_slide');
        $this->data['promo'] = $this->m_promo->get_promokelas();
        $this->data['news'] = $this->m_news->get_all();
        $this->data['slides'] = $this->m_slide->get_all();
    }

    private function _news() {
        $initial_id = $this->uri->segment(2);
        $this->load->model('m_news');
        $this->data['news']  =  $this->m_news->get_one($this->uri->segment(2));
        $this->data['all'] = $this->m_news->get_all();
    }

    private function _restaurant() {
        $this->load->model('m_restaurant');
        $this->data['kat_kantin'] = $this->m_restaurant->kat_kantin();
        $this->data['kantin']  =  $this->m_restaurant->get_one_kantin();
        $this->data['all'] = $this->m_restaurant->get_all_kantin();
    }

    private function _page() {
        
    }

    private function _galery() {
        
    }

    private function _service() {
        $this->data['kelas'] = $this->m_kelas->get_gambardefault();
        foreach ($this->data['kelas'] as $k => $v) {
            $fas = $this->m_kelas->get_aktiffac($this->data['kelas'][$k]->idclass);
            $this->data['kelas'][$k]->fasilitas = $fas;
        }
    }



}

?>
