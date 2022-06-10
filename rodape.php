<?php 
echo "<footer style='text-align: center;'>";
echo "<p>Acessado por " . $_SERVER['REMOTE_ADDR'] . " em " . date('d/m/y') ."</p>";
echo "<p>Desenvolvido por Vinícius Leite &copy; 2022</p>";
echo "</footer>";
$banco->close();
?>