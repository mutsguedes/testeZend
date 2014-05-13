<?php
namespace Usuario\Model;

class Usuario {
    public $id;
    public $nm_nom_usu;
    public $nm_usu_nom;
    public $nu_sen_usu;
    public $nm_eml_usu;
    public $nm_niv_usu;
    public $nu_ati_usu;
    public $dt_cad_usu;
    public $dt_ult_mov;
        public function exchangeArray($data) {
            $this->id         = (!empty($data['id'])) ? $data['id'] : null;
            $this->nm_nom_usu = (!empty($data['nm_nom_usu'])) ? $data['nm_nom_usu'] : null;
            $this->nm_usu_nom = (!empty($data['nm_usu_nom'])) ? $data['nm_usu_nom'] : null;
            $this->nu_sen_usu = (!empty($data['nu_sen_usu'])) ? $data['nu_sen_usu'] : null;
            $this->nm_eml_usu = (!empty($data['nm_eml_usu'])) ? $data['nm_eml_usu'] : null;
            $this->nm_niv_usu = (!empty($data['nm_niv_usu'])) ? $data['nm_niv_usu'] : null;
            $this->nu_ati_usu = (!empty($data['nu_ati_usu'])) ? $data['nu_ati_usu'] : null;
            $this->dt_cad_usu = (!empty($data['dt_cad_usu'])) ? $data['dt_cad_usu'] : null;
            $this->dt_ult_mov = (!empty($data['dt_ult_mov'])) ? $data['dt_ult_mov'] : null;
        }
}