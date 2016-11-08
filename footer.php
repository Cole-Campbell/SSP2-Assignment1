<?php

#Footer which contains and sets session variable 'lasturl' which is acquired by $_SERVER['REQUEST_URI']. HTML for bootstrap and jquery js is also included.

$_SESSION['lasturl'] = $_SERVER['REQUEST_URI'];

?>

</div>

</body>
<!-- Bootstrap/jQuery JS CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<footer></footer>
</html>