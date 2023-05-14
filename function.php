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

    /* tahun */
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
    /* end of tahun*/

    /* Kecamatan */
    function tambah_data_kecamatan($form)
   {
       global  $connection;

       $nama = $form['nama'];
       $deskripsi = $form['deskripsi'];
       $polygon = $form['polygon'];

       $connection->query("
            INSERT INTO kecamatan
            (nama, deskripsi, polygon)
            VALUES
            ('$nama', '$deskripsi', '$polygon')
       ");

       if ($connection->affected_rows > 0) {
           set_flash_message('add_success', 'Berhasil menambahkan kecamatan');
       } else {
           set_flash_message('add_failed', 'Gagal menambahkan kecamatan');
       }
       return redirect('kecamatan.php?halaman=kecamatan');

   }

    function ambil_data_kecamatan()
   {
       global  $connection;

       return $connection->query("
            SELECT 
                id,
                nama,
                deskripsi
            FROM
                kecamatan
       ")->fetch_all(MYSQLI_ASSOC);
   }

    function ambil_kecamatan_by_id($id)
   {
       global $connection;

       return $connection->query("
            SELECT
                id,
                nama,
                deskripsi,
                polygon
            FROM
                kecamatan
            WHERE
                id = '$id'
       ")->fetch_assoc();
   }

    function update_data_kecamatan($form)
   {
       global $connection;

       $id = $form['id'];
       $nama = $form['nama'];
       $deskripsi = $form['deskripsi'];
       $polygon = $form['polygon'];

       $connection->query("
            UPDATE kecamatan
            SET
                nama  = '$nama',
                deskripsi = '$deskripsi',
                polygon = '$polygon'
            WHERE
                id = '$id'
       ");

       if ($connection->affected_rows > 0) {
           set_flash_message('add_success', 'Berhasil update kecamatan');
       } else {
           set_flash_message('add_failed', 'Gagal update kecamatan');
       }
       return redirect('kecamatan.php?halaman=kecamatan');
   }
    /* end of kecamatan */

    /* admin */
    function tambah_data_admin($form)
    {
        global $connection;

        $username = htmlspecialchars($form['username']);
        $password = mysqli_escape_string($connection, $form['password']);
        $has_password = password_hash($password, PASSWORD_DEFAULT);

        $connection->query("
            INSERT INTO user
            (username, password)
            VALUES
            ('$username', '$has_password')
        ");

        if ($connection->affected_rows > 0) {
            set_flash_message('add_success', 'Berhasil menambahkan admin');
        } else {
            set_flash_message('add_failed', 'Gagal menambahkan admin');
        }
        return redirect('admin.php?halaman=admin');


    }

    function ambil_data_admin()
    {
        global $connection;

        return $connection->query("
            SELECT
            id,
            username
            FROM user
        ")->fetch_all(MYSQLI_ASSOC);
    }

    function ambil_admin_by_id($id)
    {
        global $connection;

        return $connection->query("
            SELECT
            id,
            username
            FROM user
            WHERE id = '$id'
        ")->fetch_assoc();
    }

    function update_data_admin($form)
    {
        global $connection;

        $id = $form['id'];
        $username = htmlspecialchars($form['username']);
        if ($form['password'] == null) {
            $connection->query("
                UPDATE user
                SET
                    username = '$username'
                WHERE id = '$id'
            ");
        } else {
            $password = mysqli_escape_string($connection, $form['password']);
            $has_password = password_hash($password, PASSWORD_DEFAULT);
            $connection->query("
                UPDATE user
                SET
                    username = '$username',
                    password = '$has_password'
                WHERE id = '$id'
            ");
        }

        if ($connection->affected_rows > 0) {
            set_flash_message('add_success', 'Berhasil update admin');
        } else {
            set_flash_message('add_failed', 'Gagal update admin');
        }
        return redirect('admin.php?halaman=admin');
    }
    /* end of admin */

    /* jenis */
    function tambah_data_jenis($form)
    {
        global $connection;

        $nama = htmlspecialchars($form['nama']);

        $connection->query("
            INSERT INTO jenis
            (nama)
            VALUES
            ('$nama')
        ");

        if ($connection->affected_rows > 0) {
            set_flash_message('add_success', 'Berhasil menambahkan jenis');
        } else {
            set_flash_message('add_failed', 'Gagal menambahkan jenis');
        }
        return redirect('jenis.php?halaman=jenis');

    }

    function ambil_data_jenis()
    {
        global $connection;

        return $connection->query("
            SELECT
                id,
                nama AS jenis
            FROM jenis
        ")->fetch_all(MYSQLI_ASSOC);
    }

    function ambil_jenis_by_id($id)
    {
        global $connection;

        return $connection->query("
            SELECT
                id,
                nama AS jenis
            FROM jenis
            WHERE id = '$id'
        ")->fetch_assoc();
    }

    function update_data_jenis($form)
    {
        global $connection;

        $id = $form['id'];
        $nama = htmlspecialchars($form['nama']);

        $connection->query("
            UPDATE jenis
            SET
                nama = '$nama'
            WHERE id = '$id'
        ");

        if ($connection->affected_rows > 0) {
            set_flash_message('add_success', 'Berhasil update jenis');
        } else {
            set_flash_message('add_failed', 'Gagal update jenis');
        }
        return redirect('jenis.php?halaman=jenis');
    }
    /* end of jenis*/


