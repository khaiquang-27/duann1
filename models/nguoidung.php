<?php

function load_all_account() {
  $sql = "SELECT * FROM nguoidung ORDER BY ma_nguoi_dung ASC";
  return pdo_query($sql);
}

function updatetrangthai($new_status, $id) {
  $sql = "UPDATE nguoidung SET trang_thai = ? WHERE ma_nguoi_dung = ?";
  pdo_execute($sql, $new_status, $id);
}

function insert_user($ten, $email, $mat_khau, $hinh, $so_dien_thoai, $dia_chi) {
  if (emailExists($email)) {
    throw new Exception("Email đã tồn tại!");
  }

  $sql = "INSERT INTO nguoidung (ten, email, mat_khau, anh_dai_dien, so_dien_thoai, dia_chi) 
          VALUES (?, ?, ?, ?, ?, ?)";
  pdo_execute($sql, $ten, $email, $mat_khau, $hinh, $so_dien_thoai, $dia_chi);
}

function findByEmail($email) {
  $sql = "SELECT * FROM nguoidung WHERE email = ?";
  return pdo_query_one($sql, $email);
}

function emailExists($email) {
  $sql = "SELECT COUNT(*) AS count FROM nguoidung WHERE email = ?";
  $result = pdo_query_one($sql, $email);
  return $result && $result['count'] > 0;
}

function get_user_by_id($ma_nguoi_dung) {
  $sql = "SELECT * FROM nguoidung WHERE ma_nguoi_dung = ?";
  return pdo_query_one($sql, $ma_nguoi_dung);
}

function update_user($ma_nguoi_dung, $ho_ten, $email, $so_dien_thoai, $dia_chi, $anh_dai_dien) {
  $sql = "UPDATE nguoidung 
          SET ten = ?, email = ?, anh_dai_dien = ?, so_dien_thoai = ?, dia_chi = ?
          WHERE ma_nguoi_dung = ?";
  pdo_execute($sql, $ho_ten, $email, $anh_dai_dien, $so_dien_thoai, $dia_chi, $ma_nguoi_dung);
}
