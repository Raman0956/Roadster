<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();
echo "<script>
    alert('You have successfully signed out');
    window.location.href = '/roadsters/index.php';
</script>";
exit();
?>
