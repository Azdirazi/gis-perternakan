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

    $mysql = $connection->query("INSERT INTO user (username, password) VALUES ('$username', '$has_password')");

    if ($connection->affected_rows > 0) {
        set_flash_message('register_success', 'Berhasil melakukan pendaftaran');
        redirect('login.php');
    } else {
        set_flash_message('register_failed', 'Gagal melakukan pendaftaran');
    }
}

function login($form) {
    global $connection;


    $username = $form['username'];
	$password = $form['password'];
	$check_username_query = "SELECT * FROM user WHERE username = '$username'";
	$check_username_result = mysqli_query($connection, $check_username_query);
	$username_in_db = mysqli_fetch_assoc($check_username_result);
    
	if ($username == $username_in_db['username']){
		if (password_verify($password, $username_in_db['password'])){
            $_SESSION['login']=true;
			header('Location:index.php');
			exit;
		} else{
            set_flash_message('register_success','Username atau password tidak ditemukan');
        }
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

    /* ternak */
    function tambah_data_ternak($form)
    {
        global $connection;

        $ternak = htmlspecialchars($form['ternak']);
        $jenis = $form['jenis'];

        $connection->query("
            INSERT INTO ternak
            (ternak, jenis)
            VALUES
            ('$ternak', '$jenis')
        ");

        if ($connection->affected_rows > 0) {
            set_flash_message('add_success', 'Berhasil menambahkan ternak');
        } else {
            set_flash_message('add_failed', 'Gagal menambahkan ternak');
        }
        return redirect('ternak.php?halaman=ternak');
    }

    function ambil_data_ternak()
    {
        global $connection;

        return $connection->query("
            SELECT
            id,
            ternak as nama,
            jenis
            FROM ternak
        ")->fetch_all(MYSQLI_ASSOC);
    }

    function ambil_ternak_by_id($id)
    {
        global $connection;

        return $connection->query("
            SELECT
            id,
            ternak as nama,
            jenis
            FROM ternak
            WHERE id = '$id'
        ")->fetch_assoc();
    }

    function update_data_ternak($form)
    {
        global $connection;

        $id = $form['id'];
        $ternak = htmlspecialchars($form['ternak']);
        $jenis = $form['jenis'];

        $connection->query("
            UPDATE ternak
            SET
                ternak = '$ternak',
                jenis = '$jenis'
            WHERE id = '$id'
        ");

        if ($connection->affected_rows > 0) {
            set_flash_message('add_success', 'Berhasil update ternak');
        } else {
            set_flash_message('add_failed', 'Gagal update ternak');
        }
        return redirect('ternak.php?halaman=ternak');
    }
    /* end of ternak*/

    /* peternakan */
    function tambah_data_peternakan($form, $tahun, $jenis)
    {
        global $connection;
        try {
            $id_kecamatan = $form['id-kecamatan'];
            $i = 0;
            foreach ($id_kecamatan as $kecamatan ) {
                $j  = 0;
                $jumlah_ternak = $form['jumlah-ke-'.$i];
                foreach ($jumlah_ternak as $jumlah) {
                    $id_ternak = $form['id-ternak'][$j];
                    $connection->query("
                        INSERT INTO peternakan
                        (id_kecamatan, id_ternak, id_tahun, id_jenis, jumlah_ternak)
                        VALUES
                        ('$kecamatan', '$id_ternak', '$tahun', '$jenis', $jumlah)
                    ");
                    $j++;
                }
                $i++;
            }

            // asumsi update telah usai
            // mencari nilai tertinggi tiap jenis, ternak, dam tahun
            $data_max = [];
            foreach ($form['id-ternak'] as $id_ternak) {
                $data_tertinggi =$connection->query("
                        SELECT
                            MAX(jumlah_ternak) as data_tertinggi
                        FROM
                            peternakan
                        WHERE
                            peternakan.id_tahun =  '$tahun'
                            AND
                            peternakan.id_ternak = '$id_ternak'
                            AND 
                            peternakan.id_jenis = '$jenis'
                            
                    ")->fetch_assoc();
                $data_max[] = $data_tertinggi['data_tertinggi'];
            }

            // hitung nilai normalisasi
            foreach ($id_kecamatan as $kecamatan ) {
                $j = 0;
                // ambil data ternak
                foreach ($data_max as $max) {
                    $id_ternak = $form['id-ternak'][$j];
                    // ambil data
                    $jumlah_ternak = $connection->query("
                        SELECT jumlah_ternak 
                        FROM peternakan
                        where 
                            id_ternak = '$id_ternak'
                            AND
                            id_tahun = '$tahun'
                            AND 
                            id_jenis = '$jenis'
                            AND
                            id_kecamatan = '$kecamatan'
                    ")->fetch_assoc();
                    // hitung normalisasi
                    $nilai_normal = round($jumlah_ternak['jumlah_ternak'] / $max, 4 );

                    // update data
                    $connection->query("
                        UPDATE peternakan SET
                            normalisasi = '$nilai_normal'
                        where 
                            id_ternak = '$id_ternak'
                            AND
                            id_tahun = '$tahun'
                            AND 
                            id_jenis = '$jenis'
                            AND
                            id_kecamatan = '$kecamatan'
                    ");
                    $j++;
                }
            }

            set_flash_message('add_success', 'Berhasil menambahkan ternak');
        }catch (Throwable $e) {
            set_flash_message('add_success', 'Berhasil menambahkan ternak');
        }
        return redirect('peternakan.php?halaman=peternakan');
    }

    function ambil_data_jumlah_ternak($id_jenis,$id_tahun, $id_kecamatan)
    {
        global $connection;

        return $connection->query("
            SELECT
                peternakan.id_kecamatan AS id_kecamatan, 
                peternakan.id_ternak AS id_ternak, 
                peternakan.id_tahun AS id_tahun, 
                peternakan.id_jenis AS id_jenis, 
                peternakan.jumlah_ternak AS jumlah_ternak
            FROM
                peternakan
            WHERE
                peternakan.id_tahun = '$id_tahun' AND
                peternakan.id_jenis = '$id_jenis' AND
                peternakan.id_kecamatan = '$id_kecamatan'
        ")->fetch_all(MYSQLI_ASSOC);
    }

    function ambil_data_peternakan()
    {
        global $connection;

        return $connection->query("
            SELECT
                tahun.tahun AS tahun, 
                jenis.nama AS jenis, 
                peternakan.id_tahun AS id_tahun, 
                peternakan.id_jenis AS id_jenis
            FROM
                peternakan
                INNER JOIN
                tahun
                ON 
                    peternakan.id_tahun = tahun.id
                INNER JOIN
                jenis
                ON 
                    peternakan.id_jenis = jenis.id
            GROUP BY
                peternakan.id_tahun, 
                peternakan.id_jenis
        ")->fetch_all(MYSQLI_ASSOC);
    }

    function update_data_peternakan($form)
    {
        global $connection;

        try {
            $id_kecamatan = $form['id-kecamatan'];
            $i = 0;
            $tahun_sebelum = $form['tahun-sebelum'];
            $jenis_sebelum = $form['jenis-sebelum'];

            foreach ($id_kecamatan as $kecamatan ) {
                $j = 0;
                $jumlah_ternak = $form['jumlah-ke-'.$i];
                foreach ($jumlah_ternak as $jumlah) {
                    $id_ternak = $form['id-ternak'][$j];
                    $jumlah = $jumlah_ternak[$j];
                    $connection->query("
                        UPDATE peternakan SET
                        jumlah_ternak = '$jumlah'
                        where 
                            id_ternak = '$id_ternak'
                            AND
                            id_tahun = '$tahun_sebelum'
                            AND 
                            id_jenis = '$jenis_sebelum'
                            AND
                            id_kecamatan = '$kecamatan'
                    ");
                    $j++;
                }
                $i++;
            }

            // asumsi update telah usai
            // mencari nilai tertinggi tiap jenis, ternak, dam tahun
            $data_max = [];
            foreach ($form['id-ternak'] as $id_ternak) {
                $data_tertinggi =$connection->query("
                        SELECT
                            MAX(jumlah_ternak) as data_tertinggi
                        FROM
                            peternakan
                        WHERE
                            peternakan.id_tahun =  '$tahun_sebelum'
                            AND
                            peternakan.id_ternak = '$id_ternak'
                            AND 
                            peternakan.id_jenis = '$jenis_sebelum'
                            
                    ")->fetch_assoc();
                $data_max[] = $data_tertinggi['data_tertinggi'];
            }

            // hitung nilai normalisasi
            foreach ($id_kecamatan as $kecamatan ) {
                $j = 0;
                // ambil data ternak
                foreach ($data_max as $max) {
                    $id_ternak = $form['id-ternak'][$j];
                    // ambil data
                    $jumlah_ternak = $connection->query("
                        SELECT jumlah_ternak 
                        FROM peternakan
                        where 
                            id_ternak = '$id_ternak'
                            AND
                            id_tahun = '$tahun_sebelum'
                            AND 
                            id_jenis = '$jenis_sebelum'
                            AND
                            id_kecamatan = '$kecamatan'
                    ")->fetch_assoc();
                    // hitung normalisasi
                    $nilai_normal = round($jumlah_ternak['jumlah_ternak'] / $max, 4 );

                    // update data
                    $connection->query("
                        UPDATE peternakan SET
                            normalisasi = '$nilai_normal'
                        where 
                            id_ternak = '$id_ternak'
                            AND
                            id_tahun = '$tahun_sebelum'
                            AND 
                            id_jenis = '$jenis_sebelum'
                            AND
                            id_kecamatan = '$kecamatan'
                    ");
                    $j++;
                }
            }

            // hitung nilai normalisasi

            set_flash_message('add_success', 'Berhasil update ternak');
        }catch (Throwable $e) {
            set_flash_message('add_success', 'Gagal  update ternak');
        }
        return redirect('peternakan.php?halaman=peternakan');
    }

    
    /* end of peternakan */


