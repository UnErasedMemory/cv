<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $fullname = strip_tags(trim($_POST["fullname"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Periksa apakah data lengkap
    if (empty($fullname) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Harap lengkapi formulir dengan benar.";
        exit;
    }

    // Alamat email tujuan
    $recipient = "petraxandika@gmail.com";

    // Subjek email
    $subject = "Pesan Baru dari Portofolio Anda dari $fullname";

    // Konten email
    $email_content = "Nama: $fullname\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Pesan:\n$message\n";

    // Header email
    $email_headers = "From: $fullname <$email>";

    // Kirim email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        // Anda bisa membuat halaman "terima kasih" dan redirect ke sana
        echo "Terima kasih! Pesan Anda telah terkirim.";
    } else {
        http_response_code(500);
        echo "Oops! Terjadi kesalahan. Pesan tidak terkirim.";
    }

} else {
    http_response_code(403);
    echo "Terjadi kesalahan. Coba lagi.";
}
?>