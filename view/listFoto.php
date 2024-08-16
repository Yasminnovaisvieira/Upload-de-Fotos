<?php
//Chama uma função PHP que permite informar a classe e o Método que será acionado
  $fotos = call_user_func(array('fotoController','listar'));


?>
<div class="container">

<h1>Fotos</h1>
<hr>
<table class="table" style="top:40px;">
        <tbody>
        <?php 
        $cont=0;
        //Verifica se houve algum retorno
        if (isset($fotos) && !empty($fotos)) {
          foreach ($fotos as $foto) {
            
            if($cont==0){
              echo '<tr>';
            }
            
            echo '<td>';
            echo '<p align="center"><img class="img-thumbnail" style="width: 25%;" src="data:'.$foto->getFotoTipo().';base64,'.base64_encode($foto->getFoto()).'"></p><br>';;
            echo '<a href="index.php?action=editar&id='.$foto->getId().'&page=foto" class="btn btn-primary btn-sm">Editar</a>&nbsp;&nbsp;&nbsp;';
            echo '<a href="index.php?action=excluir&id='.$foto->getId().'&page=foto" class="btn btn-danger btn-sm">Excluir</a>';
            $cont++;
            if($cont==4)
              $cont=0;

          }
        }else{
            ?>
                <tr>
                    <td colspan="3">Nenhum registro encontrado</td>
                </tr>
                <?php
        }
?>
        </tbody>
</table>
</div>