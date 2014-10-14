<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Drt_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_rekanan() {
        $query = $this->db->query("SELECT * FROM t_rekanan");
        return $query->result();
    }
    
    function get_rows() {
        $query = $this->db->query("SELECT * FROM t_rekanan");
        return $query->num_rows();
    }

    function get_nama_bidang($id) {
        $query = $this->db->query("SELECT nama_sub FROM t_sub_bidang WHERE id_sub = '" . $id . "'");
        return $query->row();
    }

    function get_sub_bidang($id_rekanan, $id_bidang) {
        $query = $this->db->query("SELECT B.nama_sub FROM t_sub AS A JOIN t_sub_bidang as B WHERE A.id_rekanan = '" . $id_rekanan . "' AND A.id_sub_bidang = B.id_sub AND B.id_bidang = '" . $id_bidang . "'");
        return $query->result();
    }

    function get_bidang($id) {
        $query = $this->db->query("SELECT DISTINCT C.id_bidang, C.nama_bidang FROM t_sub AS A JOIN t_sub_bidang AS B JOIN t_bidang AS C WHERE A.id_rekanan = '" . $id . "' AND A.id_sub_bidang = B.id_sub AND B.id_bidang = C.id_bidang");
        return $query->result();
    }

    function get_details($id) {
        $query = $this->db->query("SELECT * FROM t_rekanan WHERE id_rekanan = '" . $id . "'");
        return $query->row();
    }

    function get_dokumen($id_rekanan) {
        $query = $this->db->query("SELECT * FROM t_dokumen WHERE id_rekanan = '" . $id_rekanan . "'");
        return $query->row();
    }

    function get_bidang2($term) {
        //$query = $this->db->query("SELECT * FROM t_bidang WHERE nama_bidang LIKE '%".$term."%'");
        $this->db->select('id_bidang,nama_bidang');
        $this->db->like('nama_bidang', $term);
        $query = $this->db->get('t_bidang');
        if ($query->num_rows > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['id'] = htmlentities(stripslashes($row['id_bidang']));
                $new_row['label'] = htmlentities(stripslashes($row['nama_bidang']));
                $row_set[] = $new_row;
            }
            echo json_encode($row_set);
        }
    }

    function get_sub_bidang2($bidang, $term) {
        $query = $this->db->query("SELECT * FROM t_sub_bidang AS b JOIN t_kategori AS c WHERE b.id_bidang = '" . $bidang . "' AND b.id_kategori = c.id_kategori AND nama_sub LIKE '%" . $term . "%'");
        if ($query->num_rows > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['id'] = htmlentities(stripslashes($row['id_sub']));
                $new_row['label'] = htmlentities(stripslashes($row['nama_sub']));
                $new_row['id_cat'] = htmlentities(stripslashes($row['id_kategori']));
                $new_row['category'] = htmlentities(stripslashes($row['nama_kategori']));
                $row_set[] = $new_row;
            }
            echo json_encode($row_set);
        }
    }

    function get_sub_bidang3($bidang) {
        $query = $this->db->query("SELECT * FROM t_sub_bidang AS b JOIN t_kategori AS c WHERE b.id_bidang = '" . $bidang . "' AND b.id_kategori = c.id_kategori");
        if ($query->num_rows > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['id'] = htmlentities(stripslashes($row['id_sub']));
                $new_row['label'] = htmlentities(stripslashes($row['nama_sub']));
                $new_row['id_cat'] = htmlentities(stripslashes($row['id_kategori']));
                $new_row['category'] = htmlentities(stripslashes($row['nama_kategori']));
                $row_set[] = $new_row;
            }
            echo json_encode($row_set);
        }
    }

    function get_kategori() {
        $query = $this->db->query("SELECT * FROM t_kategori");
        return $query->result();
    }

    function get_kategori_from_bidang($id) {
        $query = $this->db->query("SELECT * FROM t_kategori WHERE id_bidang = '" . $id . "'");
        return $query->result();
    }

    function get_sub($id) {
        $query = $this->db->query("SELECT * FROM t_sub_bidang WHERE id_kategori = '" . $id . "'");
        return $query->result();
    }

    function get_sub_from_rekanan($id) {
        $query = $this->db->query("SELECT * FROM t_sub WHERE id_rekanan = '" . $id . "'");
        return $query->result();
    }

    function get_sub_from_rekanan2($id) {
        $query = $this->db->query("SELECT * FROM t_sub AS S JOIN t_sub_bidang AS SB WHERE S.id_sub_bidang = SB.id_sub AND S.id_rekanan = '" . $id . "'");
        return $query->result();
    }

    function get_max_tahun_tahap() {
        $query = $this->db->query("SELECT MAX(tahun) tahun, MAX(tahap_drt) tahap FROM t_seleksi");
        return $query->row();
    }

    function get_tahun_drt() {
        $query = $this->db->query("SELECT DISTINCT tahun FROM t_seleksi ORDER BY tahun DESC");
        return $query->result();
    }

    function get_tahap_drt($tahun) {
        $query = $this->db->query("SELECT DISTINCT tahap_drt FROM t_seleksi WHERE tahun = '" . $tahun . "'");
        return $query->result();
    }

    function get_drt($tahun, $tahap) {
        if ($tahun == 0 || $tahap == 0) {
            $query = $this->db->query("SELECT * FROM t_rekanan AS r JOIN t_seleksi AS s WHERE r.id_rekanan = s.id_rekanan AND s.tahun = (SELECT MAX(tahun) FROM t_seleksi) AND s.tahap_drt = (SELECT MAX(tahap_drt) FROM t_seleksi WHERE tahun = (SELECT MAX(tahun) FROM t_seleksi)) AND penilaian >= 70");
        } else {
            $query = $this->db->query("SELECT * FROM t_rekanan AS r JOIN t_seleksi AS s WHERE r.id_rekanan = s.id_rekanan AND s.tahun = '" . $tahun . "' AND s.tahap_drt = '" . $tahap . "' AND penilaian >= 70");
        }
        return $query->result();
    }

    function get_tdrt($tahun, $tahap) {
        if ($tahun == 0 || $tahap == 0) {
            $query = $this->db->query("SELECT * FROM t_rekanan AS r JOIN t_seleksi AS s WHERE r.id_rekanan = s.id_rekanan AND s.tahun = (SELECT MAX(tahun) FROM t_seleksi) AND s.tahap_drt = (SELECT MAX(tahap_drt) FROM t_seleksi WHERE tahun = (SELECT MAX(tahun) FROM t_seleksi)) AND penilaian < 70");
        } else {
            $query = $this->db->query("SELECT * FROM t_rekanan AS r JOIN t_seleksi AS s WHERE r.id_rekanan = s.id_rekanan AND s.tahun = '" . $tahun . "' AND s.tahap_drt = '" . $tahap . "' AND penilaian < 70");
        }
        return $query->result();
    }

    function tahun_tahap($tahun = 0, $tahap = 0) {
        if ($tahun == 0 || $tahap == 0) {
            $query = $this->db->query("SELECT DISTINCT s.tahun, s.tahap_drt FROM t_rekanan AS r JOIN t_seleksi AS s WHERE r.id_rekanan = s.id_rekanan AND s.tahun = (SELECT MAX(tahun) FROM t_seleksi) AND s.tahap_drt = (SELECT MAX(tahap_drt) FROM t_seleksi WHERE tahun = (SELECT MAX(tahun) FROM t_seleksi))");
        } else {
            $query = $this->db->query("SELECT DISTINCT s.tahun, s.tahap_drt FROM t_rekanan AS r JOIN t_seleksi AS s WHERE r.id_rekanan = s.id_rekanan AND s.tahun = '" . $tahun . "' AND s.tahap_drt = '" . $tahap . "'");
        }
        return $query->row();
    }

    function waiting_list() {
        //$query = $this->db->query("SELECT * FROM t_rekanan r WHERE r.id_rekanan NOT IN (SELECT s.id_rekanan FROM t_seleksi s)");
        $query = $this->db->query("SELECT * FROM t_rekanan r WHERE status = 0");
        return $query->result();
    }

    function waiting_list_10() {
        $query = $this->db->query("SELECT id_rekanan, nama_rekanan, golongan FROM t_rekanan r WHERE status = 0 LIMIT 5");
        return $query->result();
    }

    function count_waiting_list() {
        $query = $this->db->query("SELECT * FROM t_rekanan r WHERE status = 0");
        return $query->num_rows();
    }

    function waiting_list_id() {
        $query = $this->db->query("SELECT id_rekanan FROM t_rekanan r WHERE status = 0");
        return $query->result();
    }
    
    function to_waiting_list() {
        foreach ($_POST['id_rekanan'] as $value) {
            $data = array(
                'status' => '0'
            );
            $this->db->where('id_rekanan', $value);
            $this->db->update('t_rekanan', $data);
        }
    }

    function count_rekanan() {
        $query = $this->db->query("SELECT * FROM t_rekanan");
        return $query->num_rows();
    }

    function proses_seleksi() {
        $data = $this->waiting_list_id();
        foreach ($data as $d) {
            $id = $d->id_rekanan;
            $nilai = $this->get_nilai($id);

            $rekanan = array(
                'id_seleksi' => '',
                'id_rekanan' => $id,
                'penilaian' => $nilai,
                'tmt' => $this->fungsi->set_back($_POST['tmt']),
                'akhir_masa_berlaku' => $this->fungsi->set_back($_POST['sd']),
                'no_skep' => $_POST['no_skep'],
                'tahap_drt' => $_POST['tahap'],
                'tahun' => $_POST['tahun']
            );
            $this->db->insert('t_seleksi', $rekanan);

            $data = array(
                'status' => '1'
            );
            $this->db->where('id_rekanan', $id);
            $this->db->update('t_rekanan', $data);
        }
    }

    function get_nilai($id) {
        $query = $this->db->query("SELECT id_rekanan, srp_sbu, akta_notaris, klasifikasi, tdp, skitu, siup, npwp, kadin, ardin, gapensi, struktur_org, neraca FROM t_dokumen WHERE id_rekanan = '" . $id . "'");
        $data = $query->row();

        $nilai = 90;
        return $nilai;
    }

}

?>
