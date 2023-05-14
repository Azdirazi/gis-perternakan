<?php

   include 'connection.php';
   include 'helper.php';

   function create_user($form) {
     global $connection;

     $username = htmlspecialchars(strtolower(stripcslashes($form['username'])));
     $password = mysqli_escape_string($connection, $form['password']);
     $confirm_password =  mysqli_escape_string($connection, $form['confirm_password']);
     $confirm_password = mysqli_escape_string($connection, $form['confirm_password']);
     $has_password = password_hash($password, PASSWORD_DEFAULT);


     if ($password != $confirm_password) {
          set_flash_message('password_error', 'Password tidak sesuai');
          return;
     }

     $mysql = $connection->query("INSERT INTO users (username, password) VALUES ('$username', '$has_password')");

     if ($connection->affected_rows > 0) {
          set_flash_message('register_success', 'Berhasil melakukan pendaftaran');
          redirect('login.php');
     } else {
          set_flash_message('register_failed', 'Gagal melakukan pendaftaran');
     }
   }

   function tambah_data_tahun($form)
   {
       global $connection;

       $tahun = htmlspecialchars($form['tahun']);


       $connection->query("
            INSERT INTO tahun
            (tahun)
            VALUES
            ('$tahun')
       ");

       if ($connection->affected_rows > 0) {
           set_flash_message('add_success', 'Berhasil menambahkan tahun');
       } else {
           set_flash_message('add_failed', 'Gagal menambahkan tahun');
       }
       return redirect('tahun.php?halaman=tahun');

   }

   function ambiL_data_tahun()
   {
       global $connection;

       $data = $connection->query("
            SELECT
                id,
                tahun
            FROM
                tahun
       ")->fetch_all(MYSQLI_ASSOC);

       return $data;
   }

   function update_data_tahun($form)
   {
       global $connection;

       $tahun = htmlspecialchars($form['tahun']);
       $id = $form['id'];

       $connection->query("
            UPDATE tahun
            SET 
                tahun = '$tahun'
            WHERE
                id = '$id'
       ");

       if ($connection->affected_rows > 0) {
           set_flash_message('add_success', 'Berhasil update tahun');
       } else {
           set_flash_message('add_failed', 'Gagal update tahun');
       }
       return redirect('tahun.php?halaman=tahun');

   }

   function ambil_tahun_by_id($id)
   {
        global $connection;

        return $connection->query("SELECT id, tahun FROM tahun WHERE id= '$id'")->fetch_assoc();
   }
