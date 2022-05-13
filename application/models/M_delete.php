<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_delete extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function searchJakbar($code_manifest)
    {
        $sql = 'select sm.id,sm.code_manifest,sm.kabupaten,sm.kecamatan,sm.kelurahan,count(tm.bansos_id) as qty 
        from shipping_mtg sm
        join tb_mtg tm
        on sm.id = tm.shipping_id
        where code_manifest=?';
        $query = $this->db->query($sql, [$code_manifest]);
        return $query->row();
    }

    public function searchNonJakbar($code_manifest)
    {
        $sql = 'select sm.id, sm.code_shipping as code_manifest,sm.kabupaten,sm.kecamatan,sm.kelurahan,qty 
        from shipping sm
        where code_shipping=?';
        $query = $this->db->query($sql, [$code_manifest]);
        return $query->row();
    }

    public function getShippingJakbar($id_shipping)
    {
        $this->db->where('id', $id_shipping);
        $query = $this->db->get('shipping_mtg');
        return $query->row();
    }

    public function getShippingNonJakbar($id_shipping)
    {
        $this->db->where('id', $id_shipping);
        $query = $this->db->get('shipping');
        return $query->row();
    }

    public function getListBansosJakbar($id_shipping)
    {
        $sql = 'select id from bansos
        where id in (
        select bansos_id from tb_mtg
        where shipping_id = ?)';
        $query = $this->db->query($sql, [$id_shipping]);
        return $query->result();
    }

    public function getListBansosNonJakbar($id_shipping)
    {
        $sql = 'select id from bansos_non
        where id in (
        select bansos_id from non_mtg
        where shipping_id = ?)';
        $query = $this->db->query($sql, [$id_shipping]);
        return $query->result();
    }

    public function deleteShippingJakbar($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('shipping_mtg');
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function listBastDetailModel($id)
    {
        $this->db->where('shipping_id',$id);
        $query = $this->db->get('tb_mtg');
        return $query->result();
    }

    public function deleteDetailBastModel($id)
    {
        $this->db->set('status_bast_detail', 2);
        $this->db->where('id', $id);
        $this->db->update('tb_mtg');
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteShippingNonJakbar($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('shipping');
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteBansosJakbar($id)
    {
        $this->db->set('flag', 0);
        $this->db->where('id', $id);
        $this->db->update('bansos');
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteBansosNonJakbar($id)
    {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update('bansos_non');
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
