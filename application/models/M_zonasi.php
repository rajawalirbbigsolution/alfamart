<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_zonasi extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function getData($num = "", $offset = "", $provinsi)
	{
		if ($num != "" || $offset != "") {
			$LIMIT =  "LIMIT $num OFFSET $offset";
		} else {
			$LIMIT = "";
		}
		$sql = "SELECT
		mz.id,
		mz.provinsi,
		mz.kabupaten,
		mz.kecamatan,
		mz.kelurahan,
		mz.priority,
		mz.name_warehouse,
		mz.date_plan,
		COALESCE ( tot_kpm.total_kpm_tc_bast, 0 ) total_kpm_tc_bast,
		requisition_number,
		(qty-COALESCE ( tot_kpm.total_kpm_tc_bast, 0 )) as qty,
		code_faskes
	FROM
		ms_zonasi mz
		LEFT JOIN (
		SELECT
			tcb.provinsi,
			tcb.kabupaten,
			tcb.kecamatan,
			tcb.kelurahan,
			SUM( tcb.qty ) AS total_kpm_tc_bast 
		FROM
			tc_bast tcb 
		WHERE
			tcb.STATUS != 0 
		GROUP BY
			tcb.provinsi,
			tcb.kabupaten,
			tcb.kecamatan,
			tcb.kelurahan 
		) tot_kpm ON mz.provinsi = tot_kpm.provinsi 
		AND mz.kabupaten = tot_kpm.kabupaten 
		AND mz.kecamatan = tot_kpm.kecamatan 
		AND mz.kelurahan = tot_kpm.kelurahan
		JOIN (SELECT tr.requisition_number, sum(qty) as qty, supplier_code FROM tc_requisition tr join tc_requisition_detail trd on tr.id = trd.tc_requisition_id GROUP BY tr.supplier_code)tr on mz.code_faskes = tr.supplier_code
	WHERE
		mz.provinsi LIKE '%$provinsi%' 
	ORDER BY
		mz.priority,
		mz.date_plan ASC
			$LIMIT ";
		return $this->db->query($sql);
	}


	function getDataResult($num, $offset, $provinsi)
	{
		return $this->getData($num, $offset, $provinsi)->result();
	}

	public function getCountData($provinsi)
	{
		return $this->getData($num = "", $offset = "", $provinsi)->num_rows();
	}

	function filterModel($num = "", $offset = "", $params, $value_filter, $provinsi, $param_1, $param_2)
	{
		if ($num != "" || $offset != "") {
			$LIMIT =  "LIMIT $num OFFSET $offset";
		} else {
			$LIMIT = "";
		}

		$sql = "SELECT mz.id, mz.provinsi, mz.kabupaten, mz.kecamatan, mz.kelurahan, mz.priority, mz.name_warehouse, mb.target_kpm, mz.date_plan,
		COALESCE(tot_kpm.total_kpm_tc_bast,0) total_kpm_tc_bast, mb.target_kpm - COALESCE(tot_kpm.total_kpm_tc_bast,0) sisa_kpm,requisition_number,
					qty,
					code_faskes
		FROM 
			ms_zonasi mz 
		LEFT JOIN
			(select provinsi, kabupaten, kecamatan, kelurahan, COUNT(id)*3 target_kpm
				from ms_bansos
				group by provinsi, kabupaten, kecamatan, kelurahan
			) mb ON mz.provinsi = mb.provinsi AND mz.kabupaten = mb.kabupaten AND mz.kecamatan = mb.kecamatan AND mz.kelurahan = mb.kelurahan
		LEFT JOIN (
			SELECT tcb.provinsi, tcb.kabupaten, tcb.kecamatan, tcb.kelurahan, SUM(tcb.qty) AS total_kpm_tc_bast
			FROM
				tc_bast tcb
			WHERE tcb.status != 0 
			GROUP BY tcb.provinsi, tcb.kabupaten, tcb.kecamatan, tcb.kelurahan
		) tot_kpm
		ON mz.provinsi = tot_kpm.provinsi AND mz.kabupaten = tot_kpm.kabupaten AND mz.kecamatan = tot_kpm.kecamatan AND mz.kelurahan = tot_kpm.kelurahan
		JOIN (SELECT tr.requisition_number, sum(qty) as qty, supplier_code FROM tc_requisition tr join tc_requisition_detail trd on tr.id = trd.tc_requisition_id GROUP BY trd.tc_requisition_id)tr on mz.code_faskes = tr.supplier_code
		WHERE
				mz.$params like '%$value_filter%' and mz.name_warehouse like '%$param_1%' and mz.date_plan like '%$param_2%'
				and mz.provinsi like '%$provinsi%'
		ORDER BY mz.priority, mz.date_plan ASC 
		$LIMIT";
		return $this->db->query($sql);
	}

	function FiltergetDataResult($num, $offset, $params, $value_filter, $provinsi, $param_1, $param_2)
	{
		return $this->filterModel($num, $offset, $params, $value_filter, $provinsi, $param_1, $param_2)->result();
	}

	public function FiltergetCountData($num = "", $offset = "", $params, $value_filter, $provinsi, $param_1, $param_2)
	{
		return $this->filterModel($num, $offset, $params, $value_filter, $provinsi, $param_1, $param_2)->num_rows();
	}

	function cekZonasi($provinsi, $kabupaten, $kecamatan, $kelurahan)
	{
		$this->db->where('provinsi', $provinsi);
		$this->db->where('kabupaten', $kabupaten);
		$this->db->where('kecamatan', $kecamatan);
		$this->db->where('kelurahan', $kelurahan);
		$query = $this->db->get('ms_zonasi');
		return $query->result();
	}

	function getEditData($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get("ms_zonasi");
		return $query->row();
	}

	function deleteZonasi($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('ms_zonasi');
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function postAdd($data)
	{
		$query = $this->db->insert('ms_zonasi', $data);
		return $query;
	}

	function get_update_zonasi_by_import($data_update, $provinsi, $kabupaten, $kecamatan, $kelurahan)
	{
		$this->db->set($data_update);
		$this->db->where('provinsi', $provinsi);
		$this->db->where('kabupaten', $kabupaten);
		$this->db->where('kecamatan', $kecamatan);
		$this->db->where('kelurahan', $kelurahan);
		$this->db->update('ms_zonasi');
	}

	function cekWilayahZonasi($provinsi, $kabupaten, $kecamatan, $kelurahan)
	{

		$this->db->where('provinsi', $provinsi);
		$this->db->where('kabupaten', $kabupaten);
		$this->db->where('kecamatan', $kecamatan);
		$this->db->where('kelurahan', $kelurahan);
		$query = $this->db->get('ms_provinsi_kpm');
		return $query->result();
	}

	function get_update_zonasi($datas, $id)
	{
		$this->db->set($datas);
		$this->db->where('id', $id);
		$this->db->update('ms_zonasi');
		return $this->db->affected_rows();
	}

	function getKabupaten($provinsi)
	{
		$sql = 'SELECT nn.kabupaten,nn.kecamatan,nn.kelurahan from (

            (select * from (
            select id,provinsi,kabupaten,kecamatan,kelurahan
                                from ms_bansos 				
                                            GROUP BY provinsi,kabupaten,kecamatan,kelurahan) aa) nn)
			LEFT JOIN
            (select * from (
            select DISTINCT provinsi,kabupaten,kecamatan,kelurahan,id from ms_zonasi 
            
                    ) bb) mm
                on nn.provinsi = mm.provinsi 
								and nn.kabupaten = mm.kabupaten
                and nn.kecamatan = mm.kecamatan
                and nn.kelurahan = mm.kelurahan
								
            
            where mm.kabupaten is null 
							and nn.provinsi = ?
            group by nn.provinsi,nn.kabupaten';
		$query = $this->db->query($sql, [$provinsi]);
		return $query->result();
	}
	function getWarehouse($provinsi)
	{
		$this->db->select('*');
		if ($provinsi != null) {
			$this->db->where('company', $provinsi);
		}

		$query = $this->db->get("ms_warehouse");
		return $query->result();
	}


	function getKecamatan($provinsi, $kabupaten)
	{
		$sql = 'SELECT nn.kabupaten,nn.kecamatan,nn.kelurahan from (

            (select * from (
            select id,provinsi,kabupaten,kecamatan,kelurahan
                                from ms_bansos 				
                                            GROUP BY provinsi,kabupaten,kecamatan,kelurahan) aa) nn)
             left join
            
            (select * from (
            select DISTINCT provinsi,kabupaten,kecamatan,kelurahan,id from ms_zonasi 
            
                    ) bb) mm
                on nn.provinsi = mm.provinsi 
								and nn.kabupaten = mm.kabupaten
                and nn.kecamatan = mm.kecamatan
                and nn.kelurahan = mm.kelurahan
								
            
            where mm.kabupaten is null 
							and nn.provinsi = ?
							and nn.kabupaten = ?
            group by nn.provinsi,nn.kabupaten,nn.kecamatan';
		$query = $this->db->query($sql, [$provinsi, $kabupaten]);
		return $query->result();
	}



	function getKelurahan($provinsi, $kabupaten, $kecamatan)
	{
		$sql = 'SELECT nn.kabupaten,nn.kecamatan,nn.kelurahan from (

            (select * from (
            select id,provinsi,kabupaten,kecamatan,kelurahan
                                from ms_bansos 				
                                            GROUP BY provinsi,kabupaten,kecamatan,kelurahan) aa) nn)
             left join
            
            (select * from (
            select DISTINCT provinsi,kabupaten,kecamatan,kelurahan,id from ms_zonasi 
            
                    ) bb) mm
                on nn.provinsi = mm.provinsi 
								and nn.kabupaten = mm.kabupaten
                and nn.kecamatan = mm.kecamatan
                and nn.kelurahan = mm.kelurahan
								
            
            where mm.kabupaten is null 
							and nn.provinsi = ?
							and nn.kabupaten = ?
							and nn.kecamatan = ?
            group by nn.provinsi,nn.kabupaten,nn.kecamatan,nn.kelurahan';
		$query = $this->db->query($sql, [$provinsi, $kabupaten, $kecamatan]);
		return $query->result();
	}



	/*public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './assets/excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}*/

	public function getAllZonasi($provinsi)
	{
		$sql = "SELECT available_area.provinsi,available_area.kabupaten,available_area.kecamatan,available_area.kelurahan,mz.date_plan 
		FROM (SELECT source.provinsi,source.kabupaten,source.kecamatan,source.kelurahan
		FROM (SELECT provinsi,kabupaten,kecamatan,kelurahan,count(id) as total
		FROM ms_bansos
		WHERE provinsi = ?
		GROUP BY provinsi,kabupaten,kecamatan,kelurahan) source
		LEFT JOIN 
		(SELECT provinsi,kabupaten,kecamatan,kelurahan, SUM(qty) as total
		FROM tc_bast tb
		WHERE provinsi = ?
		AND status != 0
		GROUP BY provinsi,kabupaten,kecamatan,kelurahan) anchor
		ON source.provinsi = anchor.provinsi
		AND source.kabupaten = anchor.kabupaten
		AND source.kecamatan = anchor.kecamatan
		AND source.kelurahan = anchor.kelurahan
		AND source.total = anchor.total
		WHERE anchor.provinsi is null) available_area
		LEFT JOIN ms_zonasi mz 
		ON available_area.provinsi = mz.provinsi 
		AND available_area.kabupaten = mz.kabupaten 
		AND available_area.kecamatan = mz.kecamatan 
		AND available_area.kelurahan = mz.kelurahan";
		$query = $this->db->query($sql, [$provinsi, $provinsi]);
		return $query->result();
	}

	public function getAllWarehouse($provinsi)
	{
		$sql = 'SELECT DISTINCT code_warehouse,name_warehouse
		FROM ms_warehouse
		WHERE company = ?
		ORDER BY 2';
		$query = $this->db->query($sql, [$provinsi]);
		return $query->result();
	}

	public function updateWithAjaxModel($id, $field, $value)
	{
		$data = array($field => $value);
		$this->db->where('id', $id);
		$this->db->update('ms_zonasi', $data);
	}

	function update_kolom($id, $value, $modul)
	{
		$this->db->where(array(
			"id" => $id
		));
		$this->db->update("ms_zonasi", array(
			$modul => $value,
			"updated_date" => date('Y-m-d H:i:s')
		));
	}

	function get_warehouse($provinsi)
	{
		$this->db->like('company', $provinsi);
		$this->db->order_by('code_warehouse', 'asc');
		$query = $this->db->get('ms_warehouse');
		return $query->result();
	}

	function cek_warehouse_code($provinsi, $cd_warehouse)
	{
		if ($provinsi != null) {
			$sql   = "SELECT * from ms_warehouse WHERE code_warehouse in($cd_warehouse) AND company='$provinsi'";
		} else {
			$sql   = "SELECT * from ms_warehouse WHERE code_warehouse in($cd_warehouse)";
		}

		$query = $this->db->query($sql);
		return $query->result();
	}

	function getRequsition($supplier_code)
	{
		$sql = "SELECT requisition_number FROM tc_requisition WHERE supplier_code = '$supplier_code'";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
