<?php
 session_start();
 unset($_SESSION['u_name']);
 session_destroy();
 echo '<script type="text/javascript">var t=setTimeout(window.location.href="../../../index.html",3000);</script>';
 ?>